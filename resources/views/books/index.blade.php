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
        //@todo download jquery lib to local
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
            var _token = $("input[name='_token']").val();
            bookId = el.getAttribute('book-id');
            setTimeout(function () {
                newValue = $("#authorName-" + bookId).val()
                $.ajax({
                    url: '/books/' + bookId,
                    data: {_token: _token, authorName: newValue},
                    success: function (data) {
                    },
                    method: "put"
                });
            }, 100);
            el.setAttribute("disabled", "");
        }
        function loadbooksList() {
            $("#booksList").load(document.URL + ' #booksList');
        }
        $(document).on('click', '.delete-book', function (event) {
            event.preventDefault()
            bookId = $(this).attr('book-id');
            $(this).parent().parent().remove();
            $.ajax({
                url: '/books/' + bookId,
                data: {_token: _token},
                method: "delete"
            });
        });
    </script>
@endsection