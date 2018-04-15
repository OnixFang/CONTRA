(function () {
    const app = angular.module('angularApp');

    function contraData($http) {
        function returnData(response) {
            return response.data;
        }

        function getAsignaturas() {
            return $http.get('api/asignatura_api').then(returnData);
        }

        function getFacilitadores() {
            return $http.get('api/facilitador_api').then(returnData);
        }

        function saveCiclo(ciclo) {
            $http.post('api/ciclo_api', ciclo).then(function (data, status) {
                console.log(data);
                window.location.href = data.data;
            });
        }

        return {
            getAsignaturas: getAsignaturas,
            getFacilitadores: getFacilitadores,
            saveCiclo: saveCiclo,
        }
    }

    app.factory('contraData', contraData);
}());
