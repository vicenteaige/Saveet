<!DOCTYPE html>
<html ng-app="password">
<head>
    <title>Register</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/password.js"></script>
</head>
<body>

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
</div>