@extends('layouts.layout');
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
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
            <li class="active">Historial de Ciclos</li>
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
                        <h4>
                            <strong>Ciclo <span ng-bind="ciclo[0].claveCiclo"></span></strong>
                        </h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-md-1 text-center">Código</th>
                                    <th class="col-md-5 text-center">Asignatura</th>
                                    <th class="col-md-1 text-center">Sección</th>
                                    <th class="col-md-1 text-center">Créditos</th>
                                    <th class="col-md-1 text-center">Puntos</th>
                                    <th class="col-md-1 text-center">Nota</th>
                                    <th class="col-md-1 text-center">Calificación</th>
                                    <th class="col-md-1 text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody ng-init="totalCreditos = 0; totalPuntos = 0">
                                <tr ng-repeat="grupo in ciclo">
                                    <td class="text-center" ng-bind="grupo.claveAsignatura"></td>
                                    <td ng-bind="grupo.nombreAsignatura"></td>
                                    <td class="text-center" ng-bind="grupo.seccionGrupo"></td>
                                    <td class="text-right" ng-bind="grupo.creditoAsignatura" ng-init="$parent.totalCreditos = $parent.totalCreditos + sumarCredito(grupo.creditoAsignatura, grupo.estado, grupo.nota)"></td>
                                    <td class="text-right" ng-bind="calcularPuntos(calcularLiteral(grupo.nota), grupo.creditoAsignatura)"
                                        ng-init="$parent.totalPuntos = $parent.totalPuntos + calcularPuntos(calcularLiteral(grupo.nota), grupo.creditoAsignatura)"></td>
                                    <td class="text-center" ng-bind="grupo.nota"></td>
                                    <td class="text-center" ng-bind="calcularLiteral(grupo.nota)"></td>
                                    <td class="text-center" ng-bind="grupo.estado"></td>
                                </tr>
                                <tr>
                                    <td colspan="8" rowspan="2">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-7 text-right"><strong>Total del cuatrimestre</strong></div>
                                                <div class="col-sm-1 text-right" ng-bind="totalCreditos"></div>
                                                <div class="col-sm-1 text-right" ng-bind="totalPuntos"></div>
                                            </div>
                                            <div class="row" style="margin-top: 0.8em">
                                                <div class="col-sm-7 text-right"><strong>Índice del cuatrimestre</strong></div>
                                                <div class="col-sm-1 text-right" ng-bind="calcularIndice(totalPuntos, totalCreditos) | number:2"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <h4 ng-hide="noIndice"><b>Índice acumulado: </b><span ng-bind="indiceAcumulado() | number:2"></span></h4>
                    <div ng-show="noCiclos" class="text-center">No hay ningún ciclo en el historial</div>
                </div>
            </div>
        </div>
        <!-- /.panel-->
    </div>
</div>

@endsection