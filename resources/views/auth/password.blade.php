<!-- resources/views/auth/pwrecover.blade.php -->
<html>
<head>
    <title>Password reset</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/password.js"></script>
    <!--<script src="/js/login.js"></script>-->
</head>
<body>

<!--
<form method="POST" action="/password/email">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" ng-model="sendEmail" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <button type="submit" ng-click="password(sendEmail)">
            Send Password Reset Link
        </button>
    </div>
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
            <label><a href="{{Config::get('app.url')}}login">Do you have an account? Sign In</a></label>
        </div>


    </form>

</div> <!-- /container -->

</body>
</html>