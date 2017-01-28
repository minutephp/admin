<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 11/5/2016
 * Time: 11:04 AM
 */
namespace Minute\Todo {

    use Minute\Config\Config;
    use Minute\Event\ImportEvent;

    class AdminTodo {
        /**
         * @var TodoMaker
         */
        private $todoMaker;
        /**
         * @var Config
         */
        private $config;

        /**
         * MailerTodo constructor.
         *
         * @param TodoMaker $todoMaker - This class is only called by TodoEvent (so we assume TodoMaker is be available)
         * @param Config $config
         */
        public function __construct(TodoMaker $todoMaker, Config $config) {
            $this->todoMaker = $todoMaker;
            $this->config    = $config;
        }

        public function getTodoList(ImportEvent $event) {
            $titles = $this->config->get('seo/titles', []);
            $groups = $this->config->get('groups/groups', []);

            $todos[] = ['name' => 'Create a "signature" key in public keys', 'description' => 'To use {signature} tag in emails',
                        'status' => $this->config->get('public/signature') ? 'complete' : 'incomplete', 'link' => '/admin/config'];
            $todos[] = ['name' => 'Create a "logo_dark_url" key in public keys', 'description' => 'Logo image for white background',
                        'status' => $this->config->get('public/logo_dark_url') ? 'complete' : 'incomplete', 'link' => '/admin/config'];
            $todos[] = ['name' => 'Create a "logo_light_url" key in public keys', 'description' => 'Logo image for black background',
                        'status' => $this->config->get('public/logo_light_url') ? 'complete' : 'incomplete', 'link' => '/admin/config'];
            $todos[] = ['name' => 'Enable "Minify" plugin to compress js and css', 'description' => 'For faster website loading',
                        'status' => is_callable(['Minute\\Minify\\Minify', 'minify']) ? 'complete' : 'incomplete', 'link' => '/admin/plugins'];
            $todos[] = ['name' => 'Install web analytics', 'description' => 'For measuring traffic and advertising ROI',
                        'status' => !empty($this->config->get('trackers/trackers')) ? 'complete' : 'incomplete', 'link' => '/admin/analytics'];
            $todos[] = ['name' => 'Setup user groups for site', 'description' => 'To control website access',
                        'status' => is_array($groups) && count($groups) > 1 ? 'complete' : 'incomplete', 'link' => '/admin/user-groups'];

            $todos[] = $this->todoMaker->createManualItem("page-titles", "Setup page titles and descriptions", 'Helps improve website SEO', '/admin/page-titles');

            $event->addContent(['Admin' => $todos]);
        }
    }
}