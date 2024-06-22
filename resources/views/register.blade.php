<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            width: 300px;
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
            background-color: #0056b3;
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


        <form class="form" action="{{ route('register') }}" method="post">
            <h2>Register</h2>
            @csrf
            <div class="form-group">
                <input type="text" name="first_name" id="name" placeholder="First Name">
                @error("first_name")
                <div class="error">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="last_name" id="name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <input type="text" name="mid_name" id="name" placeholder="Mid Name">
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" name="address" id="name" placeholder="Address">
            </div>
            <div class="form-group">
                <input type="tel" name="phone_number" id="phone" placeholder="Phone">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
            <div class="form-group">
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>

    </div>

</body>

</html>
