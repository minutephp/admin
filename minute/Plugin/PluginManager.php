<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 9/1/2016
 * Time: 5:42 AM
 */
namespace Minute\Plugin {

    use Minute\Cache\QCache;
    use Minute\Event\ImportEvent;
    use Minute\Satis\Client;

    class PluginManager {
        /**
         * @var Client
         */
        private $client;
        /**
         * @var QCache
         */
        private $cache;

        /**
         * PluginManager constructor.
         *
         * @param Client $client
         * @param QCache $cache
         */
        public function __construct(Client $client, QCache $cache) {
            $this->client = $client;
            $this->cache  = $cache;
        }

        public function compile(ImportEvent $event) {
            $plugins = [];
            $basedir = realpath(sprintf('%s/../../../..', __DIR__));
            $results = $this->cache->get('plugin-list', function () {
                return $this->client->getPackages();
            }, 300);

            foreach ($results ?? [] as $package) {
                $plugin = $package['name'];

                if (($plugin !== 'minutephp/minutephp') && ($plugin !== 'minutephp/framework')) {
                    $name     = join(' ', array_slice(preg_split('/\W+/', $plugin), 1));
                    $vendor   = dirname($plugin);
                    $official = $vendor === 'minutephp';
                    $type     = $official ? 'official' : 'thirdparty';
                    $required = ['admin', 'framework'];

                    $plugins[$type][] = ['plugin' => $plugin, 'name' => $name, 'description' => $package['description'], 'installed' => is_dir("$basedir/$plugin"),
                                         'required' => $official && in_array($name, $required), 'src' => $package['src']];
                }
            }

            $event->setContent($plugins);
        }
    }
}