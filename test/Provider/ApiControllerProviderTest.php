<?php

namespace Cekurte\TwitterLike\Test\Provider;

use Cekurte\Tdd\ReflectionTestCase;
use Cekurte\TwitterLike\ControllerProvider\ApiControllerProvider;

class ApiControllerProviderTest extends ReflectionTestCase
{
    public function testImplementsControllerProviderInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\TwitterLike\\ControllerProvider\\ApiControllerProvider'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Silex\\ControllerProviderInterface'
        ));
    }

    public function testConnect()
    {
        $application = $this
            ->getMockBuilder('\\Silex\\Application')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $application['controllers_factory'] = function () {
            $service = $this
                ->getMockBuilder('\\Silex\\Provider\\ServiceControllerServiceProvider')
                ->disableOriginalConstructor()
                ->setMethods(['get', 'post', 'bind'])
                ->getMock()
            ;

            $service
                ->expects($this->once())
                ->method('get')
                ->will($this->returnValue($service))
            ;

            $service
                ->expects($this->once())
                ->method('post')
                ->will($this->returnValue($service))
            ;

            $service
                ->expects($this->exactly(2))
                ->method('bind')
                ->will($this->returnValue(null))
            ;

            return $service;
        };

        $this->assertInstanceOf(
            '\\Silex\\Provider\\ServiceControllerServiceProvider',
            (new ApiControllerProvider())->connect($application)
        );
    }
}
