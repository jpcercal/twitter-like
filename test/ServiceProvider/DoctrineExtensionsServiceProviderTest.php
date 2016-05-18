<?php

namespace Cekurte\TwitterLike\Test\ServiceProvider;

use Cekurte\Tdd\ReflectionTestCase;
use Cekurte\TwitterLike\ServiceProvider\DoctrineExtensionsServiceProvider;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TranslationServiceProvider;

class DoctrineExtensionsServiceProviderTest extends ReflectionTestCase
{
    public function setUp()
    {
        putenv('DOCTRINE_EXTENSION_ENABLE_SLUGGABLE=false');
        putenv('DOCTRINE_EXTENSION_ENABLE_TREE=false');
        putenv('DOCTRINE_EXTENSION_ENABLE_LOGGABLE=false');
        putenv('DOCTRINE_EXTENSION_ENABLE_TIMESTAMPABLE=false');
        putenv('DOCTRINE_EXTENSION_ENABLE_TRANSLATABLE=false');
        putenv('DOCTRINE_EXTENSION_ENABLE_SORTABLE=false');
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
        putenv('DOCTRINE_EXTENSION_ENABLE_SLUGGABLE=true');

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
        putenv('DOCTRINE_EXTENSION_ENABLE_TREE=true');

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
        putenv('DOCTRINE_EXTENSION_ENABLE_LOGGABLE=true');

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
        putenv('DOCTRINE_EXTENSION_ENABLE_TIMESTAMPABLE=true');

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
        putenv('DOCTRINE_EXTENSION_ENABLE_TRANSLATABLE=true');

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

    public function testBootEnableGedmoExtensionTranslatable()
    {
        putenv('DOCTRINE_EXTENSION_ENABLE_TRANSLATABLE=true');

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
        putenv('DOCTRINE_EXTENSION_ENABLE_SORTABLE=true');

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
}
