<<<<<<< HEAD
<!DOCTYPE html>
<html ng-app="password">
<head>
    <title>Register</title>
=======
<!-- resources/views/auth/pwrecover.blade.php -->
<html>
<head>
    <title>Password reset</title>
>>>>>>> efd5aecf2e15cee899eeade9ff414a70fa202a10
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css">
<<<<<<< HEAD
    <script src="/js/password.js"></script>
</head>
<body>
=======
    <!--<script src="/js/login.js"></script>-->
</head>
<body>

<!--
<form method="POST" action="/password/email">
    {!! csrf_field() !!}
>>>>>>> efd5aecf2e15cee899eeade9ff414a70fa202a10

<div class="container" ng-controller="MainController">  
    {!! csrf_field() !!} 
    <h2 class="form-signin-heading">Password Recovery</h2>
    <div>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" ng-model="sendEmail" name="email" value="{{ old('email') }}" id="email" class="form-control no_radius bottom_less1" placeholder="Email address" required autofocus>
    </div>
    <div ng-show="myValue" class="alert alert-danger" role="alert">
        <div ng-repeat="error in errors">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            @{{error}}
        </div>
    </div>
    <div>
        <button class="btn btn-lg btn-primary btn-block" ng-click="password(sendEmail)">
            Send Password Reset Link
        </button>
    </div>
<<<<<<< HEAD
</div>
=======
</form>
-->

<div class="container">

    <form class="form-signin" method="POST" action="/password/email">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        
        <h2 class="form-signin-heading">Password reset</h2>
        <p>Forgot your password? Send a link to your mail to reset it.</p>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" ng-model="sendEmail" value="{{ old('email') }}" id="inputEmail" class="form-control bottom_plus10" placeholder="Email address" required autofocus>

        <button class="btn btn-lg btn-primary btn-block"  ng-click="password(sendEmail)">Send Password Reset Link</button>
        <div id="signup">
            <label><a href="login">Do you have an account? Sign In</a></label>
        </div>


    </form>

</div> <!-- /container -->

</body>
</html>
>>>>>>> efd5aecf2e15cee899eeade9ff414a70fa202a10
