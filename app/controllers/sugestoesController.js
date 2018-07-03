angular.module(["plantae"]).controller('sugestoesController', function ($rootScope, $scope, $location,$routeParams,sugestao) {
    
    let prepare = function(){
        sugestao.get().success(function (data) {
            $scope.sugestoes = data;                                                    
        });   
    }
    $scope.deletarSugestao = function(modelSugest){
        sugestao.delete(modelSugest).success(function () {                       
            prepare();
        });
    }
    //*INIT
    prepare();    
});