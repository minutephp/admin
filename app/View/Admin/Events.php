<div class="content-wrapper ng-cloak" ng-app="eventListApp" ng-controller="eventListController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1><span translate="">List of events</span></h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-event"></i> <span translate="">Event list</span></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span translate="">All events</span>
                    </h3>

                    <div class="box-tools">
                        <a class="btn btn-sm btn-primary btn-flat" ng-href="/admin/events/edit">
                            <i class="fa fa-plus-circle"></i> <span translate="">Create new event</span>
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-bar list-group-item-bar-default"
                             ng-repeat="event in events" ng-click-container="mainCtrl.actions(event)">
                            <div class="pull-left">
                                <span class="list-group-item-heading"><b>Event:</b> "{{event.name}}" <i class="fa fa-long-arrow-right"></i> {{mainCtrl.handler(event.handler)}}</span>
                                <p class="list-group-item-text hidden-xs">
                                    <span translate="">Comments:</span> {{event.comments || 'None'}}.
                                </p>
                            </div>
                            <div class="md-actions pull-right">
                                <a class="btn btn-default btn-flat btn-sm" ng-href="/admin/events/edit/{{event.event_id}}">
                                    <i class="fa fa-pencil-square-o"></i> <span translate="">Edit..</span>
                                </a>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-md-push-6">
                            <minute-pager class="pull-right" on="events" no-results="{{'No events found' | translate}}"></minute-pager>
                        </div>
                        <div class="col-xs-12 col-md-6 col-md-pull-6">
                            <minute-search-bar on="events" columns="name, handler, comments" label="{{'Search event..' | translate}}"></minute-search-bar>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
