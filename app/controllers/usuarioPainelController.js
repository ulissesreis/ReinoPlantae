angular.module(["plantae"]).controller('usuarioPainelController', function ($rootScope, $scope, inicial, $location,usuarios) {
    
    let prepare = function () {
        usuarios.get().success(function (data) {
            $scope.usuarios = data;                                        
        });
    };
    $scope.incluirUsuario = function(){
        delete $scope.usuario;
        $scope.usuario= {
            status: '1',
            perfil: '1'
        }        
    };
    $scope.editarUsuario = function(id){
        usuarios.getUnique({user_id:id}).success(function (data) {            
            $scope.usuario = data[0];                                              
        });
    };

    $scope.salvarUsuario = function(){
        if($scope.usuario.user_id){
            usuarios.update($scope.usuario).success(function () {                                                
                prepare();                                   
            });
        }else{
            usuarios.save($scope.usuario).success(function () {                                                
                prepare();                                   
            });            
        }                
    };    
    //*INIT
    prepare();    
    $rootScope.getVolumetria();
});