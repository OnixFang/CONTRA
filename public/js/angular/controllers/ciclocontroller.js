(function (params) {
    const app = angular.module('angularApp');

    function cicloController($scope, contraData, $filter) {
        $scope.ciclo = { "clave": '', "fecha": '', "grupos": [], };
        $scope.seleccionadas = [];
        $scope.prerrequisitos = [];
        $scope.tempAsignatura = null;
        $scope.showAgregar = false;

        let aprovadas = []; // Arreglo de asignaturas aprovadas

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

        // Funcion para agregar asignatura desde el modal
        $scope.agregarTempAsignatura = function agregarTempAsignatura(tempAsignatura) {
            agregarAsignatura(tempAsignatura);
            $('#cicloModal').modal('hide');
            $scope.clearModalMessage();
        }
        
        // Agrega la asignatura seleccionada para el grupo del ciclo
        function agregarAsignatura(asignatura) {
            $scope.seleccionadas.push(asignatura);
            asignatura.hidden = true; // Esconde la asignatura (hide element)
        }

        // Remueve la asignatura seleccionada para el grupo del ciclo
        $scope.removerAsignatura = function removerAsignatura(asignatura, index) {
            // Busca la asignatura a remover de las seleccionadas para mostrarla (remove hidden)
            for (let i = 0; i < $scope.asignaturas.length; i += 1) {
                if (asignatura.id === $scope.asignaturas[i].id) {
                    $scope.asignaturas[i].hidden = false;
                    break;
                }
            }
            $scope.seleccionadas.splice(index, 1); // Remueve la asignatura de las asignaturas seleccionadas para el ciclo
        }

        // Asigna el ID del facilitador a la asignatura seleccionada para el grupo del ciclo
        $scope.asignarFacilitador = function asignarFacilitador(id, asignatura) {
            asignatura.facilitador = id;
        }

        // Actualiza la clave del grupo cuando hay un cambio en la clave del ciclo
        $scope.actualizarGrupoClaveAll = function actualizarGrupoClaveAll() {
            angular.forEach($scope.seleccionadas, function (asignatura) {
                asignatura.grupo = $scope.ciclo.clave + '-' + asignatura.clave + '-' + asignatura.descripcion + '-' + asignatura.seccion + '-' + asignatura.bimestre;
            })
        }

        // Actualiza la clave del grupo cuando hay un cambio en la seccion y el bimestre
        $scope.actualizarGrupoClave = function actualizarGrupoClave(asignatura) {
            asignatura.grupo = $scope.ciclo.clave + '-' + asignatura.clave + '-' + asignatura.descripcion + '-' + asignatura.seccion + '-' + asignatura.bimestre;
        }

        // Lógica exaustiva para confirmar si la asignatura puede ser cursada sin restricciones o prerrequisitos pendiendes
        $scope.validarAsignatura = function validarAsignatura(asignatura) {
            // Agregar la asignatura a una variable temporal
            $scope.tempAsignatura = asignatura;
            // Confirmar si la asignatura es propedéutico
            if (!asignatura.aprovado) {
                if (!asignatura.propedeutico) {
                    var noPropedeutico = 0; // Inicializacion de numero de asignaturas seleccionadas

                    // Verificar numero actual de asignaturas seleccionadas
                    angular.forEach($scope.seleccionadas, function (seleccionada) {
                        if (!seleccionada.propedeutico) {
                            noPropedeutico += 1;
                        }
                    });

                    // Confirmar si se ha llegado al limite de asignaturas por ciclo
                    if (noPropedeutico >= 5) {
                        $scope.modalMessage = 'Solo pueden inscribirse 5 asignaturas como máximo por ciclo, excluyendo los propedéuticos. Por favor, reorganice las asignaturas si es necesario.';
                        $('#cicloModal').modal('show');
                        console.log('Solo pueden inscribirse 5 asignaturas como máximo por ciclo, excluyendo los propedéuticos.');
                    }
                    // Confirmar si la asignatura contiene prerrequisitos
                    else if (asignatura.pre_requisito1 !== null || asignatura.pre_requisito2 !== null) {
                        // Utilizando for loops - Angular JS no tiene soporte para breaks en su forEach
                        let prerrequisito1 = false;
                        let prerrequisito2 = false;

                        // Confirmar si el prerrequisito 1 ya se ha cumplido
                        if (asignatura.pre_requisito1 !== null) {
                            for (let i = 0; i < aprovadas.length; i += 1) {
                                if (asignatura.pre_requisito1 === aprovadas[i].id) {
                                    console.log('Prerrequisito 1 aprovado! ' + aprovadas[i].descripcion);
                                    prerrequisito1 = true;
                                    break;
                                } else {
                                    console.log('Prerrequisito 1 no coincide: ' + aprovadas[i].descripcion);
                                }
                            }
                        } else {
                            prerrequisito1 = true;
                        }

                        // Confirmar si el prerrequisito 2 ya se ha cumplido
                        if (asignatura.pre_requisito2 !== null) {
                            for (let i = 0; i < aprovadas.length; i += 1) {
                                if (asignatura.pre_requisito2 === aprovadas[i].id) {
                                    console.log('Prerrequisito 2 aprovado! ' + aprovadas[i].descripcion);
                                    prerrequisito2 = true;
                                    break;
                                } else {
                                    console.log('Prerrequisito 2 no coincide: ' + aprovadas[i].descripcion);
                                }
                            }
                        } else {
                            prerrequisito2 = true;
                        }

                        console.log('Prerrequisito1: ' + prerrequisito1);
                        console.log('Prerrequisito2: ' + prerrequisito2);

                        // Confirmar cual prerrequisito no está cumplido
                        if (!prerrequisito1 || !prerrequisito2) {
                            if (!prerrequisito1) {
                                for (let i = 0; i < $scope.asignaturas.length; i += 1) {
                                    if (asignatura.pre_requisito1 === $scope.asignaturas[i].id) {
                                        console.log('Prerrequisito 1 no aprovado: ' + $scope.asignaturas[i].descripcion);
                                        $scope.prerrequisitos.push($scope.asignaturas[i].descripcion);
                                        break;
                                    }
                                }
                            }

                            if (!prerrequisito2) {
                                for (let i = 0; i < $scope.asignaturas.length; i += 1) {
                                    if (asignatura.pre_requisito2 === $scope.asignaturas[i].id) {
                                        console.log('Prerrequisito 2 no aprovado: ' + $scope.asignaturas[i].descripcion);
                                        $scope.prerrequisitos.push($scope.asignaturas[i].descripcion);
                                        break;
                                    }
                                }
                            }

                            $scope.modalMessage = 'Usted aún no ha aprobado las asignaturas que esta asignatura tiene como prerrequisito:';
                            $scope.showAgregar = true;
                            $('#cicloModal').modal('show');
                        }
                        // En caso de que ambos prerrequisitos estén aprovados
                        else {
                            console.log('Prerrequisitos aprovados');
                            agregarAsignatura(asignatura);
                            console.log('Asignatura no propedeutico agregado.');
                        }
                    }
                    // En caso de que ambos prerrequisitos sean nulos
                    else {
                        console.log('Prerrequisitos nulos');
                        agregarAsignatura(asignatura);
                        console.log('Asignatura no propedeutico agregado.');
                    }
                }

                // En caso de que la asignatura sea propedéutico
                else {
                    agregarAsignatura(asignatura);
                    console.log('Asignatura propedeutico agregado.');
                }
            }

            // En caso de que la asignatura ya esté aprovada
            else {
                $scope.modalMessage = 'Esta asignatura ya fue aprovada.';
                $('#cicloModal').modal('show');
                console.log('Esta asignatura ya fue aprovada.');
            }
        } // Fin de la validación

        // Llena el array de grupos del siclo con todas las asignaturas seleccionadas y sus respectivos horarios, bimestres, etc.
        $scope.fillGrupos = function fillGrupos() {
            let bimestre1 = 0;
            let bimestre2 = 0;
            angular.forEach($scope.seleccionadas, function (asignatura) {
                if (asignatura.bimestre === 1) {
                    bimestre1 += 1;
                } else {
                    bimestre2 += 1;
                }
            });
            if (bimestre1 > 3 || bimestre2 > 3) {
                $scope.modalMessage = "Sólo se permiten 3 asignaturas por bimestre. Por favor, reorganice sus asignaturas e intente de nuevo."
                $('#cicloModal').modal('show');
            } else {
                angular.forEach($scope.seleccionadas, function (asignatura) {
                    let grupo = {};
                    grupo.clave = asignatura.grupo;
                    grupo.horario = $filter('date')(asignatura.horario, "yyyy-MM-dd HH:mm:ss"); // Dar formato apropiado al horario del grupo
                    grupo.facilitador = asignatura.facilitador;
                    grupo.bimestre = asignatura.bimestre;
                    grupo.asignatura = asignatura.id;
                    $scope.ciclo.grupos.push(grupo);
                });

                // Dar formato apropiado a la fecha del ciclo
                $scope.ciclo.fecha = $filter('date')($scope.ciclo.fecha, "yyyy-MM-dd");

                // Mandar el request para guardar el ciclo en la base de datos
                contraData.saveCiclo($scope.ciclo);
            }
        }

        $scope.clearModalMessage = function clearModalMessage() {
            $scope.modalMessage = '';
            $scope.prerrequisitos = [];
            $scope.tempAsignatura = null;
            $scope.showAgregar = false;
        }
    }

    app.controller('cicloController', cicloController);
}());
