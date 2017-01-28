<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 9/5/2016
 * Time: 4:53 AM
 */
namespace Minute\Config {

    use App\Model\MConfig;
    use Minute\Event\ImportEvent;

    class ConfigManager {
        public function getTypes(ImportEvent $event) {
            $types = array_map(function($f) { return $f['TYPE']; }, MConfig::select('TYPE')->get()->toArray());
            $event->setContent(['types' => $types]);
        }
    }
}