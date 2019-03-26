
<div id="booksList">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="col-md-12">
                            <div>
                                <input  type="text" placeholder="Search for a book by title or author"  name="search" class="form-control" >
                            </div>
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                <tr class="d-flex">
                                    <th class="col-7">Title</th>
                                    <th class="col-4">Author</th>
                                    <th class="col-1">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($books))
                                    @foreach($books as $book)
                                        <tr class="d-flex koko" >
                                            <td class="col-7">{{$book->title}}</td>
                                            {{--@todo use this better https://vitalets.github.io/x-editable/demo-bs3.html--}}
                                            <td class="col-4" ondblclick="edit(this)" >
                                                <input id="authorName-{{$book->id}}" class="form-control" book-id="{{$book->id}}" value="{{$book->authorName}}" disabled
                                                       onblur="disable(this)">
                                            </td>

                                            <td class="col-1">
                                                <a href="#" class="delete-book" book-id="{{$book->id}}">
                                                    <i class="fa fa-trash-o" style="font-size:24px"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>