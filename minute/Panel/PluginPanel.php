<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 7/8/2016
 * Time: 7:57 PM
 */
namespace Minute\Panel {

    use Minute\Event\ImportEvent;

    class PluginPanel {
        public function adminDashboardPanel(ImportEvent $event) {
            $dir   = realpath(sprintf('%s/../../../', __DIR__));
            $dirs  = glob("$dir/*");
            $count = count($dirs) - 1; //ignore framework

            $panels = [['type' => 'site', 'title' => 'Plugins', 'stats' => "$count installed", 'icon' => 'fa-plug', 'priority' => 99, 'href' => '/admin/plugins', 'cta' => 'Get more..',
                        'bg' => 'bg-aqua']];

            $event->addContent($panels);
        }
    }
}