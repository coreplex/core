<?php

namespace Coreplex\Core\Tests;

class IlluminateSessionTest extends BaseTest
{
    public function setUp()
    {
        // Fixes issues with session_start and phpunit
        @session_start();
    }

    public function testSessionHasValue()
    {
        $session = $this->illuminateSession();
        $session->put('foo', 'bar');

        $this->assertEquals(true, $session->has('foo'));
    }

    public function testValueCanBeRetrievedFromSession()
    {
        $session = $this->illuminateSession();
        $session->put('foo', 'bar');

        $this->assertEquals('bar', $session->get('foo'));
    }

    public function testValueCanBeStoredInSession()
    {
        $session = $this->illuminateSession();
        $session->put('foo', 'bar');

        $this->assertEquals(true, $session->has('foo'));
    }

    public function testValueCanBeRemovedFromSession()
    {
        $session = $this->illuminateSession();
        $session->put('foo', 'bar');
        $session->forget('foo');

        $this->assertEquals(false, $session->has('foo'));
    }

    public function testValueCanBeFlashedToSession()
    {
        $session = $this->illuminateSession();
        $session->flash('foo', 'bar');

        $this->assertEquals(true, $session->has('flash'));
    }
}