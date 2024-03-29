<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Main;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Group\Main, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main>value</main>
            HTML,
            Main::widget()->begin() . 'value' . Main::end()
        );
    }

    public function testRender(): void
    {
        $instance = Main::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <main>
            </main>
            HTML,
            $instance->render()
        );
    }
}
