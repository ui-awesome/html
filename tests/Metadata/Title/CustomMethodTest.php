<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata\Title;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Interop\RenderInterface, Metadata\Title};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <title>value</title>
            HTML,
            Title::widget()->begin() . 'value' . Title::end()
        );
    }

    public function testRender(): void
    {
        $instance = Title::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <title>
            </title>
            HTML,
            $instance->render(),
        );
    }
}
