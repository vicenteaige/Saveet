<!DOCTYPE html>
<html ng-app="login" >
<head>
    <title>Login</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/css/login.css">
    <script src="/js/login.js"></script>
</head>
<body>

<!-- resources/views/auth/login.blade.php -->
<!--<div ng-controller="MainController">
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        <div>
            Email
            <input type="email" ng-model="sendEmail" value="{{ old('email') }}">
        </div>

        <div>
            Password
            <input type="password" ng-model="sendPassword" id="password">
        </div>

        <div>
            <input type="checkbox" ng-model="remember"> Remember Me
        </div>

        <div>
            <button type="submit" ng-click="login(sendEmail, sendPassword)">Login</button>
        </div>
    </form>
</div>-->
<div class="container" ng-controller="MainController">

    <form class="form-signin" method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" ng-model="sendEmail" value="{{ old('email') }}" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" ng-model="sendPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <div ng-show="myValue" class="alert alert-danger" role="alert">{{ error }}</div>
            <label>
                <input type="checkbox" ng-model="remember" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block"  ng-click="login(sendEmail, sendPassword)">Sign in</button>
    </form>

</div> <!-- /container -->

</body>
</html>