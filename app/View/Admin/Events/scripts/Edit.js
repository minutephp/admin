/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var EventEditController = (function () {
        function EventEditController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.save = function () {
                _this.$scope.event.save(_this.gettext('Event saved successfully'));
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.event = $scope.events[0] || $scope.events.create().attr('priority', 0);
            $scope.data = { events: {} };
        }
        return EventEditController;
    }());
    App.EventEditController = EventEditController;
    angular.module('eventEditApp', ['MinuteFramework', 'AdminApp', 'gettext', 'nya.bootstrap.select'])
        .controller('eventEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', EventEditController]);
})(App || (App = {}));
