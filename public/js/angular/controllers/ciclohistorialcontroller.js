(function () {
    const app = angular.module('angularApp');

    function cicloHistorialController($scope, contraData) {
        $scope.noCiclos = false;
        $scope.noIndice = true;
        $scope.indices = [];
        let puntosAcumulados = 0;
        let creditosAcumulados = 0;

        // Obtiene toda la data de los ciclos y sus grupos
        contraData.getInscripcionCiclos($scope.userId).then(function (response) {
            $scope.ciclos = response;

            if ($scope.ciclos.length < 1) {
                $scope.noCiclos = true;
                $scope.noIndice = true;
            }
        });

        // Calcula el literal de la calificacion
        $scope.calcularLiteral = function calcularLiteral(calificacion) {
            let literal = '';
            if (calificacion >= 90) {
                literal = 'A';
            } else if (calificacion >= 80 && calificacion <= 89) {
                literal = 'B';
            } else if (calificacion >= 70 && calificacion <= 79) {
                literal = 'C';
            } else if (calificacion >= 60 && calificacion <= 69) {
                literal = 'D';
            } else if (calificacion >= 1 && calificacion <= 59) {
                literal = 'F';
            } else if (calificacion == 0) {
                literal = '-';
            }

            return literal;
        }

        // Calcula los puntos basado en el literal de la calificacion
        $scope.calcularPuntos = function calcularPuntos(literal, credito) {
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

        $scope.calcularIndice = function calcularIndice(puntos, creditos) {
            let indice = puntos / creditos;
            puntosAcumulados += puntos;
            creditosAcumulados += creditos;
            $scope.indices.push(indice);
            return indice;
        }

        $scope.indiceAcumulado = function indiceAcumulado() {
            let indiceAcumulado = 0;

            indiceAcumulado = puntosAcumulados / creditosAcumulados;
            $scope.noIndice = false;

            return indiceAcumulado;
        }

        $scope.sumarCredito = function sumarCredito(credito, estado, nota) {
            if (estado == 'N' && nota != 0) {
                return credito;
            }
            else {
                return 0;
            }
        }
    }

    app.controller('cicloHistorialController', cicloHistorialController);
}());
