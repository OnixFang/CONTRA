(function (params) {
    const app = angular.module('angularApp');

    function cicloController($scope, contraData, $http) {
        $scope.ciclo = { "clave": '', "fecha": '', "grupos": [], };

        $scope.seleccionadas = [];

        // Llena el array de grupos del siclo con todas las asignaturas seleccionadas y sus respectivos horarios, bimestres, etc.
        function fillGrupos() {
            angular.forEach($scope.seleccionadas, function (asignatura) {
                let grupo = {};
                grupo.clave = asignatura.grupo;
                grupo.horario = asignatura.horario;
                grupo.facilitador = asignatura.facilitador;
                grupo.bimestre = asignatura.bimestre;
                grupo.asignatura = asignatura.id;
                $scope.ciclo.grupos.push(grupo);
            });
            
            // Mandar el request para guardar el ciclo en la base de datos
            contraData.saveCiclo($scope.ciclo);
        }

        // Obtiene un array de objetos asignaturas y las asigna a la variable asignaturas
        contraData.getAsignaturas().then(function (response) {
            $scope.asignaturas = response;
        });

        // Obtiene un array de objetos facilitadores y las asigna a la variable facilitadores
        contraData.getFacilitadores().then(function (response) {
            $scope.facilitadores = response;
        });

        // Agrega la asignatura seleccionada para el grupo del ciclo
        $scope.agregarAsignatura = function agregarGrupo(asignatura, index) {
            asignatura.grupo = $scope.ciclo.clave + '-' + asignatura.clave + '-10-1';
            $scope.seleccionadas.push(asignatura);
            $scope.asignaturas.splice(index, 1);
        }

        // Remueve la asignatura seleccionada para el grupo del ciclo
        $scope.removerAsignatura = function removerGrupo(grupo, index) {
            $scope.asignaturas.push(grupo);
            $scope.seleccionadas.splice(index, 1);
        }

        // Asigna el ID del facilitador a la asignatura seleccionada para el grupo del ciclo
        $scope.asignarFacilitador = function asignarFacilitador(id, asignatura) {
            asignatura.facilitador = id;
        }

        $scope.fillGrupos = fillGrupos;
    }

    app.controller('cicloController', cicloController);
}());
