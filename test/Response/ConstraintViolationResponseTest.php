<?php

namespace Cekurte\TwitterLike\Test\Response;

use Cekurte\Tdd\ReflectionTestCase;
use Cekurte\TwitterLike\Response\ConstraintViolationResponse;
use Silex\Application;
use Symfony\Component\Validator\ConstraintViolationList;

class ConstraintViolationResponseTest extends ReflectionTestCase
{
    public function testExtendsSymfonyResponse()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\TwitterLike\\Response\\ConstraintViolationResponse'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Symfony\\Component\\HttpFoundation\\Response'
        ));
    }

    public function testConstructor()
    {
        $errors = new ConstraintViolationList([
            $this->getMock('\\Symfony\\Component\\Validator\\ConstraintViolationInterface'),
            $this->getMock('\\Symfony\\Component\\Validator\\ConstraintViolationInterface'),
            $this->getMock('\\Symfony\\Component\\Validator\\ConstraintViolationInterface'),
        ]);

        $response = new ConstraintViolationResponse($errors, 401, [
            'X-Custom-Header' => 'custom',
        ]);

        $this->assertInstanceOf(
            '\\Symfony\\Component\\HttpFoundation\\Response',
            $response
        );

        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
        $this->assertEquals(401, $response->getStatusCode());
        $this->assertEquals('custom', $response->headers->get('X-Custom-Header'));

        $data = json_decode($response->getContent(), true);

        $this->assertCount(3, $data);
    }
}
