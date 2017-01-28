/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    export class GroupConfigController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');

            let defaults = {admin: [], business: ['power', 'editor'], 'power': ['trial'], trial: [], editor: []};

            $scope.data = {processors: [], tabs: {}};
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('type', 'groups').attr('data_json', {});
            $scope.settings = $scope.config.attr('data_json');
            $scope.settings.groups = angular.isObject($scope.settings.groups) ? $scope.settings.groups : defaults;
        }

        create = () => {
            this.edit('');
        };

        edit = (key) => {
            this.$ui.popupUrl('/group-editor-popup.html', false, null, {ctrl: this, key: key, data: {name: key, children: this.$scope.settings.groups[key] || []}});
        };

        update = (key, data) => {
            if (key !== data.name) {
                delete(this.$scope.settings.groups[key]);
            }

            this.$scope.settings.groups[data.name] = data.children;
            this.save();
            this.$ui.closePopup();
        };

        remove = (key) => {
            this.$ui.closePopup();

            this.$ui.confirm(this.gettext('Are you sure you want to remove this group?')).then(() => {
                delete(this.$scope.settings.groups[key]);
                this.save();
            });
        };

        save = () => {
            this.$scope.config.save(this.gettext('User groups saved successfully'));
        };
    }

    angular.module('groupConfigApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('groupConfigController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', GroupConfigController]);
}
