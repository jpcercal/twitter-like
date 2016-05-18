<?php

namespace Cekurte\TwitterLike\Test\Controller;

use Silex\Application;

class AbstractControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testIsAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\TwitterLike\\Controller\\AbstractController'
        );

        $this->assertTrue($reflection->isAbstract());
    }

    public function testGetApp()
    {
        $controller = $this
            ->getMockBuilder('\\Cekurte\\TwitterLike\\Controller\\AbstractController')
            ->setConstructorArgs([new Application()])
            ->getMockForAbstractClass()
        ;

        $this->assertInstanceOf(
            '\\Silex\\Application',
            $controller->getApp()
        );
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The TwigServiceProvider is not registered in this application
     */
    public function testRenderException()
    {
        $controller = $this
            ->getMockBuilder('\\Cekurte\\TwitterLike\\Controller\\AbstractController')
            ->disableOriginalConstructor()
            ->setMethods(['getApp'])
            ->getMockForAbstractClass()
        ;

        $controller
            ->expects($this->once())
            ->method('getApp')
            ->will($this->returnValue(new Application()))
        ;

        $controller->render('fakeView');
    }

    public function testRender()
    {
        $controller = $this
            ->getMockBuilder('\\Cekurte\\TwitterLike\\Controller\\AbstractController')
            ->disableOriginalConstructor()
            ->setMethods(['getApp'])
            ->getMockForAbstractClass()
        ;

        $application = new Application();

        $application['twig'] = function () {
            $service = $this
                ->getMockBuilder('\\Silex\\Provider\\TwigServiceProvider')
                ->disableOriginalConstructor()
                ->setMethods(['render'])
                ->getMock()
            ;

            $service
                ->expects($this->once())
                ->method('render')
                ->will($this->returnValue('working'))
            ;

            return $service;
        };

        $controller
            ->expects($this->once())
            ->method('getApp')
            ->will($this->returnValue($application))
        ;

        $this->assertEquals('working', $controller->render('fakeView'));
    }
}
