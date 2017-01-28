/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var TrackerConfigController = (function () {
        function TrackerConfigController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.add = function () {
                var tracker = { tracker_type: 'google', enabled: true };
                _this.$scope.settings.trackers.push(tracker);
                _this.edit(tracker);
            };
            this.remove = function (index) {
                _this.$scope.settings.trackers.splice(index, 1);
                _this.save();
            };
            this.edit = function (tracker) {
                var selected = { field: null };
                var watcher = _this.$scope.$watch(function () { return tracker['tracker_type']; }, function (type) {
                    selected.field = Minute.Utils.findWhere(_this.$scope.data.types, { value: type });
                });
                _this.$ui.popupUrl('/tracker-edit-popup.html', false, null, { ctrl: _this, data: _this.$scope.data, tracker: tracker, selected: selected }).then(function () {
                    watcher();
                });
            };
            this.getTracker = function (type, key) {
                var tracker = Minute.Utils.findWhere(_this.$scope.data.types, { value: type });
                return tracker ? tracker[key] : '';
            };
            this.save = function () {
                _this.$ui.closePopup();
                _this.$scope.config.save(_this.gettext('Trackers saved successfully'));
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = {};
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('type', 'trackers').attr('data_json', {});
            $scope.settings = $scope.config.attr('data_json');
            $scope.settings.trackers = angular.isArray($scope.settings.trackers) ? $scope.settings.trackers : [];
        }
        return TrackerConfigController;
    }());
    Admin.TrackerConfigController = TrackerConfigController;
    angular.module('trackerConfigApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('trackerConfigController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TrackerConfigController]);
})(Admin || (Admin = {}));
