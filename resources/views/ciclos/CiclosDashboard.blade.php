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
                                    <th class="col-md-3">Asignatura</th>
                                    <th class="col-md-1">Facilitador</th>
                                    <th class="col-md-1">Bimestre</th>
                                    <th class="col-md-1">Horario</th>
                                    <th class="col-md-1">Calificaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="grupo in ciclo.grupos">
                                    <td ng-bind="grupo.clave"></td>
                                    <td ng-bind="grupo.asignatura"></td>
                                    <td ng-bind="grupo.facilitador"></td>
                                    <td ng-bind="grupo.bimestre"></td>
                                    <td ng-bind="grupo.horario"></td>
                                    <td ng-bind="grupo.calificacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">No hay ningún ciclo en el historial</div>
                </div>
            </div>
        </div>
        <!-- /.panel-->
    </div>
</div>

@endsection