/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    export class ConfigEditController {
        constructor(public $scope:any, public $minute:any, public $ui:any, public $timeout:ng.ITimeoutService,
                    public gettext:angular.gettext.gettextFunction, public gettextCatalog:angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('enabled', true);
            $scope.data = {types: ['public']};
        }

        save = () => {
            this.$scope.config.save(this.gettext('Config saved successfully'));
        };
    }

    angular.module('configEditApp', ['MinuteFramework', 'AdminApp', 'gettext', 'ng.jsoneditor'])
        .controller('configEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', ConfigEditController]);
}
