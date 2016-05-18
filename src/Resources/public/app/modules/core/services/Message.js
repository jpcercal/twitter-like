(function() {

    var core = angular.module("modules.core");

    core.factory('MessageService', ['$http', function($http) {
        return function (baseUrl) {
            return {
                getMessages: function () {
                    return $http.get(baseUrl + 'api/post');
                },
                createMessage: function (message) {
                    return $http.post(baseUrl + 'api/post', {
                        message: message
                    });
                }
            };
        };
    }]);

})();
