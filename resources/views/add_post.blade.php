<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add post</title>
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


        <form class="form" action="{{ route('addpost') }}" method="post" enctype="multipart/form-data" action="/details">
            <h2>Add post</h2>
            @csrf
            <div class="form-group">
                <input type="number" name="user_id" id="name" placeholder="user_id ">

            </div>
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="name ">

            </div>
            <div class="form-group">
                <input type="text" name="describtion" id="describtion" placeholder=" describtion">
            </div>
            <div class="form-group">
                <input type="number" name="amount" id="amount" placeholder="amount">
            </div>
            <div class="form-group">
                <input type="number" name="price" id="price" placeholder="price">
            </div>
            <div class="form-group">
                <input type="text" name="note" id="note" placeholder="note">
            </div>
            <div class="form-group">
                <input required type="file" class="btn btn-primary" name="image_path[]" placeholder="image" multiple>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>

    </div>

</body>

</html>
