/// <reference path="E:/var/Dropbox/projects/minutephp/public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var InstallerController = (function () {
        function InstallerController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }
        return InstallerController;
    }());
    Admin.InstallerController = InstallerController;
    angular.module('InstallerApp', ['MinuteFramework', 'gettext'])
        .controller('InstallerController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', InstallerController]);
})(Admin || (Admin = {}));
