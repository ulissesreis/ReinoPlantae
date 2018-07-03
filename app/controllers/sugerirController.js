angular.module(["plantae"]).controller('sugerirController', function ($rootScope, $scope, inicial, $location,sugestao) {
    $scope.sugestaoEnviar = function(){
        sugestao.save($scope.sugestao).success(function (data) {            
            $location.path("/");                                       
        });
    }
});