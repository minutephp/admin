/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var SeoConfigController = (function () {
        function SeoConfigController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.parse = function (url) {
                var parts = (url || '').split(/\W+/);
                var string = $.trim(parts.join(' '));
                return string.charAt(0).toUpperCase() + string.slice(1);
            };
            this.show = function (url) {
                return !/^\/(admin|\_|first\-run|auth)/.test(url);
            };
            this.match = function (key, filter) {
                return (key || '').indexOf(filter) !== -1;
            };
            this.save = function () {
                _this.$scope.config.save(_this.gettext('All page titles saved successfully'));
            };
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
        return SeoConfigController;
    }());
    Admin.SeoConfigController = SeoConfigController;
    angular.module('seoConfigApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('seoConfigController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', SeoConfigController]);
})(Admin || (Admin = {}));
