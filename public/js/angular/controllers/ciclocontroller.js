(function (params) {
    const app = angular.module('angularApp');

    function cicloController($scope, contraData, $filter) {
        $scope.test = function test(asignatura) {
            console.log(asignatura);
        }

        $scope.test2 = function test2() {
            console.log(aprovadas);
        }

        $scope.ciclo = { "clave": '', "fecha": '', "grupos": [], };
        $scope.seleccionadas = [];

        let aprovadas = [];

        // Obtiene un array de objetos asignaturas y las asigna a la variable asignaturas
        contraData.getAsignaturas().then(function (response) {
            $scope.asignaturas = response;
        });

        // Obtiene un array de objetos facilitadores y las asigna a la variable facilitadores
        contraData.getFacilitadores().then(function (response) {
            $scope.facilitadores = response;

            angular.forEach($scope.asignaturas, function (asignatura) {
                if (asignatura.aprovado === 1) {
                    aprovadas.push(asignatura);
                }
            });
        });

        // Agrega la asignatura seleccionada para el grupo del ciclo
        function agregarAsignatura(asignatura, index) {
            asignatura.grupo = $scope.ciclo.clave + '-' + asignatura.clave + '-' + asignatura.descripcion + '-10-1';
            $scope.seleccionadas.push(asignatura);
            $scope.asignaturas.splice(index, 1);
        }

        // Remueve la asignatura seleccionada para el grupo del ciclo
        $scope.removerAsignatura = function removerAsignatura(asignatura, index) {
            $scope.asignaturas.push(asignatura);
            $scope.seleccionadas.splice(index, 1);
        }

        // Asigna el ID del facilitador a la asignatura seleccionada para el grupo del ciclo
        $scope.asignarFacilitador = function asignarFacilitador(id, asignatura) {
            asignatura.facilitador = id;
        }

        $scope.validarAsignatura = function validarAsignatura(asignatura, index) {
            if (!asignatura.propedeutico) {
                var noPropedeutico = 0;

                $scope.seleccionadas.forEach(function (seleccionada) {
                    if (!seleccionada.propedeutico) {
                        noPropedeutico += 1;
                    }
                });

                if (noPropedeutico >= 5) {
                    console.log('Solo pueden inscribirse 5 asignaturas como máximo por ciclo, excluyendo los propedéuticos.');
                } else if (asignatura.aprovado) {
                    console.log('Esta asignatura ya fue aprovada.');
                } else {
                    agregarAsignatura(asignatura, index);
                    console.log('Asignatura no propedeutico agregado.');                    
                }
            } else {
                agregarAsignatura(asignatura, index);
                console.log('Asignatura propedeutico agregado.');
            }
        }

        // Llena el array de grupos del siclo con todas las asignaturas seleccionadas y sus respectivos horarios, bimestres, etc.
        $scope.fillGrupos = function fillGrupos() {
            angular.forEach($scope.seleccionadas, function (asignatura) {
                let grupo = {};
                grupo.clave = asignatura.grupo;
                grupo.horario = $filter('date')(asignatura.horario, "yyyy-MM-dd HH:mm:ss");
                grupo.facilitador = asignatura.facilitador;
                grupo.bimestre = asignatura.bimestre;
                grupo.asignatura = asignatura.id;
                $scope.ciclo.grupos.push(grupo);
            });

            $scope.ciclo.fecha = $filter('date')($scope.ciclo.fecha, "yyyy-MM-dd");

            // Mandar el request para guardar el ciclo en la base de datos
            contraData.saveCiclo($scope.ciclo);
        }
    }

    app.controller('cicloController', cicloController);
}());
