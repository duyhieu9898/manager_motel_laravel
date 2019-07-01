
    <div id="a">a</div>
    <div id=b">b</div>
    <div class="page-content"></div>
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script>
    $('#a').click(function (e) {
        load("GET","http://localhost:8080/admin/rooms",$('.page.content'));

    });

    $('#b').click(function (e) {
        load("GET","http://localhost:8080/admin/rooms/1/edit",$('.page.content'));

    });



    function load(type,url,element){
        $.ajax({
            type: type,
            url: url,
            dataType: "html",
            success: function (response) {
                element.html(response)
            }
        });
    }

</script>
