<?php

/** @var Router $router */
use Minute\Routing\Router;

$router->get('/admin', 'Admin/Dashboard', 'admin');

$router->get('/admin/config/{type}', 'Admin/SiteConfig', 'admin', 'm_configs[type][1] as configs')
       ->setReadPermission('configs', 'admin')->setDefault('type', 'public');
$router->post('/admin/config/{type}', null, 'admin', 'm_configs as configs')
       ->setAllPermissions('configs', 'admin')->setDefault('type', 'public');

$router->get('/admin/plugins', null, 'admin');
$router->get('/admin/plugins/installer', 'Admin/Plugins/Installer', 'admin');

$router->get('/admin/analytics', null, 'admin', 'm_configs[type] as configs')
       ->setReadPermission('configs', 'admin')->setDefault('type', 'trackers');
$router->post('/admin/analytics', null, 'admin', 'm_configs as configs')
       ->setAllPermissions('configs', 'admin');

$router->get('/admin/events', null, 'admin', 'm_events[5] as events')
       ->setReadPermission('events', 'admin')->setDefault('events', '*');
$router->post('/admin/events', null, 'admin', 'm_events as events')
       ->setAllPermissions('events', 'admin');

$router->get('/admin/events/edit/{event_id}', 'Admin/Events/Edit', 'admin', 'm_events[event_id] as events')
       ->setReadPermission('events', 'admin')->setDefault('event_id', '0');
$router->post('/admin/events/edit/{event_id}', null, 'admin', 'm_events as events')
       ->setAllPermissions('events', 'admin')->setDefault('event_id', '0');

$router->get('/admin/page-titles', null, 'admin', 'm_configs[type] as configs')
       ->setReadPermission('configs', 'admin')->setDefault('type', 'seo');
$router->post('/admin/page-titles', null, 'admin', 'm_configs as configs')
       ->setAllPermissions('configs', 'admin');

$router->get('/admin/user-groups', null, 'admin', 'm_configs[type] as configs')
       ->setReadPermission('configs', 'admin')->setDefault('type', 'groups');
$router->post('/admin/user-groups', null, 'admin', 'm_configs as configs')
       ->setAllPermissions('configs', 'admin');
