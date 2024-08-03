<!DOCTYPE html>
<html lang="{{ session('local') }}">

<head>
    <title>Home Page</title>
    @csrf
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/js/app.js')
    <style>
        .top-header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        .navbar {
            display: flex;
            justify-content: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;

        }

        .menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .menu li {
            margin-right: 20px;
        }

        .menu li:last-child {
            margin-right: 0;
        }

        .menu li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .menu li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .body-content {
            padding: 20px 0;
            background-color: #f0f0f0;
        }

        .container .body-content {
            text-align: center;
        }

        /* Adjusting form styles */
        .profile-form {
            text-align: left;
        }

        .profile-form .form-group {
            margin-bottom: 20px;
        }

        .profile-form label {
            display: block;
            margin-bottom: 5px;
        }

        .profile-form input {
            width: calc(100% - 12px);
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile-form button {
            padding: 10px;
            background-color: #ea00ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .profile-form button:hover {
            background-color: #1bb300;
        }

        div.error {
            color: red;
            font-weight: 600;
            margin-top: 6px;
        }

        .alert {
            padding: 15px;
            margin-top: 20px;
            background-color: #d4edda;
            border: 1px solid #0dc337;
            color: #155724;
            border-radius: 5px;
            position: relative;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 1000%;
            margin: auto;
            text-align: center;
            font-family: arial;
            background-color: rgb(254, 254, 254);
        }

        .price {
            color: grey;
            font-size: 22px;
        }

        .card button {}

        .card button:hover {
            opacity: 0.7;
        }

        footer {
            bottom: 0;
            text-align: center;
            padding: 20px;
            background: #333;
            color: #ffffff;
            width: 100%;
            height: 40px;
        }

        .responsive {
            padding: 0 6px;
            float: left;
            width: 24.99999%;
        }


        @media only screen and (max-width: 700px) {
            .responsive {
                width: 49.99999%;
                margin: 6px 0;
            }
        }

        @media only screen and (max-width: 500px) {
            .responsive {
                width: 100%;
            }

        }

        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #b62319;
        }

        .auto-slider {
            position: relative;
            box-sizing: content-box;
            display: inline-block;
            padding: 10px 10px 20px;
            background: #fff;
            max-width: 720px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 4px;
            box-shadow: 1px 1px 6px rgba(0, 0, 0, 0.4);

        }

        #footer {
            bottom: 0;
        }

        .card-img img {}

        #a {}
    </style>
</head>

<body>
    <div id="a">
        <header class="top-header">
            <nav class="navbar">
                <div class="container">
                    <ul class="menu">
                        <li><a href="{{ route('home') }}">@lang('res.home')</a></li>
                        <li><a href="{{ route('profile') }}">@lang('res.profile')</a></li>
                        <li><a href="{{ route('logout') }}">@lang('res.logout')</a></li>
                        <li><a href="{{ route('addpost') }}">@lang('res.addpost')</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Language</button>
                    <div class="dropdown-content">
                        <a href="{{ url('auth/local/ar') }}" action="" method="get">Arabic
                            <script>
                                let local = "{{ session('local') }}";
                                if (local == 'en') {
                                    localStorage.setItem('local', 'en');
                                } else {
                                    localStorage.setItem('local', 'ar');
                                }
                                let a=localStorage.getItem('local');
                                console.log(a);
                                console.log("GGGGG");
                            </script>
                        </a>
                        <a href="{{ url('auth/local/en') }}" action="" method="get">English
                        </a>
                    </div>
                </div>
            </nav>
        </header>


        <!--  there is my test code -->
        <div class="card">
            <section class="shop6 featuresLink cid-rt01T637Tj" id="shop06-1b">
                <div class="container-fluid px-5 ">
                    <h4 class="main-title pb-5 align-left mbr-regular mbr-fonts-style display-2">This Month's New Ads
                    </h4>
                    @foreach ($data as $items)
                        <div class="row-3 justify-content-center ">
                            <div class="card p-3 col-12 col-md-6 col-lg-3 ">
                                <div class="card-wrapper">
                                    <div class="card-img">
                                        <a href="" target="_blank">
                                            <figure>
                                                @foreach ($items->images as $img)
                                                    <img src="{{ Storage::url($img->image_path) }}"
                                                        style="max-height: 10%; max-width:20% " alt=""
                                                        title="">
                                                @endforeach
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="card-box align-left">

                                        <h4 class="card-title mbr-fonts-style display-5">{{ $items->name }}</h4>
                                        <h6> @lang('res.description') : {{ $items->describtion }}</h6>
                                        <h4 class="">
                                            <h5 href="" class="">{{ $items->price }}</h5>
                                        </h4>
                                    </div>
                                    <div><button type="button" class="btn btn-primary">Add to Card</button></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

    </div>
    <script>
        /* document.addEventListener("DOMContentLoaded", function() {
                            let token = "{{ session('token') }}";
                            if (token) {
                                console.log("Token:", token);
                                console.log("AAAAAA");

                                localStorage.setItem('token', token);
                            }
                        });

                        let token = "{{ session('token') }}";
                        console.log("Token:", token);*/
    </script>
</body>
<footer>
    <p>&copy; 2024 AD Laravel. All rights reserved.</p>
</footer>


</html>





<!--"https://contentstatic.techgig.com/photo/88751917/7-programming-languages-every-beginner-should-explore.jpg?35120"
-->
