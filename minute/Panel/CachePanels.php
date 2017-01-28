<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 9/1/2016
 * Time: 4:03 AM
 */
namespace Minute\Panel {

    use Minute\Cache\QCache;
    use Minute\Event\AdminEvent;
    use Minute\Event\Dispatcher;
    use Minute\Event\ImportEvent;

    class CachePanels {
        /**
         * @var QCache
         */
        private $cache;
        /**
         * @var Dispatcher
         */
        private $dispatcher;

        /**
         * CachePanels constructor.
         *
         * @param QCache $cache
         * @param Dispatcher $dispatcher
         */
        public function __construct(QCache $cache, Dispatcher $dispatcher) {
            $this->cache      = $cache;
            $this->dispatcher = $dispatcher;
        }

        public function getCached(ImportEvent $event) {
            $data = $this->cache->get('admin-panels-cached', function () use ($event) {
                $fresh = new ImportEvent($event->getViewEvent());
                $this->dispatcher->fire(AdminEvent::IMPORT_ADMIN_DASHBOARD_PANELS, $fresh);

                return $fresh->getContent();
            }, 300);

            $event->setContent($data);
        }
    }
}