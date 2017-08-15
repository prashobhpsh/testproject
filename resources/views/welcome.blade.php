<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token()}}">

    <title>URL Shortner</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.toastmessage-min.css')}}">
    <style type="text/css">
        .cls-header{
            margin-top: 50px;
        }
        .cls-span{
            margin: 1px;
            color: red;
            font-weight: bolder;
        }
        .has-error{
            border: 2px solid #d80e0e !important;
        }
        .cls-list{
            height: 200px;
            overflow-y: scroll;
        }
        .cls-list-container{
            margin-top: 20px;
        }
    </style>
    </head>
    <body data-ng-app="testApp" data-ng-controller="TestController">
    <header class="cls-header"></header>
        <div class="col-md-12">
            <div class="col-md-6 col-md-offset-3">
                <form name="ngFrm" method="post" data-ng-submit="saveUrl($event)">
                    <div class="form-group">
                        <label> Input URL</label>
                        <input type="url" name="input_url" id="input_url" class="form-control" data-ng-class="{ 'has-error' : ngFrm.input_url.$invalid && (!ngFrm.input_url.$pristine || ngFrm.$submitted) }" data-ng-model="frmData.input_url" placeholder="Enter URL" value="" autofocus required>
                        <!-- <span class="cls-span"></span> -->
                    </div>
                    <div class="form-group">
                        <input type="submit" data-ng-disabled="ngFrm.$invalid" name="btn_submit" class="btn btn-primary pull-right" value="Generate Shortner URL">
                    </div>
                </form>
            </div>
        </div>
    
    <div class="col-md-12 cls-list-container">
        <div class="col-md-6 col-md-offset-3" data-ng-cloak>
            <h3>List Of Shorten URL</h3>
            <div class="cls-list" data-ng-show="listData.length">
                <p data-ng-repeat="data in listData"><a href="@{{data.shorten_url}}" target="_blank">{{env('DOMAIN').'/'}}@{{data.shorten_url}}</a></p>
            </div>
            <p data-ng-show="listData.length==0">No Data Found....!</p>
        </div>
    </div>

    <footer></footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/jquery.toastmessage-min.js') }}"></script>
    <script src="{{ asset('js/angular/angular.min.js')}}"></script>
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/controller/test_controller.js')}}"></script>
    </body>
</html>
