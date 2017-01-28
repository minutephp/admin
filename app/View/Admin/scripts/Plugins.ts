/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class PluginListController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = {tabs: {}, pluginTypes: [{name: 'Official', type: 'official'}, {name: 'Third party', type: 'thirdparty'}]};
        }

        install = (name, mode) => {
            window.open('/admin/plugins/installer?name=' + encodeURIComponent(name) + '&mode=' + mode, 'installer', 'width=400,height=400');
        };
    }

    angular.module('pluginListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('pluginListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', PluginListController]);
}
