<?php

namespace Cekurte\TwitterLike\Entity\Repository;

use Cekurte\Tdd\ReflectionTestCase;

class PostRepositoryTest extends ReflectionTestCase
{
    public function testExtendsAbstractController()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\TwitterLike\\Entity\\Repository\\PostRepository'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Doctrine\\ORM\\EntityRepository'
        ));
    }

    public function testFindResource()
    {
        $repository = $this
            ->getMockBuilder('\\Cekurte\\TwitterLike\\Entity\\Repository\\PostRepository')
            ->disableOriginalConstructor()
            ->setMethods(['createQueryBuilder', 'addOrderBy'])
            ->getMock()
        ;

        $repository
            ->expects($this->once())
            ->method('createQueryBuilder')
            ->will($this->returnValue($repository))
        ;

        $repository
            ->expects($this->once())
            ->method('addOrderBy')
            ->will($this->returnValue('working'))
        ;

        $queryBuilder = $repository->findResources();

        $this->assertEquals('working', $queryBuilder);
    }
}
