<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Otp</title>
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
</style>
</head>
<body>
    <div class="container">
        @if (session('wrong_otp'))
        <div>
            <h2>{{session('wrong_otp')}}</h2>
        </div>

        @endif

        @if (session('wrong'))
        <div>
            <h2>{{session('wrong')}}</h2>
        </div>

        @endif
        <form class="form" action="{{ route('verify_otp') }}" method="post">
            <h2>Verify OTP</h2>
            @csrf
            <div class="form-group">
                <input type="text" name="code" id="otp" placeholder="OTP">
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>

    </div>

</body>
</html>
