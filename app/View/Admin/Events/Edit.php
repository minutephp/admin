<div class="content-wrapper ng-cloak" ng-app="eventEditApp" ng-controller="eventEditController as mainCtrl" ng-init="init()">
    <div class="admin-content" minute-hot-keys="{'ctrl+s':mainCtrl.save}">
        <section class="content-header">
            <h1>
                <span translate="" ng-show="!event.event_id">Create new</span>
                <span translate="" ng-show="!!event.event_id">Edit</span>
                <span translate="">event</span>
            </h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li><a href="" ng-href="/admin/events"><i class="fa fa-event"></i> <span translate="">Events</span></a></li>
                <li class="active"><i class="fa fa-edit"></i> <span translate="">Edit event</span></li>
            </ol>
        </section>

        <section class="content">
            <minute-event name="import.admin.events" as="data.events"></minute-event>
            <form class="form-horizontal" name="eventForm" ng-submit="mainCtrl.save()">
                <div class="box box-{{eventForm.$valid && 'success' || 'danger'}}">
                    <div class="box-header with-border">
                        <span translate="" ng-show="!event.event_id">New event</span>
                        <span ng-show="!!event.event_id"><span translate="">Edit</span> {{event.name}}</span>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"><span translate="">Event name:</span></label>
                            <div class="col-sm-9">
                                <ol class="nya-bs-select form-control" ng-model="event.name" ng-required="true" data-live-search="true" size="15">
                                    <li nya-bs-option="event in data.events.constants group by event.group" value="event.value" ng-show="data.showAll || (event.group !== 'Wildcard events')">
                                        <span class="dropdown-header">{{$group | ucfirst}}</span>
                                        <a>
                                            <span>{{event.name | ucfirst}}</span> <!-- this content will be search first -->
                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span translate="">Event handler:</span></label>
                            <div class="col-sm-9">
                                <ol class="nya-bs-select form-control" ng-model="event.handler" ng-required="true" data-live-search="true" size="15">
                                    <li nya-bs-option="handler in data.events.handlers group by handler.group" value="handler.value">
                                        <span class="dropdown-header">{{$group}}</span>
                                        <a>
                                            <span>{{handler.name | ucfirst}}</span> <!-- this content will be search first -->
                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                        </a>
                                    </li>
                                </ol>

                                <p class="help-block text-small">(Controllers in <code>app\EventHandler</code> or <code>minute\EventHandler</code> folders are visible here)</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="data"><span translate="">Event Data:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="data" placeholder="Optional data to pass to event handler like template name, JSON, etc" ng-model="event.data"
                                       ng-required="false">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="comments"><span translate="">Comments:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="comments" placeholder="Optional comment about this event and handler" ng-model="event.comments" ng-required="false">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="priority"><span translate="">Priority:</span></label>
                            <div class="col-sm-9">
                                <input type="number" step="1" class="form-control" id="priority" placeholder="Event handler priority" ng-model="event.priority" ng-required="true" min="-100" max="100">
                                <p class="help-block"><span translate="">(handlers with higher number priority will be called first)</span></p>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer with-border">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-flat btn-primary">
                                    <span translate="" ng-show="!event.event_id">Create</span>
                                    <span translate="" ng-show="!!event.event_id">Update</span>
                                    <span translate="">event</span>
                                    <i class="fa fa-fw fa-angle-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" ng-model="data.showAll"> <span translate="">Show wildcard events</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </section>
    </div>
</div>