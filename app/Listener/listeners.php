<?php

/** @var Binding $binding */
use Minute\Config\ConfigManager;
use Minute\Event\AdminEvent;
use Minute\Event\Binding;
use Minute\Event\PluginEvent;
use Minute\Event\SeoEvent;
use Minute\Event\TodoEvent;
use Minute\EventManager\EventManager;
use Minute\Menu\AdminMenu;
use Minute\Panel\CachePanels;
use Minute\Panel\PluginPanel;
use Minute\Plugin\PluginManager;
use Minute\Seo\SeoManager;
use Minute\Todo\AdminTodo;

$binding->addMultiple([

    ['event' => AdminEvent::IMPORT_ADMIN_MENU_LINKS, 'handler' => [AdminMenu::class, 'adminLinks']],
    ['event' => AdminEvent::IMPORT_ADMIN_DASHBOARD_PANELS, 'handler' => [PluginPanel::class, 'adminDashboardPanel']],
    ['event' => AdminEvent::IMPORT_ADMIN_EVENTS, 'handler' => [EventManager::class, 'compile']],
    ['event' => PluginEvent::IMPORT_ADMIN_PLUGIN_LIST, 'handler' => [PluginManager::class, 'compile']],
    ['event' => AdminEvent::IMPORT_ADMIN_DASHBOARD_PANELS_CACHED, 'handler' => [CachePanels::class, 'getCached']],
    ['event' => AdminEvent::IMPORT_CONFIG_TYPES, 'handler' => [ConfigManager::class, 'getTypes']],

    //seo
    ['event' => SeoEvent::IMPORT_PAGE_LIST, 'handler' => [SeoManager::class, 'getPages']],

    //tasks
    ['event' => TodoEvent::IMPORT_TODO_ADMIN, 'handler' => [AdminTodo::class, 'getTodoList']],

]);