(function (params) {
    const app = angular.module('angularApp');

    function cicloController($scope, contraData, $http) {
        $scope.ciclo = { "clave": '', "fecha": '', "grupos": [], };

        $scope.seleccionadas = [];

        contraData.getAsignaturas().then(function (response) {
            $scope.asignaturas = response;
        });

        contraData.getFacilitadores().then(function (response) {
            $scope.facilitadores = response;
        });

        $scope.agregarAsignatura = function agregarGrupo(asignatura, index) {
            $scope.seleccionadas.push(asignatura);
            $scope.asignaturas.splice(index, 1);
        }

        $scope.removerAsignatura = function removerGrupo(grupo, index, test) {
            $scope.asignaturas.push(grupo);
            $scope.seleccionadas.splice(index, 1);
            $scope.ciclo.clave = test;
        }

        $scope.test = function test() {
            $scope.ciclo.clave = 'Nope';
        }
    }

    app.controller('cicloController', cicloController);
}());
