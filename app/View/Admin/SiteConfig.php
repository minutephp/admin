<div class="content-wrapper ng-cloak" ng-app="configEditApp" ng-controller="configEditController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1>
                {{config.type | ucfirst}} <span translate="">config</span>
            </h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-edit"></i> <span translate="">{{config.type}} config</span></li>
            </ol>
        </section>

        <section class="content">
            <minute-event name="import.config.types" as="data"></minute-event>

            <form name="configForm" ng-submit="mainCtrl.save()">
                <div class="box box-success">
                    <div class="padded">
                        <div class="tabs-panel">
                            <ul class="nav nav-tabs">
                                <li ng-class="{active: type === config.type}" ng-repeat="type in data.types">
                                    <a href="" ng-href="/admin/config/{{type}}" ng-class="{'text-bold': type == 'public' || type == 'private'}">{{type | ucfirst}}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade in active">
                                <div class="box-body">
                                    <div class="json-editor" ng-jsoneditor options="{modes: ['tree', 'code'], name: type}" ng-model="config.data_json"></div>

                                    <div ng-switch on="config.type" class="alert alert-info" style="margin-top:-1px; border-radius: 0;">
                                        <b><span translate="">Note:</span></b>
                                        <span translate="" ng-switch-when="public">Public config is visible to everyone (client and server) and may only contain public data like site name, domain name,
                                            etc.</span>
                                        <span translate="" ng-switch-when="private">Private config is visible only to server-side scripts and may contain confidential site data like API keys,
                                            etc.</span>
                                        <span translate="" ng-switch-default>{{config.type | ucfirst}} config is created by a plugin or script and may be overwritten.</span>
                                    </div>
                                </div>

                                <div class="box-footer with-border">
                                    <button type="submit" class="btn btn-flat btn-primary">
                                        <span translate="">Update {{config.type}} config</span>
                                        <i class="fa fa-fw fa-angle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
