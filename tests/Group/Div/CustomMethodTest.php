<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Div;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Group\Div, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>value</div>
            HTML,
            Div::widget()->begin() . 'value' . Div::end()
        );
    }

    public function testRender(): void
    {
        $instance = Div::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            </div>
            HTML,
            $instance->render(),
        );
    }
}
