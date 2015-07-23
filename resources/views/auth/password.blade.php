<!-- resources/views/auth/pwrecover.blade.php -->
<html>
<head>
    <title>Password reset</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="bower_components/bootstrap-social/bootstrap-social.css" type="text/css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/password.js"></script>
</head>
<body>

<div class="container">
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

        <div class="loading" >
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