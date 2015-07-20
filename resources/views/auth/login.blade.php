<!DOCTYPE html>
<html ng-app="login" >
<head>
    <title>Login</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/login.js"></script>
</head>
<body>

<!-- resources/views/auth/login.blade.php -->

<div class="container" ng-controller="MainController">

    <form class="form-signin" method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" ng-model="sendEmail" value="{{ old('email') }}" id="inputEmail" class="form-control no_radius_bottom bottom_less1" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" ng-model="sendPassword" class="form-control no_radius_top bottom_plus10" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" ng-model="remember" value="remember-me"> Remember me
            </label>
            <label><a href="">Forgot your password?</a></label>
        </div>
        <div ng-show="myValue" class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            @{{ error }}
        </div>
        <button class="btn btn-lg btn-primary btn-block"  ng-click="login($event, sendEmail, sendPassword, remember)">Sign in</button>
        <div id="signup">
            <label><a href="register">Don't have an account? Sign Up</a></label>
        </div>


    </form>

</div> <!-- /container -->

</body>
</html>