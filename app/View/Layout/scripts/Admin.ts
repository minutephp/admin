/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    export class AdminController {
        public links = [];

        constructor(public $scope: any, public $timeout: ng.ITimeoutService, public gettextCatalog: any, public $minute: any) {
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = {};
        }
    }

    export class ngClickContainer implements ng.IDirective {
        restrict = 'A';
        scope: any = {ngClickContainer: '&'};

        static instance = () => new ngClickContainer;

        link = ($scope: any, element: ng.IAugmentedJQuery) => {
            element.on('click', (ev) => {
                let target = $(ev.target);
                if (!target.is('a, button, input') && !(target.is('span') && target.parent().is('a, button, input'))) {
                    $scope.$apply(() => $scope.ngClickContainer($scope, {$event: event}));
                }
            });
        }
    }

    export class autoFocus implements ng.IDirective {
        restrict = 'A';
        scope: any = {};

        static instance = () => new autoFocus;

        link = ($scope: any, element: ng.IAugmentedJQuery) => {
            setTimeout((e) => e.focus(), 400, element);
        }
    }

    export class minuteTutorial implements ng.IDirective {
        restrict = 'A';
        scope: any = {minuteTutorial: '@'};

        static instance = () => new minuteTutorial;

        link = ($scope: any, element: ng.IAugmentedJQuery) => {
            element.attr('href', '//minutephp.com/tutorial/' + $scope.minuteTutorial).attr('target', '_blank');
        }
    }

    export class MyFilters {
        static safe = ($sanitize) => {
            return function (str) {
                return $sanitize(str || '');
            }
        };

        static firstChar = () => {
            return function (str) {
                return (str || '').substr(0, 1).toUpperCase();
            }
        };
    }

    export class googleSearch implements ng.IDirective {
        restrict = 'A';
        scope: any = {googleSearch: '@'};

        static instance = () => new googleSearch;

        link = ($scope: any, element: ng.IAugmentedJQuery) => {
            element.attr('href', "http://www.google.com/search?btnI=I'm+Feeling+Lucky&q=" + encodeURI($scope.googleSearch)).attr('target', '_blank');
        }
    }

    angular.module('AdminApp', ['MinuteFramework', 'MinuteImporter', 'MinuteDirectives', 'MinuteFilters', 'AngularTreeMenu', 'angular-loading-bar', 'angular.filter',
        'gettext', 'angular-bs-tooltip', 'ngSanitize'])
        .controller('adminController', ['$scope', '$timeout', 'gettextCatalog', '$minute', AdminController])
        .directive('ngClickContainer', ngClickContainer.instance)
        .directive('autoFocus', autoFocus.instance)
        .directive('googleSearch', googleSearch.instance)
        .directive('minuteTutorial', minuteTutorial.instance)
        .filter("firstChar", MyFilters.firstChar)
        .filter("safe", MyFilters.safe);
}

