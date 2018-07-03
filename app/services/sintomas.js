angular.module("plantae").factory("sintomas", function ($http, parametros) {
    let _getUnique = function (model) {
        return $http.get(parametros.baseUrl + "sintoma", { 
            params: { model } 
        });
    };
    let _get = function (model) {
        return $http.get(parametros.baseUrl + "sintomas/", { 
            params: { model } 
        });
    };
    let _getCombo = function () {
        return $http.get(parametros.baseUrl + "combo/sintomas");
    };
    let _getAprovacao = function () {
        return $http.get(parametros.baseUrl + "aprovacao/sintomas/");
    };
    let _save = function (model) {
        return $http.post(parametros.baseUrl + "sintoma/", model);
    };
    let _aprovar = function (model) {
        return $http.post(parametros.baseUrl + "aprovacao/sintomas/", model);
    };    
    return{
        get: _get,
        getUnique: _getUnique,
        getCombo: _getCombo,
        getAprovacao:_getAprovacao,
        aprovar:_aprovar,
        save: _save
    };
});