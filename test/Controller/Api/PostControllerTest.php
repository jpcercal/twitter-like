<?php

namespace Cekurte\TwitterLike\Test\Controller\Api;

use Cekurte\Tdd\ReflectionTestCase;
use Silex\Application;

class PostControllerTest extends ReflectionTestCase
{
    public function testExtendsAbstractController()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\TwitterLike\\Controller\\Api\\PostController'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Cekurte\\TwitterLike\\Controller\\AbstractController'
        ));
    }

    public function testGetResourceManager()
    {
        $controller = $this
            ->getMockBuilder('\\Cekurte\\TwitterLike\\Controller\\Api\\PostController')
            ->disableOriginalConstructor()
            ->setMethods(['getApp'])
            ->getMock()
        ;

        $application = new Application();

        $application['orm.em'] = function () {
            return $this->getMock('\\Doctrine\\ORM\\EntityManagerInterface');
        };

        $controller
            ->expects($this->once())
            ->method('getApp')
            ->will($this->returnValue($application))
        ;

        $resourceManager = $this->invokeMethod($controller, 'getResourceManager', []);

        $this->isInstanceOf(
            '\\Cekurte\\ResourceManager\\Service\\DoctrineResourceManager',
            $resourceManager
        );
    }
}
