@extends('layouts.app')
@section('content')
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
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 100%;
            margin: auto;
            text-align: center;
            font-family: arial;
            padding: auto;
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

        .a {
            width: 200px;
            height: 100px;
        }
    </style>
    <div role="main">
        <div class="a">
            <h2>Role:{{ $role->name }}</h2>
        </div>
        <div class="container">
            <form class="form" action="{{ url('role/' . $role->id . '/give-p') }}" method="post">
                <h2>Edit Permission</h2>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Permission in the permission table</label>
                    <div class="row">
                        @foreach ($p as $p1)
                            <div class="col-md-3">
                                <label for=""></label>
                                <input type="checkbox" name="permission[]" value="{{ $p1->name }}" id="name"
                                    placeholder="Name">
                                {{ $p1->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit">Save Updates</button>
                </div>
                <div class="a">
                    @if (@session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                </div>
            </form>

        </div>
    </div>
@endsection
