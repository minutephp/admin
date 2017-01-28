/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class EventEditController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.event = $scope.events[0] || $scope.events.create().attr('priority', 0);
            $scope.data = {events: {}};
        }

        save = () => {
            this.$scope.event.save(this.gettext('Event saved successfully'));
        };
    }

    angular.module('eventEditApp', ['MinuteFramework', 'AdminApp', 'gettext', 'nya.bootstrap.select'])
        .controller('eventEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', EventEditController]);
}
