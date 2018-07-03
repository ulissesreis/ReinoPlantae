angular.module("plantae").factory("inicial", function ($http, parametros) {
    let _get = function () {
        return $http.get(parametros.baseUrl + "cargainicial/");
    };    
    return{
        get: _get        
    };
});