(function () {
    const app = angular.module('angularApp');

    function contraData($http) {
        function returnData(response) {
            return response.data;
        }

        function getAllAsignaturas(userId) {
            return $http.get('/api/asignaturas/' + userId).then(returnData);
        }

        function getAsignaturasAprobadas(userId) {
            return $http.get('/api/aprobadas/' + userId).then(returnData);
        }

        function getGrupos(userId) {
            return $http.get('/api/grupos/' + userId).then(returnData);
        }

        function getInscripcionCiclos(userId) {
            return $http.get('/api/ciclo_api/' + userId).then(returnData);
        }

        function savePrematricula(request) {
            $http.post('/api/prematricula', request).then(function (data, status) {
                console.log(data);
                window.location.href = data.data;
            });
        }

        return {
            getGrupos: getGrupos,
            getInscripcionCiclos: getInscripcionCiclos,
            getAllAsignaturas: getAllAsignaturas,
            getAsignaturasAprobadas: getAsignaturasAprobadas,
            savePrematricula: savePrematricula
        }
    }

    app.factory('contraData', contraData);
}());
