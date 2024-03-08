<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\H;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Interop\RenderInterface, Semantic\H};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h1>value</h1>
            HTML,
            H::widget()->begin() . 'value' . H::end()
        );
    }

    public function testRender(): void
    {
        $instance = H::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <h1>
            </h1>
            HTML,
            $instance->render()
        );
    }

    public function testTagName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h2>
            value
            </h2>
            HTML,
            H::widget()->tagName('h2')->content('value')->render()
        );
    }
}
