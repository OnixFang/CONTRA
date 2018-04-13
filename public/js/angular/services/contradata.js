(function () {
    const app = angular.module('angularApp');

    function contraData($http) {
        function returnData(response) {
            return response.data;
        }

        function getAsignaturas() {
            $http.get('').then(returnData);
        }

        function getFacilitadores() {
            $http.get('').then(returnData);
        }

        function getGrupos() {
            $http.get('').then(returnData);
        }

        return {
            getAsignaturas: getAsignaturas,
        }
    }

    app.factory('contraData', contraData);
}());
