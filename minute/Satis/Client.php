<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 10/2/2016
 * Time: 2:31 AM
 */
namespace Minute\Satis {

    use Minute\Http\Browser;

    class Client {
        const PLUGIN_URL = "https://plugins.minutephp.com/";

        /**
         * @var Browser
         */
        private $browser;

        /**
         * Client constructor.
         *
         * @param Browser $browser
         */
        public function __construct(Browser $browser) {
            $this->browser = $browser;
        }

        public function getPackages() {
            if ($satis = $this->browser->getUrl(self::PLUGIN_URL . 'packages.json')) {
                if ($json = json_decode($satis, true)) {
                    foreach ($json['includes'] as $url => $sha) {
                        if ($data = $this->browser->getUrl(self::PLUGIN_URL . $url)) {
                            if ($satis = json_decode($data, true)) {
                                foreach ($satis['packages'] as $name => $data) {
                                    $package    = end($data);
                                    $packages[] = [
                                        'name' => $package['name'],
                                        'src' => $package['source']['url'],
                                        'version' => $package['version_normalized'],
                                        'description' => $package['description'],
                                        'keywords' => $package['keywords']
                                    ];
                                }
                            }
                        }
                    }
                }
            }

            return $packages ?? [];
        }
    }
}