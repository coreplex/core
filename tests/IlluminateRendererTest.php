<?php

namespace Coreplex\Core\Tests;

class IlluminateRendererTest extends BaseTest
{
    public function testRendererLoadsView()
    {
        $renderer = $this->illuminateRenderer();
        $view = $renderer->make('test-view', ['foo' => 'bar']);

        $this->assertInternalType('string', $view);
        $this->assertContains('hello world', $view);
    }

    public function testDynamicDataCanBePassedToViews()
    {
        $renderer = $this->illuminateRenderer();
        $view = $renderer->make('test-view', ['foo' => 'bar']);

        $this->assertContains('bar', $view);
    }

    public function testViewsCanBeRenderedWithoutDynamicData()
    {
        $renderer = $this->illuminateRenderer();
        $view = $renderer->make('.test-view');

        $this->assertInternalType('string', $view);
        $this->assertContains('hello world', $view);
    }

    public function testExceptionThrownIfViewDoesNotExist()
    {
        $this->setExpectedException('Coreplex\\Core\\Exceptions\\ViewNotFoundException');

        $renderer = $this->illuminateRenderer();
        $renderer->make('foo-bar');
    }
}