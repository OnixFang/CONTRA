(function () {
    const app = angular.module('angularApp');

    function preseleccionController($scope, contraData) {
        $scope.ciclo = {};
        $scope.ciclo.clave = calcularCicloClave();
        $scope.asignaturas = [];
        $scope.seleccionadas = [];
        $scope.prerrequisitos = [];
        $scope.tempAsignatura = null;
        $scope.showAgregar = false;

        let prematricula = [];

        let allAsignaturas = []; // Arreglo de TODAS las asignaturas del pensum del usuario
        let aprobadas = []; // Arreglo de asignaturas aprobadas

        contraData.getAllAsignaturas($scope.userId).then(function (response) {
            allAsignaturas = response;
        })

        contraData.getAsignaturasAprobadas($scope.userId).then(function (response) {
            aprobadas = response;
        })

        // Obtiene un array de objetos asignaturas y las asigna a la variable asignaturas
        contraData.getGrupos($scope.userId).then(function (response) {
            angular.forEach(response, function (asignatura) {
                if (asignatura.aprobado === false) {
                    $scope.asignaturas.push(asignatura);
                }
            });
        });

        function calcularCicloClave() {
            const currentDate = new Date();
            const month = currentDate.getMonth();
            const year = currentDate.getFullYear();

            if (month <= 4) {
                return year + '-' + 1;
            } else if (month <= 8) {
                return year + '-' + 2;
            } else if (month <= 12) {
                return year + '-' + 3;
            }
        }

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

        // Actualiza la clave del grupo cuando hay un cambio en la clave del ciclo
        $scope.actualizarGrupoClaveAll = function actualizarGrupoClaveAll() {
            angular.forEach($scope.seleccionadas, function (asignatura) {
                asignatura.grupo = asignatura.clave + '-' + asignatura.descripcion;
            })
        }

        // Actualiza la clave del grupo cuando hay un cambio en la seccion y el bimestre
        $scope.actualizarGrupoClave = function actualizarGrupoClave(asignatura) {
            asignatura.grupo = asignatura.clave + '-' + asignatura.descripcion;
        }

        // Lógica exaustiva para confirmar si la asignatura puede ser cursada sin restricciones o prerrequisitos pendiendes
        $scope.validarAsignatura = function validarAsignatura(asignatura) {
            // Agregar la asignatura a una variable temporal
            $scope.tempAsignatura = asignatura;
            // Confirmar si la asignatura es propedéutico
            if (!asignatura.aprobado) {
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
                            for (let i = 0; i < aprobadas.length; i += 1) {
                                if (asignatura.pre_requisito1 === aprobadas[i].id) {
                                    console.log('Prerrequisito 1 aprobado! ' + aprobadas[i].descripcion);
                                    prerrequisito1 = true;
                                    break;
                                } else {
                                    console.log('Prerrequisito 1 no coincide: ' + aprobadas[i].descripcion);
                                }
                            }
                        } else {
                            prerrequisito1 = true;
                        }

                        // Confirmar si el prerrequisito 2 ya se ha cumplido
                        if (asignatura.pre_requisito2 !== null) {
                            for (let i = 0; i < aprobadas.length; i += 1) {
                                if (asignatura.pre_requisito2 === aprobadas[i].id) {
                                    console.log('Prerrequisito 2 aprobado! ' + aprobadas[i].descripcion);
                                    prerrequisito2 = true;
                                    break;
                                } else {
                                    console.log('Prerrequisito 2 no coincide: ' + aprobadas[i].descripcion);
                                }
                            }
                        } else {
                            prerrequisito2 = true;
                        }

                        console.log('Prerrequisito1: ' + prerrequisito1);
                        console.log('Prerrequisito1: ' + asignatura.pre_requisito1);
                        console.log('Prerrequisito2: ' + prerrequisito2);
                        console.log('Prerrequisito2: ' + asignatura.pre_requisito2);

                        // Confirmar cual prerrequisito no está cumplido
                        if (!prerrequisito1 || !prerrequisito2) {
                            console.log('Confirmar cual prerrequisito no está cumplido');
                            if (!prerrequisito1) {
                                for (let i = 0; i < allAsignaturas.length; i += 1) {
                                    console.log('pre 1 for iteration: ' + i);
                                    if (asignatura.pre_requisito1 === allAsignaturas[i].id) {
                                        console.log('Prerrequisito 1 no aprobado: ' + allAsignaturas[i].descripcion);
                                        $scope.prerrequisitos.push(allAsignaturas[i].descripcion);
                                        break;
                                    }
                                }
                            } else {
                                console.log('Prerequisito 1 : true');
                            }

                            if (!prerrequisito2) {
                                for (let i = 0; i < allAsignaturas.length; i += 1) {
                                    console.log('pre 2 for iteration: ' + i);
                                    if (asignatura.pre_requisito2 === allAsignaturas[i].id) {
                                        console.log('Prerrequisito 2 no aprobado: ' + allAsignaturas[i].descripcion);
                                        $scope.prerrequisitos.push(allAsignaturas[i].descripcion);
                                        break;
                                    }
                                }
                            } else {
                                console.log('Prerequisito 2 : true');
                            }

                            $scope.modalMessage = 'Usted aún no ha aprobado las asignaturas que esta asignatura tiene como prerrequisito:';
                            $scope.showAgregar = true;
                            $('#cicloModal').modal('show');
                        }
                        // En caso de que ambos prerrequisitos estén aprobados
                        else {
                            console.log('Prerrequisitos aprobados');
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

            // En caso de que la asignatura ya esté aprobada
            else {
                $scope.modalMessage = 'Esta asignatura ya fue aprobada.';
                $('#cicloModal').modal('show');
                console.log('Esta asignatura ya fue aprobada.');
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
                    grupo.clave = $scope.ciclo.clave;
                    grupo.id = asignatura.grupoId;
                    prematricula.push(grupo);
                });

                // Mandar el request para guardar el ciclo en la base de datos
                let request = {};
                request.userId = $scope.userId;
                request.prematriculas = prematricula;
                console.log(request);
                contraData.savePrematricula(request);
            }
        }

        $scope.clearModalMessage = function clearModalMessage() {
            $scope.modalMessage = '';
            $scope.prerrequisitos = [];
            $scope.tempAsignatura = null;
            $scope.showAgregar = false;
        }
    }

    app.controller('preseleccionController', preseleccionController);
}());
