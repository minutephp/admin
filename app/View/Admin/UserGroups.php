<div class="content-wrapper ng-cloak" ng-app="groupConfigApp" ng-controller="groupConfigController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1>
                <span translate="">Group settings</span>
            </h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-cog"></i> <span translate="">Group settings</span></li>
            </ol>
        </section>

        <section class="content">
            <form class="form-horizontal" name="groupForm" ng-submit="mainCtrl.save()">
                <div class="box box-{{groupForm.$valid && 'success' || 'danger'}}">
                    <div class="box-header with-border">
                        <h3 class="box-title"><span translate="">Site groups</span></h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-flat btn-success btn-sm" ng-click="mainCtrl.create()">
                                <i class="fa fa-plus-circle"></i> <span translate="">Create new group</span>
                            </button>

                            <button type="button" class="btn btn-flat btn-primary btn-sm" ng-click="mainCtrl.save()">
                                <i class="fa fa-check"></i> <span translate="">Save changes</span>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="list-group-item list-group-item-bar list-group-item-bar-{{settings.access[key] == 'primary' && 'success' || 'danger'}}" ng-repeat="(key, children) in settings.groups">
                            <div class="pull-left">
                                <h4 class="list-group-item-heading">{{key | ucfirst}}</h4>
                                <p class="list-group-item-text hidden-xs">
                                    <span translate="">Children: </span>
                                    <span ng-show="!!children.length">
                                        <span ng-repeat="child in children track by $index">{{child | ucfirst}}{{$last && '.' || ', '}}</span>
                                        <span translate="" class="text-sm text-muted">(including all sub-children)</span></span>
                                    <span ng-show="!children.length" translate>{{key === 'admin' && 'All' || 'None'}}</span>
                                </p>
                            </div>

                            <div class="pull-right" ng-show="key !== 'admin'">
                                <a class="btn btn-default btn-flat btn-sm" ng-click="mainCtrl.edit(key)">
                                    <span translate="">Edit..</span>
                                </a>
                                <a class="btn btn-default btn-flat btn-sm" ng-click="mainCtrl.remove(key)">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>

                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
            </form>
        </section>
    </div>

    <script type="text/ng-template" id="/group-editor-popup.html">
        <div class="box box-md">
            <div class="box-header with-border">
                <b class="pull-left"><span translate="">Edit group</span></b>
                <a class="pull-right close-button" href=""><i class="fa fa-times"></i></a>
                <div class="clearfix"></div>
            </div>

            <form class="form-horizontal" name="groupForm" ng-submit="ctrl.update(key, data)">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name"><span translate="">Name:</span></label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-xs-10">
                                    <input type="text" class="form-control auto-focus" id="name" placeholder="Enter Name" ng-model="data.name" ng-required="true">
                                </div>
                                <div class="col-xs-2">
                                    <a href="" ng-click="ctrl.remove(key)" tooltip="Delete entire group"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><span translate="">Control:</span></label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" ng-model="access[data.name]" ng-value="'primary'"> <span translate="">Primary access (account)</span>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" ng-model="access[data.name]" ng-value="'secondary'"> <span translate="">Secondary access (bonuses)</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><span translate="">Children:</span></label>
                        <div class="col-sm-9">
                            <div class="row" ng-repeat="child in data.children track by $index" style="margin-bottom: 10px;">
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" ng-model="data.children[$index]" ng-required="true">
                                </div>
                                <div class="col-xs-2">
                                    <a href="" tooltip="Delete child" ng-click="data.children.splice($index, 1)"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </div>

                            <p class="help-block">
                                <button type="button" class="btn btn-flat btn-default btn-sm" ng-click="data.children.push('')"><i class="fa fa-check"></i> <span translate="">Add child</span></button>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="box-footer with-border">
                    <button type="submit" class="btn btn-flat btn-primary" ng-disabled="!groupForm.$valid">
                        <span translate>Save group</span> <i class="fa fa-fw fa-angle-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </script>
</div>
