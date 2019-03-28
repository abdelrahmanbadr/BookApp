<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreBookRequest, UpdateBookRequest};
use App\Domain\Contracts\BookServiceInterface;
use App\Domain\Constants\Constant;
use App\Helpers\{StringHelper, UrlHelper};

class BookController extends Controller
{
    /**
     * @var BookServiceInterface
     */
    private $service;

    public function __construct(BookServiceInterface $bookService)
    {
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
        return view("books.index", compact("books"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $request->validated();
        $book = $this->service->create($request->all());
        return redirect()->route('books');
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
        $request->validated();
        $book = $this->service->update($id, $request->all());
        return response()->json($book, 201);
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
