<?php

namespace Cekurte\TwitterLike\Test\ServiceProvider;

use Cekurte\Tdd\ReflectionTestCase;
use Cekurte\TwitterLike\ServiceProvider\DoctrineExtensionsServiceProvider;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TranslationServiceProvider;

class DoctrineExtensionsServiceProviderTest extends ReflectionTestCase
{
    public function setUp()
    {
        $_ENV['DOCTRINE_EXTENSION_ENABLE_SLUGGABLE'] = 'false';
        $_ENV['DOCTRINE_EXTENSION_ENABLE_TREE'] = 'false';
        $_ENV['DOCTRINE_EXTENSION_ENABLE_LOGGABLE'] = 'false';
        $_ENV['DOCTRINE_EXTENSION_ENABLE_TIMESTAMPABLE'] = 'false';
        $_ENV['DOCTRINE_EXTENSION_ENABLE_TRANSLATABLE'] = 'false';
        $_ENV['DOCTRINE_EXTENSION_ENABLE_SORTABLE'] = 'false';
    }

    public function testImplementsControllerProviderInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\TwitterLike\\ServiceProvider\\DoctrineExtensionsServiceProvider'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Silex\\ServiceProviderInterface'
        ));
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The DoctrineServiceProvider is not registered in this application
     */
    public function testBootException()
    {
        $provider = new DoctrineExtensionsServiceProvider();

        $provider->boot(new Application());
    }

    public function testBootEnableGedmoExtensionSluggable()
    {
        $_ENV['DOCTRINE_EXTENSION_ENABLE_SLUGGABLE'] = 'true';

        $provider = new DoctrineExtensionsServiceProvider();

        $application = new Application();

        $application['db.event_manager'] = function () {
            $service = $this
                ->getMockBuilder('\\Silex\\Provider\\DoctrineServiceProvider')
                ->disableOriginalConstructor()
                ->setMethods(['addEventSubscriber'])
                ->getMock()
            ;

            $service
                ->expects($this->once())
                ->method('addEventSubscriber')
                ->will($this->returnValue(null))
            ;

            return $service;
        };

        $provider->boot($application);
    }

    public function testBootEnableGedmoExtensionTree()
    {
        $_ENV['DOCTRINE_EXTENSION_ENABLE_TREE'] = 'true';

        $provider = new DoctrineExtensionsServiceProvider();

        $application = new Application();

        $application['db.event_manager'] = function () {
            $service = $this
                ->getMockBuilder('\\Silex\\Provider\\DoctrineServiceProvider')
                ->disableOriginalConstructor()
                ->setMethods(['addEventSubscriber'])
                ->getMock()
            ;

            $service
                ->expects($this->once())
                ->method('addEventSubscriber')
                ->will($this->returnValue(null))
            ;

            return $service;
        };

        $provider->boot($application);
    }

    public function testBootEnableGedmoExtensionLoggable()
    {
        $_ENV['DOCTRINE_EXTENSION_ENABLE_LOGGABLE'] = 'true';

        $provider = new DoctrineExtensionsServiceProvider();

        $application = new Application();

        $application['db.event_manager'] = function () {
            $service = $this
                ->getMockBuilder('\\Silex\\Provider\\DoctrineServiceProvider')
                ->disableOriginalConstructor()
                ->setMethods(['addEventSubscriber'])
                ->getMock()
            ;

            $service
                ->expects($this->once())
                ->method('addEventSubscriber')
                ->will($this->returnValue(null))
            ;

            return $service;
        };

        $provider->boot($application);
    }

    public function testBootEnableGedmoExtensionTimestampable()
    {
        $_ENV['DOCTRINE_EXTENSION_ENABLE_TIMESTAMPABLE'] = 'true';

        $provider = new DoctrineExtensionsServiceProvider();

        $application = new Application();

        $application['db.event_manager'] = function () {
            $service = $this
                ->getMockBuilder('\\Silex\\Provider\\DoctrineServiceProvider')
                ->disableOriginalConstructor()
                ->setMethods(['addEventSubscriber'])
                ->getMock()
            ;

            $service
                ->expects($this->once())
                ->method('addEventSubscriber')
                ->will($this->returnValue(null))
            ;

            return $service;
        };

        $provider->boot($application);
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The TranslationServiceProvider is not registered in this application
     */
    public function testBootEnableGedmoExtensionTranslatableIsNotRegistered()
    {
        $_ENV['DOCTRINE_EXTENSION_ENABLE_TRANSLATABLE'] = 'true';

        $provider = new DoctrineExtensionsServiceProvider();

        $application = new Application();
        $application->register(new DoctrineServiceProvider());

        $provider->boot($application);
    }

    public function testBootEnableGedmoExtensionTranslatable()
    {
        $_ENV['DOCTRINE_EXTENSION_ENABLE_TRANSLATABLE'] = 'true';

        $provider = new DoctrineExtensionsServiceProvider();

        $application = new Application();
        $application->register(new TranslationServiceProvider());

        $application['db.event_manager'] = function () {
            $service = $this
                ->getMockBuilder('\\Silex\\Provider\\DoctrineServiceProvider')
                ->disableOriginalConstructor()
                ->setMethods(['addEventSubscriber'])
                ->getMock()
            ;

            $service
                ->expects($this->once())
                ->method('addEventSubscriber')
                ->will($this->returnValue(null))
            ;

            return $service;
        };

        $provider->boot($application);
    }

    public function testBootEnableGedmoExtensionSortable()
    {
        $_ENV['DOCTRINE_EXTENSION_ENABLE_SORTABLE'] = 'true';

        $provider = new DoctrineExtensionsServiceProvider();

        $application = new Application();

        $application['db.event_manager'] = function () {
            $service = $this
                ->getMockBuilder('\\Silex\\Provider\\DoctrineServiceProvider')
                ->disableOriginalConstructor()
                ->setMethods(['addEventSubscriber'])
                ->getMock()
            ;

            $service
                ->expects($this->once())
                ->method('addEventSubscriber')
                ->will($this->returnValue(null))
            ;

            return $service;
        };

        $provider->boot($application);
    }

    public function testBoot()
    {
        $provider = new DoctrineExtensionsServiceProvider();

        $application = new Application();
        $application->register(new DoctrineServiceProvider());

        $provider->boot($application);
    }

    public function testGetMappings()
    {
        $provider = new DoctrineExtensionsServiceProvider();

        $this->assertTrue(is_array($provider->getMappings()));
    }

    public function testGetPaths()
    {
        $provider = new DoctrineExtensionsServiceProvider();

        $this->assertTrue(is_array($provider->getPaths($provider->getMappings())));
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The DoctrineOrmServiceProvider is not registered in this application
     */
    public function testRegisterException()
    {
        $provider = new DoctrineExtensionsServiceProvider();

        $provider->register(new Application());
    }

    public function testRegister()
    {
        $provider = $this
            ->getMockBuilder('\\Cekurte\\TwitterLike\\ServiceProvider\\DoctrineExtensionsServiceProvider')
            ->disableOriginalConstructor()
            ->setMethods(['getMappings', 'getPaths'])
            ->getMock()
        ;

        $provider
            ->expects($this->once())
            ->method('getMappings')
            ->will($this->returnValue([
                [
                    'namespace' => '\\Cekurte\\TwitterLike\\Entity',
                    'path' => APP_PATH . DS . 'Entity'
                ]
            ]))
        ;

        $provider
            ->expects($this->once())
            ->method('getPaths')
            ->will($this->returnValue([
                ['path' => APP_PATH . DS . 'Entity']
            ]))
        ;

        $application = new Application();
        $application->register(new DoctrineServiceProvider());
        $application->register(new DoctrineOrmServiceProvider(), require CONFIG_PATH . DS . 'doctrine.php');

        $provider->register($application);
    }
}
