<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Premission</title>
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
            margin: 20px
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
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .profile-form button:hover {
            background-color: #0056b3;
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
        }

        .price {
            color: grey;
            font-size: 22px;
        }

        .card button {
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #007bff;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        .card h4 {
            padding: 12px;
            text-align: start;
        }

        .card button:hover {
            opacity: 0.7;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #333;
            color: #ffffff;
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

        .card-body .table tr:first-child td {
            border-top: 0;
        }

        .GFG {
            width: 100px;
            height: 50px;
            background: green;
            border: none;
            color: white;
        }

        .aa a {
            width: 300px;
            background: rgb(19, 122, 218);
            height: 100px;

        }
    </style>
</head>

<body>
    <header class="top-header">
        <nav class="navbar">
            <div class="container">
                <ul class="menu">
                    <li><a href="{{ url('role') }}">Roles</a></li>
                    <li><a href="{{ url('users') }}">Users</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="a">
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
    </div>

    <div class="aa">
        <a href="{{ url('permission/create') }}" class="GFG">Add Permission</a>
    </div>
    <div class="card">
        @foreach ($p as $item)
            <p>{{ $item->name }}</p>
            <a href="{{url('permission/' . $item->id . '/delete')}}" class="GFG">delete</a>
            <a href="{{ url('permission/' . $item->id . '/edit') }}" class="GFG">update</a>
            <hr>
            <br>
        @endforeach
    </div>
</body>

</html>
