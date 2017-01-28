/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    export class TrackerConfigController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');

            $scope.data = {};
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('type', 'trackers').attr('data_json', {});
            $scope.settings = $scope.config.attr('data_json');
            $scope.settings.trackers = angular.isArray($scope.settings.trackers) ? $scope.settings.trackers : [];
        }

        add = () => {
            let tracker = {tracker_type: 'google', enabled: true};
            this.$scope.settings.trackers.push(tracker);
            this.edit(tracker);
        };

        remove = (index) => {
            this.$scope.settings.trackers.splice(index, 1);
            this.save();
        };

        edit = (tracker) => {
            let selected = {field: null};
            let watcher = this.$scope.$watch(() => tracker['tracker_type'], (type) => {
                selected.field = Minute.Utils.findWhere(this.$scope.data.types, {value: type});
            });

            this.$ui.popupUrl('/tracker-edit-popup.html', false, null, {ctrl: this, data: this.$scope.data, tracker: tracker, selected: selected}).then(() => {
                watcher();
            });
        };

        getTracker = (type, key) => {
            let tracker = Minute.Utils.findWhere(this.$scope.data.types, {value: type});
            return tracker ? tracker[key] : '';
        };

        save = () => {
            this.$ui.closePopup();
            this.$scope.config.save(this.gettext('Trackers saved successfully'));
        };
    }

    angular.module('trackerConfigApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('trackerConfigController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TrackerConfigController]);
}
