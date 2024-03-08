<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata\Meta;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Interop\RenderInterface, Metadata\Meta};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        $instance = Meta::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <meta>
            HTML,
            $instance->render()
        );
    }
}
