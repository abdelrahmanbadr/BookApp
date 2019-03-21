<?php

namespace App\Http\Controllers;

use App\Domain\Constants\Constant;
use App\Domain\Contracts\BookServiceInterface;
use App\Domain\Entities\Book;
use App\Helpers\StringHelper;
use App\Helpers\UrlHelper;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
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
     * @param  StoreBookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $books = $this->service->create($request->all());
        return response()->json($books, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBookRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
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
     * @param  string $exportType
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(string $exportType)
    {
        $fields = request()->get(Constant::QUERY_PARAMETER_EXPORT_FIELDS);
        if (isset($fields)) {
            $fields = StringHelper::commaExplode($fields);
        } else {
            $fields = [];
        }
        $filePath = public_path() . "/" . $this->service->export($exportType, $fields);
        $fileName = UrlHelper::getLastPartOfPath($filePath);

        return response()->download($filePath, $fileName);
    }
}
