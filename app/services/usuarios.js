angular.module("plantae").factory("usuarios", function ($http, parametros) {    
    let _get = function () {
        return $http.get(parametros.baseUrl + "usuarios/");
    }; 
    let _getUnique = function (model) {
        return $http.get(parametros.baseUrl + "usuario/", { 
            params: { model } 
        });
    };
    let _save = function (model) {
        return $http.post(parametros.baseUrl + "usuario/", model);
    };
    let _update = function (model) {
        return $http.put(parametros.baseUrl + "usuario/", model);
    }; 
    return{        
        get: _get,
        getUnique: _getUnique,
        save: _save,
        update: _update
    };
});