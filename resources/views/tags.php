<!DOCTYPE html>
<html ng-app="bootcamp">
    <head>
        <title>Laravel</title>


        <script src="bower_components/angular/angular.js"></script>
        <script src="bower_components/angular-resource/angular-resource.js"></script>
        
       <!--ngTags-input - obligatoriamente tras angular-->
        <script type="text/javascript" src="bower_components/ng-tags-input/ng-tags-input.js"></script>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <!--ngTags-input-->
        <link rel="stylesheet" href="bower_components/ng-tags-input/ng-tags-input.min.css">  

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
            <div class="content" ng-controller="MyCtrl" >
                <div class="title">TAGS</div>
                <h1>Selecciona un hastag a buscar</h1>
                <input type="text" ng-model="name">
                <button ng-click=" envia ( name )">aceptar</button>            

                    <h1>ngTagsInput:</h1>
                    <tags-input ng-model="tags" on-tag-added="envia ( $tag.text )" >
                        <auto-complete source="loadTags($query)"></auto-complete>
                    </tags-input>
                </div>

 
<!--               <div ng-controller="MyCtrl">
                    <section>
                        <article ng-repeat="tag in tags">
                            <h1>{{tag}}</h1>
                        </article>
                    </section>
                </div>

<!--               <div ng-controller="MainController">
                    <section>
                        <article ng-repeat="item in items">
                            <h1>{{item.name}}</h1>
                            <span>{{item.id}}</span>
                        </article>
                    </section>
                </div>
-->
            </div>     
    </body>
</html>
