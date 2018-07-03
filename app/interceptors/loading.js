angular.module("plantae").factory("loading", function ($q, $rootScope) {
    return {
        request: function (config) {
            $rootScope.loading = true;
            return config;
        },
        requestError: function (rejection) {
            $rootScope.loading = false;
            return $q.reject(rejection);
        },
        response: function (response) {
            $rootScope.loading = false;
            return response;
        },
        responseError: function (response) {
            $rootScope.loading = false;
            return $q.reject(response);
        }
    };
});