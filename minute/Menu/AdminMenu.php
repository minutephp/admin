<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 7/8/2016
 * Time: 7:57 PM
 */
namespace Minute\Menu {

    use Minute\Event\ImportEvent;

    class AdminMenu {
        public function adminLinks(ImportEvent $event) {
            $links = [
                'dashboard' => ['title' => 'Dashboard', 'href' => '/admin', 'icon' => 'fa-dashboard', 'priority' => 1],
                'user-groups' => ['title' => 'User groups', 'icon' => 'fa-users', 'priority' => 2, 'parent' => 'expert', 'href' => '/admin/user-groups'],
                'plugins' => ['title' => 'Plugins', 'icon' => 'fa-plug', 'priority' => 999, 'href' => '/admin/plugins'],
                'expert' => ['title' => 'Expert users', 'icon' => 'fa-th', 'priority' => 98],
                'config' => ['title' => 'Site config', 'icon' => 'fa-cog', 'priority' => 3, 'parent' => 'expert', 'href' => '/admin/config'],
                'seo' => ['title' => 'Page titles / SEO', 'icon' => 'fa-search', 'priority' => 4, 'parent' => 'expert', 'href' => '/admin/page-titles'],
                'analytics' => ['title' => 'Web analytics', 'icon' => 'fa-area-chart', 'priority' => 9, 'parent' => 'expert', 'href' => '/admin/analytics'],
                'event-manager' => ['title' => 'Events manager', 'icon' => 'fa-magnet', 'priority' => 99, 'parent' => 'expert', 'href' => '/admin/events'],
            ];

            $event->addContent($links);
        }
    }
}