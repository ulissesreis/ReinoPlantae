angular.module(["plantae"]).controller('sintomaController', function ($rootScope, $scope, inicial, $location,sintomas,$routeParams,parametros) {
    
    $scope.viewPlanta = function(planta_id){
        $location.path("/plantamedicinal/" + planta_id); 
    };
    $scope.viewIndicacaoPlanta = function(planta){
        $scope.planta = planta;
        $('#indicacaoModal').modal();
    }
    let prepare = function () {
        $scope.baseImg = parametros.baseImg;
        $scope.noImage = 'noImage.png';
        
        if($routeParams.id){
            sintomas.getUnique({sintoma_id:$routeParams.id,origem:'cliente'}).success(function (data) {
                if(data.length == 0){
                    $location.path("/"); 
                }
                $scope.sintoma = data[0];                                                           
            });
        }else{
            $location.path("/"); 
        }
    }();    
});