/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var GroupConfigController = (function () {
        function GroupConfigController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.create = function () {
                _this.edit('');
            };
            this.edit = function (key) {
                _this.$ui.popupUrl('/group-editor-popup.html', false, null, { ctrl: _this, key: key, data: { name: key, children: _this.$scope.settings.groups[key] || [] } });
            };
            this.update = function (key, data) {
                if (key !== data.name) {
                    delete (_this.$scope.settings.groups[key]);
                }
                _this.$scope.settings.groups[data.name] = data.children;
                _this.save();
                _this.$ui.closePopup();
            };
            this.remove = function (key) {
                _this.$ui.closePopup();
                _this.$ui.confirm(_this.gettext('Are you sure you want to remove this group?')).then(function () {
                    delete (_this.$scope.settings.groups[key]);
                    _this.save();
                });
            };
            this.save = function () {
                _this.$scope.config.save(_this.gettext('User groups saved successfully'));
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            var defaults = { admin: [], business: ['power', 'editor'], 'power': ['trial'], trial: [], editor: [] };
            $scope.data = { processors: [], tabs: {} };
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('type', 'groups').attr('data_json', {});
            $scope.settings = $scope.config.attr('data_json');
            $scope.settings.groups = angular.isObject($scope.settings.groups) ? $scope.settings.groups : defaults;
        }
        return GroupConfigController;
    }());
    Admin.GroupConfigController = GroupConfigController;
    angular.module('groupConfigApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('groupConfigController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', GroupConfigController]);
})(Admin || (Admin = {}));
