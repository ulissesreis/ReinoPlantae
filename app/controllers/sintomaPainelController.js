angular.module(["plantae"]).controller('sintomaPainelController', function ($rootScope, $scope, inicial, $location,sintomas) {    
    let prepare = function () {
        sintomas.get({origem:'painel'}).success(function (data) {
            $scope.sintomas = data;                                        
        });
    };
    $scope.incluirSintoma = function(){
        delete $scope.sintoma;
        $scope.sintoma= {
            status: '1'            
        }        
    };
    $scope.editarSintoma = function(id){
        sintomas.getUnique({sintoma_id:id,origem:'painel'}).success(function (data) {            
            $scope.sintoma = data[0];                                                      
        });
    };
    $scope.salvarSintoma = function(){        
        sintomas.save($scope.sintoma).success(function (data) {                                                            
            prepare();                                   
        });                    
    };    
    //*INIT
    prepare();  
    $rootScope.getVolumetria();
});