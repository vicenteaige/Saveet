<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/html">

    <head>
        <title>Laravel</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <script src="/bower_components/angular/angular.js"></script>
        <script src="/bower_components/angular-resource/angular-resource.js"></script>

        <!--ngTags-input - obligatoriamente tras angular-->
        <script type="application/javascript" src="bower_components/ng-tags-input/ng-tags-input.js"></script>
        <link rel="stylesheet" href="bower_components/ng-tags-input/ng-tags-input.min.css">  

        <script src="/bower_components/jquery/dist/jquery.js"></script>
        <script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="bower_components/bootstrap-social/bootstrap-social.css" type="text/css">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.css" type="text/css">

        <script type="application/javascript" src="/js/logout.js"></script>
        <script type="application/javascript" src="/js/tag.js"></script>
        <link rel="stylesheet" href="/css/index.css">

        <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
        
        <script>var rootApp = angular.module('rootApp', ['logout','usertags'])</script>
        
    </head>

    <body ng-app="rootApp">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container" ng-app="logout" ng-controller="LogoutController">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img alt="Brand" src="img/saveet.png"></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="#world"><span class="glyphicon glyphicon-globe"></span> World trends</a></li>
                    <li><a href="#location"><span class="glyphicon glyphicon-tags"></span> Location trends</a></li>
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

            <div class="content" ng-app="usertags" ng-controller="HashtagController" >

                    <h1>Your personal hashtags:</h1>
                    <tags-input ng-model="tags" on-tag-added="envia ( $tag.text )" on-tag-removed="elimina ( $tag.text )" >
                        <auto-complete source="loadTags($query)"></auto-complete>
                    </tags-input>
            </div>
        </div>
    </div><!-- /.container -->

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

