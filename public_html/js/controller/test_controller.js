app.controller('TestController', TestController);

function TestController($scope,$http,$location) {

    /********* Initialize Variables ********/
    $scope.frmData = {};
    $scope.listData = {};

    /********* Get List Shorten URL ********/
    $scope.loadData = function(){
        $http.get("api/all-data").then(function (response) {
            $scope.listData = response.data.encodedUrl;
        });
    }

    /************** Submit URL ****************/
    $scope.saveUrl = function($event){
        $http.post('ng/save-data', $scope.frmData).then(function (response) {
            $('input').removeClass('has-error');
            $scope.loadData();
            $().toastmessage('showToast', {
                text     : response.data,
                sticky   : false,
                position : 'top-right',
                type     : 'success',
                closeText: '',
                close    : function () {
                    $('input').removeClass('has-error');
                }
            });
        }, function (response) {
            if (response.status == 400) {
                $.each(response.data.errors, function (index, obj) {
                    $('#' + index).addClass('has-error');
                });
            }
        });
    };
}