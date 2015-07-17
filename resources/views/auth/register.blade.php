<!DOCTYPE html>
<html ng-app="register">
<head>
    <title>Register</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/register.js"></script>
</head>
<body>

<!-- resources/views/auth/register.blade.php -->

<div class="container" ng-controller="MainController">

    <form class="form-signin" method="POST" action="/auth/register">
        {!! csrf_field() !!}
        <h2 class="form-signin-heading">Please register on</h2>
        <label for="inputName" class="sr-only">Name</label>
        <input type="text" ng-model="sendName" value="{{ old('name') }}" id="name" class="form-control no_radius_bottom bottom_less1" placeholder="Enter your name" required autofocus>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" ng-model="sendEmail" value="{{ old('email') }}" id="email" class="form-control no_radius bottom_less1" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" ng-model="sendPassword" class="form-control no_radius bottom_less1" placeholder="Password" required>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" ng-model="sendPasswordConfirmation" id="password_confirmation" class="form-control no_radius_top bottom_plus10" placeholder="Password Confirmation" required>
        <button class="btn btn-lg btn-primary btn-block" ng-click="register(sendName, sendEmail, sendPassword, sendPasswordConfirmation, event)">Register</button>
    </form>

</div>

</body>
</html>