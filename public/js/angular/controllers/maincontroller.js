(function () {
    const app = angular.module('angularApp');

    function mainController($scope) {
        $scope.message = 'AngularJS has been integrated in this app. A variable is binded to this span element.';
    }

    app.controller('mainController', mainController);
}());
