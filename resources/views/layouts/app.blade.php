<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/ico" />

    @vite('resources/js/app.js')


    <title>Snel Woningruil</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let token = "{{ session('token') }}";
            if (token) {
                console.log("Token:", token);
                console.log("AAAAAA");

                localStorage.setItem('api_token', token);
            }
        });

        let token = "{{ session('token') }}";
        console.log("Token:", token);
        console.log("AAAAAA");
    </script>

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('layouts.sidebar')

            <!-- top navigation -->
            @include('layouts.header')
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            @include('layouts.footer')
            <!-- /footer content -->
        </div>
    </div>
</body>

</html>
<script src="js/jquery-1.10.2.min.js"></script>
