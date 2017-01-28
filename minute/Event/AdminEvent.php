<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 7/8/2016
 * Time: 7:55 PM
 */
namespace Minute\Event {

    class AdminEvent extends Event {
        const IMPORT_ADMIN_MENU_LINKS       = "import.admin.menu.links";
        const IMPORT_ADMIN_DASHBOARD_PANELS = "import.admin.dashboard.panels";
        const IMPORT_ADMIN_EVENTS           = "import.admin.events";
        const IMPORT_CONFIG_TYPES           = "import.config.types";

        const IMPORT_ADMIN_DASHBOARD_PANELS_CACHED = "import.admin.dashboard.panels.cached";
    }
}