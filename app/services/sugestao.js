angular.module("plantae").factory("sugestao", function ($http, parametros) {    
    let _save = function (model) {
        return $http.post(parametros.baseUrl + "sugestao/", model);
    }; 
    let _get = function (model) {
        return $http.get(parametros.baseUrl + "sugestao/", { 
            params: { model } 
        });
    };
    let _delete = function (model) {
        return $http.delete(parametros.baseUrl + "sugestao/", { 
            params: { model } 
        });
    };
    return{
        get:_get,        
        save: _save,
        delete:_delete
    };
});