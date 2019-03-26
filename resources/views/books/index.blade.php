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
    <!-- delete book script end -->

    <!-- sort  book list -->
    <script>
     $(document).ready(function(){
        $('input[type=radio][name=sort]').change(function() {
            loadbooksList()
        });

         $('input[type=radio][name=order]').change(function() {
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
        searchInput =  $("#searchInput").val()
        order = $( "input[type=radio][name=order]:checked" ).val();
        sort = $( "input[type=radio][name=sort]:checked" ).val();
        url = document.URL+"?search="+searchInput+"&searchFields=title,authorName"
       
        if (sort != undefined) {
            if(order == "asc") {
                url = url +"&sort=+"+sort
            } else {
                url = url +"&sort=-"+sort
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