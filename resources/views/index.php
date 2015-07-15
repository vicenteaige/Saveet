<!DOCTYPE html>

<html ng-app="bootcamp" >

    <head>
        <title>Laravel</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <script src="/bower_components/angular/angular.js"></script>
        <script src="/bower_components/angular-resource/angular-resource.js"></script>

        <script src="/js/bootcamp.js"></script>
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
                vertical-align: middle;
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
        <div class="container">
            <div class="content" ng-controller="MainController">

               <!--
                <div class="title">Hola {{ name }}</div>
                <input type="text" ng-model="name" />
                <button ng-click="fnAlert( name )" >ALERTA</button>
                -->

                <hr />
                <section>
                    <input type="text" ng-model="buscar" />
                    <article ng-repeat="item in items | filter : buscar">
                        <h1>{{item.title}}</h1>
                        <span>{{item.desc}}</span>
                    </article>
                </section>
                <hr />
                <!--
                <div class="content" ng-controller="NameController">
                    <div class="title">Hola {{ name = 'Guillem' }}</div>
                </div>
                -->
            </div>

        </div>
    </body>
</html>

