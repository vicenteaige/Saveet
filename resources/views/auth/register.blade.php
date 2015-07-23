<!DOCTYPE html>
<html ng-app="register">
<head>
    <title>Register</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>

    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="bower_components/bootstrap-social/bootstrap-social.css" type="text/css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.css" type="text/css">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/register.js"></script>
</head>
<body>

<!-- resources/views/auth/register.blade.php -->

<div class="container" ng-controller="MainController">

    <form class="form-signin" method="POST" action="/auth/register">

        <input type="hidden" ng-model="_token" value="<?php echo csrf_token(); ?>">

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img alt="Brand" src="img/saveet.png"></a>
                </div>
            </div>
        </nav>

        <h2 class="form-signin-heading">Please Sign Up</h2>
        <label for="inputName" class="sr-only">Name</label>
        <input type="text" ng-model="sendName" value="{{ old('name') }}" id="name" class="form-control no_radius_bottom bottom_less1" placeholder="Enter your name" required autofocus>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" ng-model="sendEmail" value="{{ old('email') }}" id="email" class="form-control no_radius bottom_less1" placeholder="Email address" required autofocus>
        <label for="inputTwitterUserName" class="sr-only">Twitter UserName</label>
        <input type="text" ng-model="sendTwitterUserName" value="{{ old('twitter_username') }}" id="twitter_username" class="form-control no_radius bottom_less1" placeholder="Twitter username, not required" autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" ng-model="sendPassword" class="form-control no_radius bottom_less1" placeholder="Password" required>
        <label for="inputPasswordConfirmation" class="sr-only">Password</label>
        <input type="password" ng-model="sendPasswordConfirmation" id="password_confirmation" class="form-control no_radius_top bottom_plus10" placeholder="Password Confirmation" required>
        <div ng-show="myValue" class="alert alert-danger" role="alert">
            <div ng-repeat="error in errors">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                @{{error}}
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" ng-click="register($event, sendName, sendEmail, sendTwitterUserName, sendPassword, sendPasswordConfirmation, event, _token)">Register</button>
        <div id="signup">
            <label><a href="{{Config::get('app.url')}}login">Do you have an account? Sign In</a></label>
        </div>
    </form>

</div>

<footer class="footer">
    <div class="git-logo">
        <p class="text-muted">Check this project on GitHub
            <a class="btn btn-social-icon btn-github" href="https://github.com/jlightyear/bootcampinc" target="_blank">
                <i class="fa fa-github"></i>
            </a>
        </p>
    </div>

</footer>

</body>
</html>