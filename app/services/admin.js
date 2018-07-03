angular.module("plantae").factory("admin", function ($http, parametros) {
  let _getAdmin = function () {
    return $http.get(parametros.baseUrl + "admin/");
  };
  let _getRelatorio = function (model) {
    return $http.get(parametros.baseUrl + "relatorio/", { 
      params: { model } 
    });
  };
  let _login = function (data) {
    return $http.post(parametros.baseUrl + "login/",data);
  };
  let _logout = function () {
    return $http.post(parametros.baseUrl + "logout/");
  };
  return {
    getAdmin: _getAdmin,
    getRelatorio: _getRelatorio,
    login:_login,
    logout:_logout
  };
});