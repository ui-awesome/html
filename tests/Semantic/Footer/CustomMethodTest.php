<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\Footer;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Interop\RenderInterface, Semantic\Footer};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer>value</footer>
            HTML,
            Footer::widget()->begin() . 'value' . Footer::end()
        );
    }

    public function testRender(): void
    {
        $instance = Footer::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <footer>
            </footer>
            HTML,
            $instance->render()
        );
    }
}
