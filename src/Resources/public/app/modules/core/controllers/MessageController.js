(function() {

    var core = angular.module("modules.core");

    core.controller('MessageController', ['$scope', 'ngToast', 'MessageService', function($scope, ngToast, MessageService) {

        var service = new MessageService($scope.baseUrl);

        $scope.messages = [];

        service.getMessages().then(function (response) {
            $scope.messages = response.data;
        });

        $scope.submitMessageForm = function () {
            service.createMessage($scope.message).then(function (response) {
                $scope.messages.unshift(response.data);

                $scope.message = '';

                ngToast.success({
                    content: 'Your message was posted with successfully'
                });
            }, function (response) {
                for (var i = 0; i < response.data.length; i++) {
                    ngToast.danger({
                        content: response.data[i]
                    });
                }
            });
        };

    }]);

})();
