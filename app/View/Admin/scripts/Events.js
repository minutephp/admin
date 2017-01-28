/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var EventListController = (function () {
        function EventListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.actions = function (item) {
                var gettext = _this.gettext;
                var actions = [
                    { 'text': gettext('Edit..'), 'icon': 'fa-edit', 'hint': gettext('Edit event'), 'href': '/admin/events/edit/' + item.event_id },
                    { 'text': gettext('Clone'), 'icon': 'fa-copy', 'hint': gettext('Clone event'), 'click': 'ctrl.clone(item)' },
                    { 'text': gettext('Remove'), 'icon': 'fa-trash', 'hint': gettext('Delete this event'), 'click': 'item.removeConfirm("Removed")' },
                ];
                _this.$ui.bottomSheet(actions, gettext('Actions for: ') + item.name, _this.$scope, { item: item, ctrl: _this });
            };
            this.handler = function (str) {
                var parts = (str || '').split('\\');
                return parts.length > 0 ? parts[parts.length - 1] : '';
            };
            this.clone = function (event) {
                var gettext = _this.gettext;
                _this.$ui.prompt(gettext('Enter new event name'), gettext('new-event-name')).then(function (name) {
                    event.clone().attr('name', name).save(gettext('Event duplicated'));
                });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }
        return EventListController;
    }());
    App.EventListController = EventListController;
    angular.module('eventListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('eventListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', EventListController]);
})(App || (App = {}));
