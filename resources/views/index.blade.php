<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/html">

    <head>
        <title>Laravel</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <script src="/bower_components/angular/angular.js"></script>
        <script src="/bower_components/angular-resource/angular-resource.js"></script>

        <!--ngTags-input - obligatoriamente tras angular-->
        <script type="application/javascript" src="bower_components/ng-tags-input/ng-tags-input.js"></script>

        <script src="/bower_components/jquery/dist/jquery.js"></script>
        <script src="/bower_components/bootstrap/js/bootstrap.js"></script>
        <link rel="stylesheet" href="/bower_components/bootstrap/css/bootstrap.css" type="text/css">

        <script type="application/javascript" src="/js/logout.js"></script>
        <script type="application/javascript" src="/js/tag.js"></script>

        <script>var rootApp = angular.module('rootApp', ['usertags','logout'])</script>

        <link rel="stylesheet" href="/css/index.css">
        <!--

        <style>
            html, body {
                height: 100%;
            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: top;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
        -->
    </head>

    <body ng-app="rootApp">
   <div class="container">


    <!--<div class="container" ng-controller="LogoutController">
        <div class="jumbotron">
            @if (Auth::guest())
                <h1>Welcome, you can see the statistics of the trending topics<br />
                    and hashtags of interest.</h1>
                <a href="/auth/login">Sign in</a><br />
                <a href="/auth/register">Sign up</a><br />
            @else
                <h1>Welcome {{ Auth::user()->name }}, you can see the statistics of the trending topics<br />
                and hashtags of interest.</h1>

               <div class="content" ng-app="usertags"  ng-controller="HashtagController" >  

                        <h1>This are your hashtags</h1>
                        <tags-input ng-model="tags" on-tag-added="envia ( $tag.text )" on-tag-removed="elimina ( $tag.text )" >
                            <auto-complete source="loadTags($query)"></auto-complete>
                        </tags-input>
                </div>

                <div ng-app="logout"  ng-controller="LogoutController">
                    <p><a href=""  ng-click="logout()">Log out</a></p>
                </div>                    
            @endif
        </div>


    </div>
    </div>-->

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container" ng-controller="LogoutController">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Bootcamp 1</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">Daily</a></li>
                    <li><a href="#contact">Cities</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" ng-click="logout()"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">

        <div class="starter-template">
            <h1>Welcome, {{ Auth::user()->name }}</h1>
            <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
        </div>

    </div><!-- /.container -->
    </body>
</html>

