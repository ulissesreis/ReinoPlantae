angular.module(["plantae"]).controller('plantaPainelController', function ($rootScope, $scope, inicial, $location,plantas,fileUpload,parametros) {
    
    let setImg = function (name = "noImage.png"){
        $scope.plantaImg = parametros.baseImg + name;
    };
    let getNomeTipo = function(){
        plantas.getNomesTipo().success(function (data) {
            $scope.TiposNome = data;                                                 
        });
    };    
    let prepare = function () {
        setImg();
        getNomeTipo();
        plantas.get({origem:'painel'}).success(function (data) {
            $scope.plantas = data;                                        
        });        
    };
    $scope.incluirPlanta = function(){
        delete $scope.plantaNomes;
        setImg();
        delete $scope.planta;
        $scope.planta= {
            status: '1'            
        }        
    };
    $scope.editarPlanta = function(id){
        delete $scope.plantaNomes;      
        setImg();
        plantas.getUnique({planta_id:id,origem:'painel'}).success(function (data) {            
            $scope.planta = data[0];
            if($scope.planta.imagem){
                setImg($scope.planta.imagem);
            };
        });
    };
    $scope.salvarPlanta = function(){        
        plantas.save($scope.planta).success(function (data) {                                                
            $scope.incluirPlanta();  
            prepare();                               
        });                    
    };  
    //* NOMES
    let clearFormName = function(){
        delete $scope.plantaNome;
        $scope.plantaNome = {
            planta_id:$scope.planta.planta_id
        };
    };
    $scope.salvarNome = function(){                
        plantas.saveNome($scope.plantaNome).success(function (data) {                        
            getNomes();
            clearFormName();
        });        
    };
    $scope.deleteNome = function(id){
        plantas.deleteNome(id).success(function (data) {                        
            getNomes();            
        });           
    };
    $scope.editarNomes = function(){
        getNomes();
        clearFormName();
        $('#plantaNomes').modal('show');                     
    };
    let getNomes = function(){
        plantas.getNomes({planta_id:$scope.planta.planta_id}).success(function (data) {            
            $scope.plantaNomes = data;                         
        });
    };

    //*FILE
    $scope.uploadFile = function () {
        var file = $scope.myFile;        
        promise = fileUpload.uploadFileToUrl(file);
        
        promise.then(function (response) {          
            $scope.plantaImg = parametros.baseImg + response.image;                    
        }, function (response) {
            setImg();
            $scope.msgError = response.message;            
            $('#modalError').modal('show');
        });
    };
    
    //*INIT
    prepare();
    $rootScope.getVolumetria();
});