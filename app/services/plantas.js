angular.module("plantae").factory("plantas", function ($http, parametros) {
    let _get = function (model) {
        return $http.get(parametros.baseUrl + "plantas/", { 
            params: { model } 
        });
    };
    let _getUnique = function (model) {
        return $http.get(parametros.baseUrl + "planta/", { 
            params: { model } 
        });
    };
    let _getNomes = function (model) {
        return $http.get(parametros.baseUrl + "planta/nomes/", { 
            params: { model } 
        });
    };
    let _getNomesTipo = function () {
        return $http.get(parametros.baseUrl + "planta/nomes/tipo/");
    };
    let _getAprovacao = function () {
        return $http.get(parametros.baseUrl + "aprovacao/plantas/");
    };
    let _getCombo = function () {
        return $http.get(parametros.baseUrl + "combo/plantas");
    };
    let _save = function (model) {
        return $http.post(parametros.baseUrl + "planta/", model);
    };
    let _saveNome = function (model) {
        return $http.post(parametros.baseUrl + "planta/nomes/", model);
    };
    let _deleteNome = function (nome_id) {
        return $http.delete(parametros.baseUrl + "planta/nomes/"+ nome_id+"/");
    };
    let _aprovar = function (model) {
        return $http.post(parametros.baseUrl + "aprovacao/plantas/", model);
    };
    let _saveRating = function (model) {
        return $http.post(parametros.baseUrl + "rating/planta/", model);
    };
    return{
        get: _get,
        getUnique: _getUnique,
        getNomes: _getNomes,
        getCombo: _getCombo,
        deleteNome:_deleteNome,
        getNomesTipo: _getNomesTipo,
        getAprovacao:_getAprovacao,
        save: _save,
        saveNome: _saveNome,
        aprovar:_aprovar,
        saveRating: _saveRating
    };
});