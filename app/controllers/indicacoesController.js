angular.module(["plantae"]).controller('indicacoesController', function ($rootScope, $scope, inicial, $location,indicacoes,plantas,sintomas) {
    let prepare = function () {
        indicacoes.get({origem:'painel'}).success(function (data) {
            $scope.indicacoes = data;                                        
        });        
    };
    let getCombos = function(){
        plantas.getCombo().success(function (data) {
            $scope.plantas = data;                                            
        });
        sintomas.getCombo().success(function (data) {
            $scope.sintomas = data;                                    
        });
    }
    $scope.incluirIndicacao = function(){
        delete $scope.indicacao;
        $scope.indicacao= {
            status: '1'            
        };        
    };
    $scope.editarIndicacao = function(indicacao){                   
            $scope.indicacao = indicacao;                                 
    };
    $scope.salvarIndicacao = function(){        
        indicacoes.save($scope.indicacao).success(function (data) {                                                            
            prepare();                                   
        });        
    };    
    //*INIT
    prepare();  
    getCombos();
    $rootScope.getVolumetria();    
});