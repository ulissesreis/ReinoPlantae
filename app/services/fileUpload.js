angular.module("plantae").service('fileUpload', function ($http, $q,parametros) {

    this.uploadFileToUrl = function (file) {
        //FormData, object of key/value pair for form fields and values
        var fileFormData = new FormData();
        fileFormData.append('file', file);

        var deffered = $q.defer();
        $http.post(parametros.baseUrl + "midia/planta/", fileFormData, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}

        }).success(function (response) {
            deffered.resolve(response);

        }).error(function (response) {
            deffered.reject(response);
        });

        return deffered.promise;
    }
});