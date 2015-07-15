<!DOCTYPE html>
<html ng-app="login" >
<head>
    <title>Login</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">
    <script src="/js/login.js"></script>
</head>
<body>
<!--
<h1>Login</h1>
﻿<form name="form" method="post" action="">
    <div>Username:</div>
    <div><input type="text" name="username" size=50></div>
    <br>

    <div>Password:</div>
    <div><input type="password" name="password" size=50></div>
    <br>
</form>
<button>Login</button>
<a href="">Forgot your password?</a>
-->

<!-- resources/views/auth/login.blade.php -->
<div ng-controller="MainController">
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        <div>
            Email
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            Password
            <input type="password" name="password" id="password">
        </div>

        <div>
            <input type="checkbox" name="remember"> Remember Me
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</div>
</body>
</html>