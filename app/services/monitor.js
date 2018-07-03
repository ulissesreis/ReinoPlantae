angular.module("plantae").factory("monitor", function ($http, parametros) {
  let _getResposta = function () {
    return $http.get(parametros.baseUrl + "monitor/resposta");
  };
  let _getAnalise = function () {
    return $http.get(parametros.baseUrl + "monitor/analise");
  };  
  return {
    getResposta: _getResposta,
    getAnalise: _getAnalise    
  };
});