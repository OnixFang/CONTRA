(function () {
    const app = angular.module('angularApp');

    function cicloHistorialController($scope, contraData) {
        $scope.message = 'AngularJS has been integrated in this app. A variable is binded to this span element.';

        contraData.getCiclosCerrados().then(function (response) {
            $scope.ciclos = response;
        });

        $scope.calcularLiteral = function calcularLiteral(calificacion) {
            let literal = '';
            if (calificacion >= 90) {
                literal = 'A';
            } else if (calificacion >= 80 && calificacion <=89) {
                literal = 'B';
            } else if (calificacion >= 70 && calificacion <=79) {
                literal = 'C';
            } else if (calificacion <=69) {
                literal = 'D';
            }

            return literal;
        }
    }

    app.controller('cicloHistorialController', cicloHistorialController);
}());
