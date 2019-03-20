<?php

namespace App\Http\Controllers;

use App\Domain\Constants\Constant;
use App\Domain\Contracts\BookServiceInterface;
use App\Helpers\StringHelper;
use App\Helpers\UrlHelper;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    /**
     * @var BookServiceInterface
     */
    private $service;

    public function __construct(BookServiceInterface $bookService)
    {
        //@todo continuas testing for src/test
        $this->service = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->service->getAll();
        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $books = $this->service->create($request->all());
        return response()->json($books, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = $this->service->update($id, $request->all());

        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json(null, 204);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $fields = request()->get(Constant::QUERY_PARAMETER_EXPORT_FIELDS);
        $fields = StringHelper::commaExplode($fields);

        $exportType = request()->get(Constant::QUERY_PARAMETER_EXPORT_TYPE);
        $filePath = public_path() . "/" . $this->service->export($exportType, $fields);
        $fileName = UrlHelper::getLastPartOfPath($filePath);

        return response()->download($filePath, $fileName);
    }
}
