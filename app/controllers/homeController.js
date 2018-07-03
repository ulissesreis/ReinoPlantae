angular.module(["plantae"]).controller('homeController', function ($rootScope, $scope, inicial, $location,plantas,sintomas,$routeParams,parametros) {
    let prepare = function () {
        plantas.get($scope.search).success(function (data) {
            $scope.plantas = data;                                        
        });
        $scope.baseImg = parametros.baseImg;
        $scope.noImage = 'noImage.png';
    };
    $scope.plantaDetalhar = function(id){                
        $location.path("/plantamedicinal/" + id);        
    };
    $scope.sintomaDetalhar = function(id){                
        $location.path("/sintoma/" + id);        
    };
    $scope.pesquisar = function(goDown = false){
        if($scope.search.tipo == 'plantas'){
            plantas.get($scope.search).success(function (data) {
                $scope.plantas = data;    
                if(goDown){
                    scroll();  
                }                                  
            });
            delete $scope.sintomas;
        }else{
            //value default -> classificacao alfabetica
            $scope.search.ordem = '3';
            
            sintomas.get($scope.search).success(function (data) {
                $scope.sintomas = data;    
                if(goDown){
                    scroll();  
                }                                  
            });
            delete $scope.plantas;
        }
    }
    let scroll = function(){
        document.querySelector('#resultados').scrollIntoView({ 
            behavior: 'smooth', 
            block:    'start'
        });
    }
    
    //* INIT
    $scope.search = {
        origem:'cliente',
        tipo:'plantas',
        ordem:'1',
        termo:null
    };    
    prepare();
});