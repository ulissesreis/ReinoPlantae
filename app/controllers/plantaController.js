angular.module(["plantae"]).controller('plantaController', function ($rootScope, $scope, inicial, $location,plantas,$routeParams,parametros) {
    
    $scope.viewIndicacao = function(indicacao){
        $scope.indicacao = indicacao;
        $('#indicacaoModal').modal();
    }
    $scope.viewSintoma = function(){
        $rootScope.closeModal();        
        $location.path("/sintoma/" + $scope.indicacao.sintoma_id); 
    }
    $scope.classificar = function(){        
        if(!$scope.classificou){
            plantas.saveRating($scope.planta);
        }    
        $scope.classificou = true;
    }
    let setImg = function (name = "noImage.png"){
        $scope.plantaImg = parametros.baseImg + name;
    }    
    let prepare = function () {
        $scope.baseImg = parametros.baseImg;
        $scope.noImage = 'noImage.png';

        if($routeParams.id){            
            plantas.getUnique({planta_id:$routeParams.id,origem:'cliente'}).success(function (data) {
                if(data.length == 0){
                     $location.path("/"); 
                }                
                $scope.planta = data[0];      
                if($scope.planta.imagem){
                    setImg($scope.planta.imagem);
                }                                                         
            });
            $scope.classificou = false;
        }else{            
            $location.path("/");     
        }       
    }();
    
    
});