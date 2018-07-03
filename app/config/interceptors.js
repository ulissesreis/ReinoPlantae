angular.module("plantae").config(function ($httpProvider){
   $httpProvider.interceptors.push("timestamp");   
   $httpProvider.interceptors.push("loading");   
});