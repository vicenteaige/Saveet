<!DOCTYPE html>
<html ng-app="reset">
<head>
    <title>Register</title>
    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">
    <script src="/js/reset.js"></script>
</head>
<body>

<div class="container" ng-controller="MainController">
<!-- <form method="POST" action="/password/reset"> -->
    <div>
        Password
        <input type="password" ng-model="sendPassword" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" ng-model="sendPasswordConfirmation" name="password_confirmation">
    </div>

    <div>
        <button ng-click="reset(sendPassword, sendPasswordConfirmation)">
            Reset Password
        </button>
    </div>
<!-- </form> -->
</div>