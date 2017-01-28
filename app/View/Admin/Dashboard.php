<div class="content-wrapper ng-cloak" ng-app="dashboardListApp" ng-controller="dashboardListController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1><span translate="">Dashboard</span> <small><span translate="">{{session.site.site_name}}</span></small></h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-dashboard"></i> <span translate="">Website stats</span></li>
            </ol>
        </section>

        <section class="content">
            <minute-event name="import.admin.dashboard.panels.cached" as="mainCtrl.data.panels"></minute-event>

            <div class="outline">
                <div class="row" ng-repeat="(type, panels) in mainCtrl.data.panels| groupBy:'type'">
                    <div class="col-md-12" ng-show="type != 'undefined'">
                        <h3>{{type | ucfirst}} <span translate="">stats</span></h3>
                    </div>

                    <div class="{{panel.size || 'col-md-4 col-sm-6 col-xs-12'}}" ng-repeat="panel in panels">
                        <div class="info-box">
                            <span class="info-box-icon {{panel.bg || 'bg-aqua'}}"><i class="fa fa-lg {{panel.icon}}"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">{{panel.title}}</span>
                                <span class="info-box-number">{{panel.stats}}</span>
                                <div class="info-box-button" ng-show="panel.href">
                                    <a ng-href="{{panel.href}}" class="btn btn-flat btn-default btn-xs"><i class="fa {{panel.ctaIcon || 'fa-search'}}"></i> {{panel.cta}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-sm"><sup>*</sup> <span translate="">All stats are cached for 5 minutes</span></p>
            </div>
        </section>
    </div>
</div>
