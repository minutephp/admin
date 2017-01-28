/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class EventListController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }

        actions = (item) => {
            let gettext = this.gettext;
            let actions = [
                {'text': gettext('Edit..'), 'icon': 'fa-edit', 'hint': gettext('Edit event'), 'href': '/admin/events/edit/' + item.event_id},
                {'text': gettext('Clone'), 'icon': 'fa-copy', 'hint': gettext('Clone event'), 'click': 'ctrl.clone(item)'},
                {'text': gettext('Remove'), 'icon': 'fa-trash', 'hint': gettext('Delete this event'), 'click': 'item.removeConfirm("Removed")'},
            ];

            this.$ui.bottomSheet(actions, gettext('Actions for: ') + item.name, this.$scope, {item: item, ctrl: this});
        };

        handler = (str) => {
            let parts = (str || '').split('\\');
            return parts.length > 0 ? parts[parts.length - 1] : '';
        };

        clone = (event) => {
            let gettext = this.gettext;

            this.$ui.prompt(gettext('Enter new event name'), gettext('new-event-name')).then(function (name) {
                event.clone().attr('name', name).save(gettext('Event duplicated'));
            });
        }
    }

    angular.module('eventListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('eventListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', EventListController]);
}
