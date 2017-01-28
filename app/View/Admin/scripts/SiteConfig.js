/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var ConfigEditController = (function () {
        function ConfigEditController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.save = function () {
                _this.$scope.config.save(_this.gettext('Config saved successfully'));
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('enabled', true);
            $scope.data = { types: ['public'] };
        }
        return ConfigEditController;
    }());
    Admin.ConfigEditController = ConfigEditController;
    angular.module('configEditApp', ['MinuteFramework', 'AdminApp', 'gettext', 'ng.jsoneditor'])
        .controller('configEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', ConfigEditController]);
})(Admin || (Admin = {}));
