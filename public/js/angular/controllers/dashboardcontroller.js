(function () {
    const app = angular.module('angularApp');

    function dashboardController($scope, contraData) {
        $scope.message = 'AngularJS has been integrated in this app. A variable is binded to this span element.';
        $scope.noCiclos = false;
        $scope.noIndice = true;
        $scope.indices = [];

        function calcularPuntos(literal, credito) {
            let puntos = 0;
            switch (literal) {
                case 'A':
                    puntos = 4;
                    break;
                case 'B':
                    puntos = 3;
                    break;
                case 'C':
                    puntos = 2;
                    break;
                case 'D':
                    puntos = 1;
                    break;
                default:
                    break;
            }

            return puntos * credito;
        }

        // Obtiene toda la data de los ciclos y sus grupos
        contraData.getInscripcionCiclos(1).then(function (response) {
            $scope.ciclos = response;

            if ($scope.ciclos.length < 1) {
                $scope.noCiclos = true;
                $scope.noIndice = true;
            }

            let grupos = [];
            angular.forEach($scope.ciclos, function (value) {
                angular.forEach(value, function (value) {
                    grupos.push(value);
                });
            });

            let puntosAcumulados = 0;
            let creditosAcumulados = 0;
            angular.forEach(grupos, function (value) {
                if (value.estado == 'N' && value.nota != 0) {
                    creditosAcumulados += value.creditoAsignatura;
                    puntosAcumulados += calcularPuntos(value.literal, value.creditoAsignatura);
                }
                else {

                }
            });

            if (puntosAcumulados == 0 || creditosAcumulados == 0) {
                $scope.noIndice = true;
            } else {
                $scope.noIndice = false;
            }

            $scope.indiceAcumulado = puntosAcumulados / creditosAcumulados;
        });

    }
    app.controller('dashboardController', dashboardController);
}());
