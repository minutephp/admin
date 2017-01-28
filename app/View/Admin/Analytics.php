<div class="content-wrapper ng-cloak" ng-app="trackerConfigApp" ng-controller="trackerConfigController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1>
                <span translate="">Web analytics</span>
            </h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-cog"></i> <span translate="">Tracker settings</span></li>
            </ol>
        </section>

        <section class="content">
            <minute-event name="IMPORT_TRACKER_LIST" as="data.types"></minute-event>

            <form class="form-horizontal" name="trackerForm" ng-submit="mainCtrl.save()">
                <div class="box box-{{trackerForm.$valid && 'success' || 'danger'}}">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <span translate="">All website trackers</span>
                        </h3>

                        <div class="box-tools">
                            <button type="button" ng-click="mainCtrl.add()" class="btn btn-sm btn-primary btn-flat">
                                <i class="fa fa-plus-circle"></i> <span translate="">Add new tracker</span>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="list-group-item list-group-item-bar list-group-item-bar-{{tracker.enabled && 'success' || 'danger'}}" ng-repeat="tracker in settings.trackers">
                            <div class="pull-left">
                                <h4 class="list-group-item-heading">{{mainCtrl.getTracker(tracker.tracker_type, 'label')}}</h4>
                                <p class="list-group-item-text hidden-xs">
                                    <span translate="">{{mainCtrl.getTracker(tracker.tracker_type, 'field')}}:</span> {{tracker.tracker_code}}
                                </p>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-default btn-flat btn-sm" ng-click="mainCtrl.edit(tracker)">
                                    <i class="fa fa-pencil-square-o"></i> <span translate="">Edit tracker..</span>
                                </button>
                                <button type="button" class="btn btn-default btn-flat btn-sm" ng-click="mainCtrl.remove($index)" tooltip="Remove this tracker">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script type="text/ng-template" id="/tracker-edit-popup.html">
        <div class="box">
            <div class="box-header with-border">
                <b class="pull-left"><span translate="">Website tracker</span></b>
                <a class="pull-right close-button" href=""><i class="fa fa-times"></i></a>
                <div class="clearfix"></div>
            </div>

            <form class="form-horizontal" ng-submit="ctrl.save(tracker)" name="trackerForm">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-5 control-label"><span translate="">Tracker type:</span></label>
                        <div class="col-sm-7">
                            <select id="type" ng-model="tracker.tracker_type" ng-required="true" class="form-control">
                                <option ng-repeat="type in data.types" value="{{type.value}}">{{type.label}}</option>
                            </select>
                        </div>
                    </div>

                    <div ng-show="!!selected.field">
                        <div class="form-group">
                            <label class="col-sm-5 control-label" for="tracking_code"><span translate="">{{selected.field.field}}:</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="tracking_code" placeholder="Enter {{selected.field.field}}" ng-model="tracker.tracker_code" ng-required="true"
                                       minlength="5">
                                <p class="help-block"><span translate="">{{selected.field.hint}}</span></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label"><span translate="">Tracker enabled:</span></label>
                            <div class="col-sm-7">
                                <label class="radio-inline">
                                    <input type="radio" ng-model="tracker.enabled" ng-value="true"> <span translate="">Yes</span>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" ng-model="tracker.enabled" ng-value="false"> <span translate="">No</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer with-border">
                    <button type="submit" class="btn btn-flat btn-primary pull-right" ng-disabled="!trackerForm.$valid">
                        <span translate>Save tracker</span> <i class="fa fa-fw fa-angle-right"></i>
                    </button>
                </div>

            </form>
        </div>
    </script>

</div>
