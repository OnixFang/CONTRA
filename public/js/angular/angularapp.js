(function () {
    const app = angular.module('angularApp', []);

    app.config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
}());
