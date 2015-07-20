<!DOCTYPE html>

<html ng-app="logout, bootcamp" xmlns="http://www.w3.org/1999/html">

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
        <!--ngTags-input-->
        <link rel="stylesheet" href="bower_components/ng-tags-input/ng-tags-input.min.css">  

        <script type="application/javascript" src="/js/tag.js"></script>
        <script src="/js/logout.js"></script>
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
    </head>
    <body>
    <div class="container" ng-controller="LogoutController">
        <div class="jumbotron">
            @if (Auth::guest())
                <h1>Welcome, you can see the statistics of the trending topics<br />
                    and hashtags of interest.</h1>
                <a href="/auth/login">Sign in</a><br />
                <a href="/auth/register">Sign up</a><br />
            @else
                <h1>Welcome {{ Auth::user()->name }}, you can see the statistics of the trending topics<br />
                and hashtags of interest.</h1>

                
                    
            @endif
        </div>
        <p><a href="" ng-click="logout()">Log out</a></p>

    </div>
    <div class="content" ng-controller="MyCtrl" >  

                        <h1>Hashtags de usuario:</h1>
                        <tags-input ng-model="tags" on-tag-added="envia ( $tag.text )" on-tag-removed="elimina ( $tag.text )" >
                            <auto-complete source="loadTags($query)"></auto-complete>
                        </tags-input>
                </div>
    </body>
</html>

