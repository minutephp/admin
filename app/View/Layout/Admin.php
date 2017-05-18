<link rel="stylesheet" href="/static/bower_components/AdminLTE/dist/css/AdminLTE.css" />
<link rel="stylesheet" href="/static/bower_components/AdminLTE/dist/css/skins/skin-blue.css" />
<link rel="stylesheet" href="/static/bower_components/angular-loading-bar/build/loading-bar.css" />
<link rel="stylesheet" href="/static/bower_components/jquery-ui/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="/static/bower_components/angular-tree-menu/src/css/angular-tree-menu.css" />

<script>var tooltip = jQuery.fn.tooltip;</script>
<script src="/static/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>jQuery.fn.tooltip = tooltip;</script>

<script src="/static/bower_components/mousetrap/mousetrap.js"></script>
<script src="/static/bower_components/lodash/dist/lodash.js"></script>
<script src="/static/bower_components/angular-filter/dist/angular-filter.js"></script>
<script src="/static/bower_components/AdminLTE/plugins/daterangepicker/moment.js"></script>
<script src="/static/bower_components/angular-loading-bar/build/loading-bar.js"></script>
<script src="/static/bower_components/angular-bs-tip/src/js/angular-bs-tip.js"></script>
<script src="/static/bower_components/angular-sanitize/angular-sanitize.js"></script>
<script src="/js/translations.js"></script>

<script src="/static/bower_components/AdminLTE/dist/js/app.min.js"></script>

<div class="wrapper">
    <div ng-controller="adminController as admin" ng-init="admin.init()" id="adminContainer">
        <header class="main-header">

            <!-- Logo -->
            <a ng-href="/admin" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{{session.site.site_name_short || 'A'}}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>{{session.site.site_name || 'Admin'}}</b></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a ng-href="/logout">
                                <i class="fa fa-sign-out"></i>
                                <span translate="">Sign out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">


                <div class="user-panel">
                    <div class="pull-left image">
                        <a ng-href="/admin/users/edit/{{session.user.user_id}}">
                            <img ng-src="{{session.user.photo_url || '//i.imgur.com/d9LPirr.png'}}" class="img-circle" alt="User Image">
                        </a>
                    </div>
                    <div class="pull-left info">
                        <p>{{session.user.first_name || 'Admin'}}</p>
                        <a ng-href="/admin" ng-if="session.site.version === 'debug'"><i class="fa fa-circle text-danger"></i> Localhost</a>
                        <a ng-href="/admin" ng-if="session.site.version !== 'debug'"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- search form (Optional) -->
                <form ng-submit="false" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" ng-model="data.search" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="button" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">

                    <minute-event name="import.admin.menu.links" as="admin.links"></minute-event>

                    <angular-tree-menu items="admin.links" search="{{data.search}}"></angular-tree-menu>

                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
    </div>


    <minute-include-content></minute-include-content>

</div>

<script>
    angular.bootstrap(document.getElementById("adminContainer"), ['AdminApp']);
</script>
