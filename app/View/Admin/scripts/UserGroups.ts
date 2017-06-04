/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    import Trace = jasmine.Trace;
    export class GroupConfigController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');

            let defaults = {admin: [], business: ['power', 'editor'], 'power': ['trial'], trial: [], editor: []};

            $scope.data = {processors: [], tabs: {}};
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('type', 'groups').attr('data_json', {});
            $scope.settings = $scope.config.attr('data_json');
            $scope.settings.groups = angular.isObject($scope.settings.groups) ? $scope.settings.groups : defaults;
            $scope.settings.access = angular.isObject($scope.settings.access) ? $scope.settings.access : {editor: 'secondary'};
        }

        create = () => {
            this.edit('');
        };

        edit = (key) => {
            let data = {name: key, children: this.$scope.settings.groups[key] || []};
            this.$ui.popupUrl('/group-editor-popup.html', false, null, {ctrl: this, key: key, data: data, access: this.$scope.settings.access});
        };

        update = (key, data) => {
            if (key !== data.name) {
                delete(this.$scope.settings.groups[key]);
            }

            this.$scope.settings.groups[data.name] = data.children;

            angular.forEach(this.$scope.settings.groups, (index, name) => {
                this.$scope.settings.access[name] = this.$scope.settings.access[name] || 'primary';
            });

            angular.forEach(this.$scope.settings.access, (value, key) => {
                if (!this.$scope.settings.groups.hasOwnProperty(key)) {
                    delete(this.$scope.settings.access[key]);
                }
            });

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
