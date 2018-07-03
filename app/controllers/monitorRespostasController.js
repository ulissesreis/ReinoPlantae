angular.module(["plantae"]).controller('monitorRespostasController', function ($rootScope, $scope, inicial, $location,monitor) {
    let prepare = function(){
        monitor.getResposta().success(function (data) {            
            $scope.respostas = data;                                
        });
    }();
});