<div class="content-wrapper ng-cloak" ng-app="seoConfigApp" ng-controller="seoConfigController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1>
                <span translate="">Page titles and SEO</span>
            </h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-cog"></i> <span translate="">Page titles</span></li>
            </ol>
        </section>

        <section class="content">
            <minute-event name="import.page.list" as="data.pages"></minute-event>

            <form class="form-horizontal" name="seoForm" ng-submit="mainCtrl.save()">
                <div class="box box-{{seoForm.$valid && 'success' || 'danger'}}">
                    <div class="box-header with-border">
                        <span translate="">Page titles and website SEO</span>

                        <div class="box-tools">
                            <a href="" ng-click="data.all = !data.all"><i class="fa fa-toggle-{{data.all && 'on' || 'off'}}"></i> <span translate="">Show hidden</span></a>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input class="form-control input-lg" ng-model="data.filter" placeholder="Search urls..">
                            </div>
                        </div>

                        <div class="panel panel-default" ng-repeat="url in data.pages | orderBy:url track by $index"
                             ng-show="(!!data.all || !!mainCtrl.show(url)) && (!data.filter || mainCtrl.match(url, data.filter))">
                            <div class="panel-heading">
                                <b class="pull-left">{{url}}</b>
                                <a tooltip="View page" class="pull-right" href="" ng-href="{{url}}" target="pop"><i class="fa fa-external-link text-muted fa-xs"></i></a>
                                <div class="clearfix"></div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><span translate="">Page title:</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Enter Title" ng-model="settings.titles[url].title" ng-required="false">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for=""><span translate="">Page description:</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="" placeholder="Enter Page description" ng-model="settings.titles[url].description" ng-required="false">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer with-border">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-flat btn-primary">
                                    <span translate="">Save all pages</span>
                                    <i class="fa fa-fw fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
