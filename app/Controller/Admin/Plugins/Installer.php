<?php
/**
 * Created by: MinutePHP framework
 */
namespace App\Controller\Admin\Plugins {

    use Minute\Plugin\PluginInstaller;

    class Installer {
        /**
         * @var PluginInstaller
         */
        private $installer;

        /**
         * Installer constructor.
         *
         * @param PluginInstaller $installer
         */
        public function __construct(PluginInstaller $installer) {
            $this->installer = $installer;
        }

        public function index($name, $mode) {
            echo '<html><title>Plugin installer</title><head><script>var interval = setInterval(function(){window.scrollTo(0,document.body.scrollHeight);}, 1000);</script></head><body>';
            echo '<pre>';
            $pass = $this->installer->install([$name], $mode == 'remove' ? 'remove' : 'require', false);
            echo '</pre>';
            echo '<script>clearInterval(interval);</script>';

            echo $pass ? printf('<scrip' . 't>self.opener.location.reload(); self.close();</script>') : '<h3>Sorry, could not install plugin at this time.</h3>';

            echo '</body></html>';
        }
    }
}