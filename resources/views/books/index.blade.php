@extends('layouts.app')

@section('content')

{{--    @include('books.export')--}}
    {{--<br>--}}
    @include('books.create')
    <br>
    @include('books.list')

@endsection
@section('scripts')
    <script>
        function edit(el) {
            el.childNodes[0].removeAttribute("disabled");
            el.childNodes[0].focus();
            window.getSelection().removeAllRanges();
        }
        $(".authorName-input").blur(function () {
            $(this).setAttribute("disabled", "");
            var t = $(this);
            console.log("3######")
            setTimeout(function () {
                var t = $(this);
                console.log(t.val())
                if (t.val() == "") $t.next().text("This field is required.");
                else t.next().text("");
            }, 100);
        });
        function disable(el) {
            var CSRF_TOKEN = getCSRFToken()
            bookId = el.getAttribute('book-id');
            setTimeout(function () {
                newValue = $("#authorName-" + bookId).val()
                $.ajax({
                    url: '/books/' + bookId,
                    data: {_token: _token, authorName: newValue},
                    success: (json) => {
                    },
                    method: "put"
                });
            }, 100);
            el.setAttribute("disabled", "");
        }
        function loadbooksList() {
            $("#booksList").load(document.URL + ' #booksList');
        }
      
    </script>
     <!-- script end -->

    <!-- delete book from book list -->
    <script>
      $(document).on('click', '.delete-book', function (event) {
            event.preventDefault()
            bookId = $(this).attr('book-id');
            
            $.ajax({
                url: '/books/' + bookId,
                data: {_token: getCSRFToken()},
                success: (json) => {
                    $(this).parent().parent().remove();
                },
                method: "delete"
            });
        });
    </script>
    <!-- script end -->

     <!-- common functions -->
    <script>
    function getCSRFToken() {
        return $("input[name='_token']").val();
    }
    </script>
     <!-- script end -->
@endsection