<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="col-md-12">
                        <div class=" col-md-12 row">
                            <input  type="text" placeholder="Search for a book by title or author"  id="searchInput" class="form-control col-md-6" onkeyup="loadbooksList()" >
                           
                            <div class="radio col-md-3" >
                                <b> Sort By : </b>
                                <label><input type="radio" value="title" name="sort" >Title</label>
                                <label><input type="radio" value="authorName" name="sort">Author</label>
                            </div>
                            
                            <div class="checkbox  col-md-3">
                                <b> Order By : </b>
                                <label><input type="radio" value="asc" name="order" checked>Asc</label>
                                <label><input type="radio" value="desc" name="order">Desc</label>
                            </div>
                               
                        </div>
                        <br>
                        <div id="booksList">
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