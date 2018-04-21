 @extends('layouts.layout');
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

@section('content')
<div ng-controller="cicloHistorialController" ng-cloak>
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Ciclos</li>
        </ol>
    </div>
    <!--/.row-->
    @if(Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Historial de Ciclos</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div ng-repeat="ciclo in ciclos">
                        <h4>Ciclo
                            <span ng-bind="ciclo.clave"></span>
                        </h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-md-2">Clave</th>
                                    <th class="col-md-2">Asignatura</th>
                                    <th class="col-md-2">Facilitador</th>
                                    <th class="col-md-1">Bimestre</th>
                                    <!-- <th class="col-md-2">Horario</th> -->
                                    <th class="col-md-1">Créditos</th>
                                    <th class="col-md-2">Puntos</th>
                                    <th class="col-md-1">Nota</th>
                                    <th class="col-md-1">Calificación</th>
                                </tr>
                            </thead>
                            <tbody ng-init="totalCreditos = 0; totalPuntos = 0">
                                <tr ng-repeat="grupo in ciclo.grupos">
                                    <td ng-bind="grupo.clave"></td>
                                    <td ng-bind="grupo.asignatura"></td>
                                    <td ng-bind="grupo.facilitador"></td>
                                    <td ng-bind="grupo.bimestre"></td>
                                    <!-- <td ng-bind="grupo.horario"></td> -->
                                    <td ng-bind="grupo.credito" ng-init="$parent.totalCreditos = $parent.totalCreditos + grupo.credito"></td>
                                    <td ng-bind="calcularPuntos(calcularLiteral(grupo.calificacion), grupo.credito)" ng-init="$parent.totalPuntos = $parent.totalPuntos + calcularPuntos(calcularLiteral(grupo.calificacion), grupo.credito)"></td>
                                    <td ng-bind="grupo.calificacion"></td>
                                    <td ng-bind="calcularLiteral(grupo.calificacion)"></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Total del cuatrimestre</th>
                                    <td ng-bind="totalCreditos"></td>
                                    <td ng-bind="totalPuntos"></td>
                                    <td rowspan="2" colspan="2"></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Índice del cuatrimestre</th>
                                    <td class="text-center" colspan="2" ng-bind="calcularIndice(totalPuntos, totalCreditos) | number:2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <h4><b>Índice acumulado: </b><span ng-bind="indiceAcumulado() | number:2"></span></h4>
                    <div ng-show="noCiclos" class="text-center">No hay ningún ciclo en el historial</div>
                </div>
            </div>
        </div>
        <!-- /.panel-->
    </div>
</div>

@endsection