(function () {
    const app = angular.module('angularApp');

    function cicloHistorialController($scope, contraData) {
        $scope.message = 'AngularJS has been integrated in this app. A variable is binded to this span element.';

        contraData.getCiclosCerrados().then(function (response) {
            $scope.ciclos = response;
        });

        $scope.test = function test() {
            console.log($scope.ciclos);
        }
    }

    app.controller('cicloHistorialController', cicloHistorialController);
}());
