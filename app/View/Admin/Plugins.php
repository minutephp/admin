<div class="content-wrapper ng-cloak" ng-app="pluginListApp" ng-controller="pluginListController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1><span translate="">List of plugins</span> <small><span translate="">info</span></small></h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-plugin"></i> <span translate="">Plugin list</span></li>
            </ol>
        </section>

        <section class="content">
            <minute-event name="import.admin.plugin.list" as="data.plugins"></minute-event>

            <div class="alert alert-danger alert-dismissible" role="alert" ng-if="session.site.version !== 'debug'">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span translate="">You should only add / remove plugins before deploying your website (i.e. during website development on your local machine).
                    Adding plugins after deployment is not recommended and may cause problems during auto-scaling / re-deployment.</span>
            </div>

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span translate="">Plugin manager</span>
                    </h3>

                    <div class="box-tools">
                        <select title="show" class="form-control input-sm" ng-model="data.show">
                            <option value="">Show all plugins</option>
                            <option value="true">Show installed plugins only</option>
                            <option value="false">Show new plugins only</option>
                        </select>
                    </div>
                </div>

                <div class="box-body">
                    <div class="tabs-panel">
                        <ul class="nav nav-tabs">
                            <li ng-class="{active: pluginTab === data.tabs.selectedPluginTab}" ng-repeat="pluginTab in data.pluginTypes"
                                ng-init="data.tabs.selectedPluginTab = data.tabs.selectedPluginTab || pluginTab">
                                <a href="" ng-click="data.tabs.selectedPluginTab = pluginTab">{{pluginTab.name}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" ng-repeat="pluginTab in data.pluginTypes" ng-if="pluginTab === data.tabs.selectedPluginTab">
                                <div class="list-group">
                                    <div class="alert alert-warning alert-dismissible" role="alert" ng-show="data.tabs.selectedPluginTab.type !== 'official'">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <i class="fa fa-exclamation-triangle"></i>
                                        <span translate="">Third party plugins contain untested code that may break your site. Install them only if you trust the source.</span>
                                    </div>
                                    <div class="list-group-item list-group-item-bar list-group-item-bar-{{plugin.installed && 'success' || 'danger'}}"
                                         ng-repeat="plugin in data.plugins[data.tabs.selectedPluginTab.type] | orderBy:'installed'" ng-show="!data.show || (plugin.installed + '' == data.show)">
                                        <div class="pull-left">
                                            <h4 class="list-group-item-heading">
                                                <a href="" ng-href="{{plugin.src}}" target="composer">{{plugin.name | ucfirst}}</a>
                                            </h4>
                                            <p class="list-group-item-text hidden-xs">
                                                <span translate="">Description:</span> {{plugin.description}}.
                                            </p>
                                        </div>
                                        <div class="md-actions pull-right">
                                            <button class="btn btn-default btn-flat btn-sm" ng-click="mainCtrl.install(plugin.plugin, 'install')" ng-show="!plugin.installed">
                                                <i class="fa fa-pencil-square-o"></i> <span translate="">Install..</span>
                                            </button>
                                            <button class="btn btn-default btn-flat btn-sm" ng-click="mainCtrl.install(plugin.plugin, 'remove')" ng-show="!!plugin.installed && !plugin.required">
                                                <i class="fa fa-pencil-square-o"></i> <span translate="">Remove..</span>
                                            </button>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
</div>
