<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Search Cerpen</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#search").click(function(){
            var cari = $("#cari").val();
            var rank = $("#rank").val();
            $.ajax({
                url:'/search?q='+cari+'&rank='+rank,
                dataType : "json",
                success: function(data){
                        // alert(rank);

                         $('#content').html(data);
                    },
                    error: function(data){
                        alert("Please insert your command");
                    }
            });
        });
    });
    </script>

</head>
<body>

    <header>
        <div class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded"; align:center;>
            <img src="http://cerpenmu.com/wp-content/uploads/2020/04/moto-cerpenmu.jpg">
        </div>
        <nav style="background-color: green;" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
            <a class="navbar-brand" href="#">Cerpen Searching <br> by 210411100112 - Okhi Sahrul Barkah</a>
        </nav>

    </header>

    <main role="main" style="height:100px;">
        <div class="container pt-5">
            <!-- Another variation with a button -->
            <form action="#" method="GET" onsubmit="return false">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Cerpen" name="q" id="cari">
                <div class="col-lg-1">
                <select class="form-control" name="rank" id="rank">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="100">100</option>
                  </select>
                </div>
                <div class="input-group-append">
                <input class="btn btn-secondary fas fa-search" id="search" type="submit" value="Search">
                </div>
            </div>
        </form>
        </div>
    </main>

    <div class="row m-4" id="content">
        
        
        
    </div>
</body>
</html>