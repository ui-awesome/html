<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\Header;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Interop\RenderInterface, Semantic\Header};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <header>value</header>
            HTML,
            Header::widget()->begin() . 'value' . Header::end()
        );
    }

    public function testRender(): void
    {
        $instance = Header::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <header>
            </header>
            HTML,
            $instance->render()
        );
    }
}
