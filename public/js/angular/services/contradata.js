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

        return {
            getAsignaturas: getAsignaturas,
            getFacilitadores: getFacilitadores,
        }
    }

    app.factory('contraData', contraData);
}());
