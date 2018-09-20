(function () {
    const app = angular.module('angularApp');

    function contraData($http) {
        function returnData(response) {
            return response.data;
        }

        function getAsignaturasAprobadas(userId) {
            return $http.get('api/aprobadas/' + userId).then(returnData);
        }

        function getGrupos(userId) {
            return $http.get('api/grupos/' + userId).then(returnData);
        }

        function getInscripcionCiclos(userId) {
            return $http.get('api/ciclo_api/' + userId).then(returnData);
        }

        // Obsolete
        // function saveCiclo(ciclo) {
        //     $http.post('api/ciclo_api', ciclo).then(function (data, status) {
        //         console.log(data);
        //         window.location.href = data.data;
        //     });
        // }

        return {
            getGrupos: getGrupos,
            getInscripcionCiclos: getInscripcionCiclos,
            getAsignaturasAprobadas: getAsignaturasAprobadas
        }
    }

    app.factory('contraData', contraData);
}());
