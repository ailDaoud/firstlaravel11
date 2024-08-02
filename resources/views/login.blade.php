<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <!--   <script src="http://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>-->
    @session('status')
    @endsession
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/js/app.js')
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #596979;
        }

        .container {
            width: 400px;
            background: #0763a9;
            padding: 31px;
        }

        .login-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-form h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            justify-content: center;
            align-items: center;
        }

        input {
            width: 93%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #a71a40;
        }

        p {
            margin: 0;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
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
    </style>
</head>

<body>
    <div class="container">
        @section('sucsess')
            <div class="alert" id="success-alert">
                {{ session('sucsess') }}
            </div>
        @endsection
        @section('error')
            <div class="alert alert-error" id="error-alert">
                {{ session('error') }}
            </div>
        @endsection
        <form class="form" action="{{ route('login') }}" method="post">
            <h2>Login</h2>
            @csrf
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <div class="form-group">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>

    </div>
    <script>
        console.log(sessionStorage.getItem('key'));
        let accsessToken = sessionStorage.getItem("tok");
        console.log(accsessToken);
        console.log("888888888888");
        console.log("hello");
    </script>

</body>

</html>
<!--const g = async () => {
            let response = await axios.post("http://127.0.0.1/api/auth/login")
            return response.data
        }
        g().then((data) => console.log(data)) -->
