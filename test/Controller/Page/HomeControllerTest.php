<?php

namespace Cekurte\TwitterLike\Test\Controller\Page;

use Silex\Application;

class HomeControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testExtendsAbstractController()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\TwitterLike\\Controller\\Page\\HomeController'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Cekurte\\TwitterLike\\Controller\\AbstractController'
        ));
    }

    public function testIndexAction()
    {
        $controller = $this
            ->getMockBuilder('\\Cekurte\\TwitterLike\\Controller\\Page\\HomeController')
            ->disableOriginalConstructor()
            ->setMethods(['getApp'])
            ->getMock()
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
