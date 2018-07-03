angular.module("plantae").factory("indicacoes", function ($http, parametros) {
    let _getUnique = function (model) {
        return $http.get(parametros.baseUrl + "indicacao", { 
            params: { model } 
        });
    };
    let _get = function () {
        return $http.get(parametros.baseUrl + "indicacao/");
    };
    let _getAprovacao = function () {
        return $http.get(parametros.baseUrl + "aprovacao/indicacao/");
    };
    let _save = function (model) {
        return $http.post(parametros.baseUrl + "indicacao/", model);
    };
    let _aprovar = function (model) {
        return $http.post(parametros.baseUrl + "aprovacao/indicacao/", model);
    };    
    return{
        get: _get,
        getUnique: _getUnique,
        getAprovacao:_getAprovacao,
        aprovar:_aprovar,
        save: _save
    };
});