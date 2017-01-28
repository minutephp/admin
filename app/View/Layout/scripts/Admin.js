/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var AdminController = (function () {
        function AdminController($scope, $timeout, gettextCatalog, $minute) {
            this.$scope = $scope;
            this.$timeout = $timeout;
            this.gettextCatalog = gettextCatalog;
            this.$minute = $minute;
            this.links = [];
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = {};
        }
        return AdminController;
    }());
    Admin.AdminController = AdminController;
    var ngClickContainer = (function () {
        function ngClickContainer() {
            this.restrict = 'A';
            this.scope = { ngClickContainer: '&' };
            this.link = function ($scope, element) {
                element.on('click', function (ev) {
                    var target = $(ev.target);
                    if (!target.is('a, button, input') && !(target.is('span') && target.parent().is('a, button, input'))) {
                        $scope.$apply(function () { return $scope.ngClickContainer($scope, { $event: event }); });
                    }
                });
            };
        }
        ngClickContainer.instance = function () { return new ngClickContainer; };
        return ngClickContainer;
    }());
    Admin.ngClickContainer = ngClickContainer;
    var autoFocus = (function () {
        function autoFocus() {
            this.restrict = 'A';
            this.scope = {};
            this.link = function ($scope, element) {
                setTimeout(function (e) { return e.focus(); }, 400, element);
            };
        }
        autoFocus.instance = function () { return new autoFocus; };
        return autoFocus;
    }());
    Admin.autoFocus = autoFocus;
    var minuteTutorial = (function () {
        function minuteTutorial() {
            this.restrict = 'A';
            this.scope = { minuteTutorial: '@' };
            this.link = function ($scope, element) {
                element.attr('href', '//minutephp.com/tutorial/' + $scope.minuteTutorial).attr('target', '_blank');
            };
        }
        minuteTutorial.instance = function () { return new minuteTutorial; };
        return minuteTutorial;
    }());
    Admin.minuteTutorial = minuteTutorial;
    var MyFilters = (function () {
        function MyFilters() {
        }
        MyFilters.safe = function ($sanitize) {
            return function (str) {
                return $sanitize(str || '');
            };
        };
        MyFilters.firstChar = function () {
            return function (str) {
                return (str || '').substr(0, 1).toUpperCase();
            };
        };
        return MyFilters;
    }());
    Admin.MyFilters = MyFilters;
    var googleSearch = (function () {
        function googleSearch() {
            this.restrict = 'A';
            this.scope = { googleSearch: '@' };
            this.link = function ($scope, element) {
                element.attr('href', "http://www.google.com/search?btnI=I'm+Feeling+Lucky&q=" + encodeURI($scope.googleSearch)).attr('target', '_blank');
            };
        }
        googleSearch.instance = function () { return new googleSearch; };
        return googleSearch;
    }());
    Admin.googleSearch = googleSearch;
    angular.module('AdminApp', ['MinuteFramework', 'MinuteImporter', 'MinuteDirectives', 'MinuteFilters', 'AngularTreeMenu', 'angular-loading-bar', 'angular.filter',
        'gettext', 'angular-bs-tooltip', 'ngSanitize'])
        .controller('adminController', ['$scope', '$timeout', 'gettextCatalog', '$minute', AdminController])
        .directive('ngClickContainer', ngClickContainer.instance)
        .directive('autoFocus', autoFocus.instance)
        .directive('googleSearch', googleSearch.instance)
        .directive('minuteTutorial', minuteTutorial.instance)
        .filter("firstChar", MyFilters.firstChar)
        .filter("safe", MyFilters.safe);
})(Admin || (Admin = {}));
