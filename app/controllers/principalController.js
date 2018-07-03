angular.module(["plantae"]).controller('principalController', function ($rootScope, $scope, inicial, $location,admin,$route) {
    /* $rootScope.getInicial = function () {
        inicial.get().success(function (data) {
            $rootScope.acesso = data[0];                            
        });
    };*/
    $scope.adminLogin = function(login){        
        admin.login(login).success(function (data) {
            $scope.acessoNegado = false;
            $location.path("/painel");         
        }).error(function (data) {
            $scope.acessoNegado = true;
        });        
    };
    $scope.adminLogout = function(login){        
        admin.logout().success(function (data) {
            $location.path("/forceRefresh");   
        });
    };
    $rootScope.toHome = function(){
        $location.path("/"); 
    }
    $rootScope.getVolumetria = function(){        
        admin.getRelatorio({ relatorio: 'volumetria' }).success(function (data) {            
            let pendencias = parseInt(data.sintomas) + parseInt(data.plantas) + parseInt(data.indicacao);
            let sugestoes = parseInt(data.sugestoes);
            
            $scope.volumetria =  {
                sugestoes,
                pendencias
            };                      
        });        
    };
    $rootScope.closeModal = function () {
        $('.modal').modal('hide');
    };
    $rootScope.acessar = function (link) {     
        $location.path("/" + link);
    }; 
    //*INIT 
    // $rootScope.getInicial();
});