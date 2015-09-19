<?php

namespace Coreplex\Core\Tests;

class NativeRendererTest extends BaseTest
{
    public function testRendererLoadsView()
    {
        $renderer = $this->renderer();
        $view = $renderer->make(__DIR__ . '/test-view.php', ['foo' => 'bar']);

        $this->assertInternalType('string', $view);
        $this->assertContains('hello world', $view);
    }

    public function testDynamicDataCanBePassedToViews()
    {
        $renderer = $this->renderer();
        $view = $renderer->make(__DIR__ . '/test-view.php', ['foo' => 'bar']);

        $this->assertContains('bar', $view);
    }

    public function testViewsCanBeRenderedWithoutDynamicData()
    {
        $renderer = $this->renderer();
        $view = $renderer->make(__DIR__ . '/test-view.php');

        $this->assertInternalType('string', $view);
        $this->assertContains('hello world', $view);
    }

    public function testExceptionThrownIfViewDoesNotExist()
    {
        $this->setExpectedException('Coreplex\\Core\\Exceptions\\ViewNotFoundException');

        $renderer = $this->renderer();
        $renderer->make(__DIR__ . '/foo-bar.php');
    }
}