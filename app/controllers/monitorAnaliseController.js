angular.module(["plantae"]).controller('monitorAnaliseController', function ($rootScope, $scope, inicial, $location,monitor) {
    let prepare = function(){
        monitor.getAnalise().success(function (data) {         
            $scope.analise = data;                                   
        });
    }();
    
});