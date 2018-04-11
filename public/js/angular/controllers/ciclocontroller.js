(function (params) {
    const app = angular.module('angularApp');

    function cicloController($scope) {
        $scope.ciclo = {};

        $scope.grupos = [];

        $scope.asignaturas = ['Asignatura 1', 'Asignatura 2', 'Asignatura 3', 'Asignatura 4', 'Asignatura 5', 'Asignatura 6'];

        $scope.agregarGrupo = function agregarGrupo(asignatura, index) {
            $scope.grupos.push(asignatura);
            $scope.asignaturas.splice(index, 1);
        }

        $scope.removerGrupo = function removerGrupo(grupo, index) {
            $scope.asignaturas.push(grupo);
            $scope.grupos.splice(index, 1);
        }
    }

    app.controller('cicloController', cicloController);
}());
