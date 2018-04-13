(function (params) {
    const app = angular.module('angularApp');

    function cicloController($scope, contraData, $http) {
        $scope.ciclo = {};

        $scope.grupos = [];

        contraData.getAsignaturas().then(function (response) {
            $scope.asignaturas = response;
        });

        // $scope.asignaturas = $http.get('api/asignatura_api').then(function (response) {
        //     console.log(response.data);
        //     return response.data;
        // });

        $scope.agregarGrupo = function agregarGrupo(asignatura, index) {
            $scope.grupos.push(asignatura);
            $scope.asignaturas.splice(index, 1);
        }

        $scope.removerGrupo = function removerGrupo(grupo, index) {
            $scope.asignaturas.push(grupo);
            $scope.grupos.splice(index, 1);
        }

        $scope.test = function test() {
            console.log($scope.asignaturas);
        }
    }

    app.controller('cicloController', cicloController);
}());
