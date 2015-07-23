<!DOCTYPE html>
<html ng-app="login" >
<head>
    <title>Login</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="bower_components/bootstrap-social/bootstrap-social.css" type="text/css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/login.js"></script>
</head>
<body>

<!-- resources/views/auth/login.blade.php -->

<div class="container" ng-controller="MainController">

    <form class="form-signin" method="POST" action="">

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

        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" ng-model="sendEmail" value="{{ old('email') }}" id="inputEmail" class="form-control no_radius_bottom bottom_less1" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" ng-model="sendPassword" class="form-control no_radius_top bottom_plus10" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" ng-model="remember" value="remember-me"> Remember me
            </label>
            <label><a href="../password/email">Forgot your password?</a></label>
        </div>
        <div ng-show="myValue" class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            @{{ error }}
        </div>
        <button class="btn btn-lg btn-primary btn-block"  ng-click="login($event, sendEmail, sendPassword, remember, _token)">Sign in</button>
        <div id="signup">
            <label><a href="{{Config::get('app.url')}}register">Don't have an account? Sign Up</a></label>
        </div>

        <div class="loading" ng-show="loading">
            <i class="fa fa-circle-o-notch fa-4x fa-spin"></i>
        </div>






    </form>

</div> <!-- /container -->

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