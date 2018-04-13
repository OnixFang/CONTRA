(function () {
    const app = angular.module('angularApp');

    function contraData($http) {
        function returnData(response) {
            return response.data;
        }

        function getAsignaturas() {
            return $http.get('api/asignatura_api').then(returnData);
        }

        return {
            getAsignaturas: getAsignaturas,
        }
    }

    app.factory('contraData', contraData);
}());
