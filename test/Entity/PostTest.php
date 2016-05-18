<?php

namespace Cekurte\TwitterLike\Entity;

use Cekurte\Tdd\ReflectionTestCase;
use Cekurte\TwitterLike\Entity\Post;

class ApiControllerProviderTest extends ReflectionTestCase
{
    public function testImplementsControllerProviderInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\TwitterLike\\Entity\\Post'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\ResourceManager\\Contract\\ResourceInterface'
        ));
    }

    public function testGetId()
    {
        $post = new Post();

        $this->assertNull($post->getId());

        $this->propertySetValue($post, 'id', 1);

        $this->assertEquals(1, $post->getId());
    }

    public function testGetMessage()
    {
        $post = new Post();

        $this->assertNull($post->getMessage());

        $post->setMessage('message');

        $this->assertEquals('message', $post->getMessage());
    }

    public function testGetCreatedAt()
    {
        $post = new Post();

        $this->assertNull($post->getCreatedAt());

        $post->setCreatedAt(new \DateTime('NOW'));

        $this->assertInstanceOf(
            '\\DateTime',
            $post->getCreatedAt()
        );
    }
}
