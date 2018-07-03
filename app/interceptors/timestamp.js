angular.module("plantae").factory("timestamp", function () {
    return {
        request: function (config) {
            let url = config.url;
            if (url.indexOf('views') || !url.indexOf('api') > -1) return config;
            let timestamp = new Date().getTime();
            config.url = url + "?timestamp=" + timestamp;
            return config;
        }
    };
});