angular.module("plantae", ["ngRoute", "ngMask", "maskMoney","angularUtils.directives.dirPagination"]).config(['$locationProvider', function ($locationProvider) {
    $locationProvider.hashPrefix('');
}]).filter('datahora', [
    '$filter', function ($filter) {
        return function (input, format) {
            if (!!input || input !== null) {
                return $filter('date')(new Date(input), format);
            } else {
                return null;
            }
        };
    }
]).run(function ($rootScope, $location,inicial) {
    
    //Rotas que necessitam do login
    var bloqueadasPainel = ['/painel','/painel/planta','/painel/sintoma','/painel/usuario'];    
    //ROTAS restritas ao ADM
    var rotasRestritasAdm = ['/painel/usuario'];        
    //ROTAS restritas ao PROFESSOR
    var rotasRestritasProfessor = ['/painel/aprovacao'];
    
    
    $rootScope.$on('$locationChangeStart', function () { //iremos chamar essa função sempre que o endereço for alterado
        //console.log("run perfil validation");
        inicial.get().success(function (usuario) {                          
            if(!usuario.painel){
                if(bloqueadasPainel.indexOf($location.path()) != -1){
                    $location.path('/');
                }
            }else if(usuario.perfil <3 && rotasRestritasAdm.indexOf($location.path()) != -1){               
                $location.path('/')
            }                        
            if(usuario.perfil <2 &&rotasRestritasProfessor.indexOf($location.path()) != -1){               
                $location.path('/')
            }
            $rootScope.userLogin = usuario;                                         
        }).error(function () {
            $location.path('/');            
        });    
        
    });
});
