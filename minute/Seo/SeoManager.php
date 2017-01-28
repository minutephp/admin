<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 10/10/2016
 * Time: 5:15 AM
 */
namespace Minute\Seo {

    use Minute\Event\ImportEvent;
    use Minute\Routing\RouteEx;
    use Minute\Routing\Router;

    class SeoManager {
        /**
         * @var Router
         */
        private $router;

        /**
         * SeoManager constructor.
         *
         * @param Router $router
         */
        public function __construct(Router $router) {
            $this->router = $router;
        }

        public function getPages(ImportEvent $event) {
            $urls   = [];
            $routes = $this->router->getRouteCollection();

            /** @var RouteEx $route */
            foreach ($routes as $route) {
                $method  = $route->getMethods()[0];
                $hasView = $route->getDefault('_noView') !== true;

                if (($method === 'GET') && $hasView) {
                    $compiled = $route->compile();
                    $urls[] = $compiled->getStaticPrefix();
                    //$urls[$url] = !preg_match('~^/(admin|\_|first\-run|auth)~', $url);
                }
            }

            $event->setContent($urls);
        }
    }
}