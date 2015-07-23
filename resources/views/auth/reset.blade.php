<!DOCTYPE html>
<html ng-app="reset">
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
    <script src="/js/reset.js"></script>
</head>
<body>


<div class="container" ng-controller="MainController">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img alt="Brand" src="/img/saveet.png"></a>
            </div>
        </div>
    </nav>

    <div class="form-signin">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <h2 class="form-signin-heading">Password reset</h2>
        <p>Type your new password</p>

        <label for="inputPassword" class="sr-only"></label>
        <input type="password" ng-model="sendPassword" name="password" class="form-control no_radius_bottom bottom_less1" placeholder="Password" required autofocus>

        <label for="inputPassword" class="sr-only"></label>
        <input type="password" ng-model="sendPasswordConfirmation" name="password_confirmation" class="form-control no_radius_top bottom_plus10" placeholder="Password confirmation" >

        <button class="btn btn-lg btn-primary btn-block"  ng-click="reset(sendPassword, sendPasswordConfirmation)">Reset password</button>
        <div id="signup">
            <label><a href="{{Config::get('app.url')}}login">Do you have an account? Sign In</a></label>
        </div>


    </div>

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