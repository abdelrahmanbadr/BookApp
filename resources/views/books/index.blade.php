@extends('layouts.app')

@section('content')

    @include('books.export')
    <br>
    @include('books.create')
    <br>
    @include('books.list')

@endsection
@section('scripts')
    <script>
        $(document).on('dblclick', '.authorName', function (ev) {
            this.removeAttribute("disabled");
            this.focus();
            window.getSelection().removeAllRanges();
        });
        $(document).on('focusin', '.authorName', function () {
            $(this).data('val', $(this).val());
        });

        $(document).on('blur', '.authorName', function () {
            oldValue = $(this).data('val');
            bookId = this.getAttribute('book-id');
            setTimeout(function () {
                newValue = $("#authorName-" + bookId).val()
                $.ajax({
                    url: '/books/' + bookId,
                    data: {_token: getCSRFToken(), authorName: newValue},
                    success: (json) => {
                        swal("", "Author updated successfully", "success")
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        $("#authorName-" + bookId).val(oldValue)
                        swal("", xhr.responseJSON.errors.authorName[0], "error")
                    },
                    method: "patch"
                });
            }, 100);
            this.setAttribute("disabled", "");

        });
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
                    swal("", "Book deleted successfully", "success")
                },
                method: "delete"
            });
        });
    </script>
    <!-- delete book script end -->

    <!-- sort  book list -->
    <script>
        $(document).ready(function () {
            $('input[type=radio][name=sort]').change(function () {
                loadbooksList()
            });

            $('input[type=radio][name=order]').change(function () {
                loadbooksList()
            });
        });
    </script>
    <!-- sort end -->

    <!--  functions -->
    <script>
        function getCSRFToken() {
            return $("input[name='_token']").val();
        }

        function buildUrl() {
            searchInput = $("#searchInput").val()
            order = $("input[type=radio][name=order]:checked").val();
            sort = $("input[type=radio][name=sort]:checked").val();
            url = document.URL + "?search=" + searchInput + "&searchFields=title,authorName"

            if (sort != undefined) {
                if (order == "asc") {
                    url = url + "&sort=+" + sort
                } else {
                    url = url + "&sort=-" + sort
                }
            }

            return url
        }

        function loadbooksList(url) {
            url = buildUrl()
            $("#booksList").load(url + ' #booksList'); //document.URL
        }
    </script>
    <!-- functions script end -->
@endsection