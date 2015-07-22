<!DOCTYPE html>
<html ng-app="reset">
<head>
    <title>Password reset</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/reset.js"></script>
</head>
<body>


<div class="container" ng-controller="MainController">

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

</body>

</html>