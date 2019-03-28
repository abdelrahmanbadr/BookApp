<div class="row justify-content-center">
    <a href="{{url('books/export/csv')}}" class="btn badge-info" download>export list with title and author
        to csv</a>
    <a href="{{url('books/export/csv?fields=title')}}" class="btn badge-info offset-md-1" download>export list with
        title only to
        csv</a>
    <a href="{{url('/books/export/csv?fields=authorName')}}" class="btn badge-info offset-md-1" download>export list
        with authors only
        to csv</a>
</div>
<br>
<div class="row justify-content-center">
    <a href="{{url('books/export/xml')}}" class="btn badge-info" download>export list with title and author
        to xml</a>
    <a href="{{url('books/export/xml?fields=title')}}" class="btn badge-info offset-md-1" download>export list with
        title only to
        xml</a>
    <a href="{{url('/books/export/xml?fields=authorName')}}" class="btn badge-info offset-md-1" download>export list
        with authors only
        to xml</a>
</div>