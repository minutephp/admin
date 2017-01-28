/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var DashboardListController = (function () {
        function DashboardListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }
        return DashboardListController;
    }());
    Admin.DashboardListController = DashboardListController;
    angular.module('dashboardListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('dashboardListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', DashboardListController]);
})(Admin || (Admin = {}));
