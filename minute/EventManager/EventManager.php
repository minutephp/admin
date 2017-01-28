<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 8/31/2016
 * Time: 11:45 PM
 */
namespace Minute\EventManager {

    use App\Model\MEventName;
    use Minute\Cache\QCache;
    use Minute\Event\ImportEvent;
    use Minute\Resolver\Resolver;
    use Minute\Utils\PathUtils;
    use ReflectionClass;
    use ReflectionMethod;
    use Symfony\Component\Finder\Finder;

    class EventManager {
        /**
         * @var Resolver
         */
        private $resolver;
        /**
         * @var Finder
         */
        private $finder;
        /**
         * @var QCache
         */
        private $cache;
        /**
         * @var PathUtils
         */
        private $utils;

        /**
         * EventManager constructor.
         *
         * @param Resolver $resolver
         * @param Finder $finder
         * @param QCache $cache
         * @param PathUtils $utils
         */
        public function __construct(Resolver $resolver, Finder $finder, QCache $cache, PathUtils $utils) {
            $this->resolver = $resolver;
            $this->finder   = $finder;
            $this->cache    = $cache;
            $this->utils    = $utils;
        }

        public function compile(ImportEvent $importEvent) {
            $results   = ['constants' => [], 'handlers' => []];
            $wildcards = [];

            foreach (['constants', 'handlers'] as $type) {
                $e = $type === 'constants';

                foreach (['App', 'Minute'] as $dir) {
                    $prefix = $e ? "$dir\\Event\\" : "$dir\\EventHandler\\";
                    $dirs   = $this->resolver->find($prefix);

                    if (!empty($dirs)) {
                        $finder = new Finder();
                        $fix    = function ($path, $replacement) use ($prefix) { return preg_replace('/\.php$/', '', preg_replace(sprintf('/^.*%s/i', preg_quote($prefix)), $replacement, $path)); };
                        $files  = $finder->depth('< 3')->files()->in($dirs)->name('*.php')->contains($e ? 'const ' : 'function ');

                        foreach ($files as $file) {
                            $classPath = $this->utils->dosPath((string) $file);
                            $classPath = $fix($classPath, $prefix);
                            $basename  = $fix($classPath, '');

                            if ($reflector = new ReflectionClass($classPath)) {
                                if ($e) {
                                    foreach ($reflector->getConstants() as $value => $constant) {
                                        $parts = explode('.', $constant);

                                        for ($i = 0, $j = count($parts) - 1; $i < $j; $i++) {
                                            $wildcard = join('.', array_slice($parts, 0, $i + 1)) . '.*';;
                                            $wildcards[$wildcard] = ['name' => sprintf('%s', strtr($wildcard, '.', '_')), 'value' => $wildcard, 'group' => 'Wildcard events'];
                                        }

                                        $results['constants'][] = ['name' => sprintf('%s in %s', $this->utils->filename($value), $basename), 'value' => $constant, 'group' => $parts[0]];
                                    }
                                } else {
                                    foreach ($reflector->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                                        if (!preg_match('/^\_/', $method->name)) {
                                            $value = sprintf("%s@%s", $method->class, $method->name);
                                            $parts = explode('\\', $classPath);

                                            $results['handlers'][] = ['name' => sprintf('%s@%s', $basename, $method->name), 'value' => $value, 'group' => $parts[2] ?? 'App'];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                usort($results[$type], function ($a, $b) { return $a['group'] === $b['group'] ? $a['value'] <=> $b['value'] : $a['group'] <=> $b['group']; });
            }

            usort($wildcards, function ($a, $b) { return $a['value'] <=> $b['value']; });
            foreach ($wildcards as $wildcard => $event) {
                $results['constants'][] = $event;
            }

            $importEvent->addContent($results);
        }

        public function getEventIdByEventName(string $eventName) {
            return $this->cache->get("event-name-$eventName", function () use ($eventName) {
                if (!($event = MEventName::where('event_name', '=', $eventName)->first())) {
                    MEventName::unguard(true);

                    $event = MEventName::create(['event_name' => $eventName]);
                }

                return !empty($event) ? $event->event_name_id : 0;
            }, 86400);
        }
    }
}