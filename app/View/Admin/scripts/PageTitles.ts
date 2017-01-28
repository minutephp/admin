/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    export class SeoConfigController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = {};
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('type', 'seo').attr('data_json', {});
            $scope.settings = $scope.config.attr('data_json');
            $scope.settings.titles = $scope.settings.titles || {};

            /*$scope.$watch('data.pages', (pages) => {
                angular.forEach(pages, (visible, url) => {
                    let title = this.parse(url);
                    $scope.settings.titles[url] = $scope.settings.titles[url] || {title: title, description: '', visible: visible};
                });
            })*/
        }

        parse = (url) => {
            let parts = (url || '').split(/\W+/);
            let string = $.trim(parts.join(' '));

            return string.charAt(0).toUpperCase() + string.slice(1);
        };

        show = (url) => {
            return !/^\/(admin|\_|first\-run|auth)/.test(url);
        };

        match = (key, filter) => {
            return (key || '').indexOf(filter) !== -1;
        };

        save = () => {
            this.$scope.config.save(this.gettext('All page titles saved successfully'));
        };
    }

    angular.module('seoConfigApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('seoConfigController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', SeoConfigController]);
}
