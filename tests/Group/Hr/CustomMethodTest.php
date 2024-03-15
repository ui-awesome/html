<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Hr;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Group\Hr, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        $instance = Hr::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <hr>
            HTML,
            $instance->render(),
        );
    }
}
