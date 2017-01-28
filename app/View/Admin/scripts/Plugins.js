/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var PluginListController = (function () {
        function PluginListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.install = function (name, mode) {
                window.open('/admin/plugins/installer?name=' + encodeURIComponent(name) + '&mode=' + mode, 'installer', 'width=400,height=400');
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = { tabs: {}, pluginTypes: [{ name: 'Official', type: 'official' }, { name: 'Third party', type: 'thirdparty' }] };
        }
        return PluginListController;
    }());
    App.PluginListController = PluginListController;
    angular.module('pluginListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('pluginListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', PluginListController]);
})(App || (App = {}));
