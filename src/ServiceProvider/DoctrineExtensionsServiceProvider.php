<?php

namespace Cekurte\TwitterLike\ServiceProvider;

use Cekurte\Environment\Environment;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Gedmo\DoctrineExtensions;
use Gedmo\Loggable\LoggableListener;
use Gedmo\Sluggable\SluggableListener;
use Gedmo\Sortable\SortableListener;
use Gedmo\Timestampable\TimestampableListener;
use Gedmo\Translatable\TranslatableListener;
use Gedmo\Tree\TreeListener;
use Silex\Application;
use Silex\ServiceProviderInterface;

class DoctrineExtensionsServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
        if (!isset($app['db.event_manager'])) {
            throw new \RuntimeException('The DoctrineServiceProvider is not registered in this application');
        }

        if (Environment::get('DOCTRINE_EXTENSION_ENABLE_SLUGGABLE') === true) {
            $listener = new SluggableListener();
            $app['db.event_manager']->addEventSubscriber($listener);
        }

        if (Environment::get('DOCTRINE_EXTENSION_ENABLE_TREE') === true) {
            $listener = new TreeListener();
            $app['db.event_manager']->addEventSubscriber($listener);
        }

        if (Environment::get('DOCTRINE_EXTENSION_ENABLE_LOGGABLE') === true) {
            $listener = new LoggableListener();
            $app['db.event_manager']->addEventSubscriber($listener);
        }

        if (Environment::get('DOCTRINE_EXTENSION_ENABLE_TIMESTAMPABLE') === true) {
            $listener = new TimestampableListener();
            $app['db.event_manager']->addEventSubscriber($listener);
        }

        if (Environment::get('DOCTRINE_EXTENSION_ENABLE_TRANSLATABLE') === true) {
            $listener = new TranslatableListener();

            if (!isset($app['translator'])) {
                throw new \RuntimeException('The TranslationServiceProvider is not registered in this application');
            }

            $listener->setTranslatableLocale($app['translator']->getLocale());
            $listener->setDefaultLocale($app['translator']->getLocale());

            $app['db.event_manager']->addEventSubscriber($listener);
        }

        if (Environment::get('DOCTRINE_EXTENSION_ENABLE_SORTABLE') === true) {
            $listener = new SortableListener();
            $app['db.event_manager']->addEventSubscriber($listener);
        }
    }

    public function getMappings()
    {
        $doctrine = require CONFIG_PATH . DIRECTORY_SEPARATOR . 'doctrine.php';

        return $doctrine['orm']['orm.em.options']['mappings'];
    }

    public function getPaths(array $mappings)
    {
        $paths = [];

        foreach ($mappings as $mapping) {
            $paths[] = $mapping['path'];
        }

        return $paths;
    }

    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        if (!isset($app['orm.em'])) {
            throw new \RuntimeException('The DoctrineOrmServiceProvider is not registered in this application');
        }

        $mappings = $this->getMappings();

        $paths = $this->getPaths($mappings);

        $reader = new CachedReader(new AnnotationReader(), new ArrayCache());

        $driverChain = new MappingDriverChain();

        DoctrineExtensions::registerMappingIntoDriverChainORM($driverChain, $reader);

        $annotationDriver = new AnnotationDriver($reader, $paths);

        foreach ($mappings as $mapping) {
            $driverChain->addDriver($annotationDriver, $mapping['namespace']);
        }

        $app['orm.em']->getConfiguration()->setMetadataDriverImpl($driverChain);
    }
}
