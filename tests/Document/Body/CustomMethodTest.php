<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Document\Body;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Document\Body, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <body>value</body>
            HTML,
            Body::widget()->begin() . 'value' . Body::end()
        );
    }

    public function testRender(): void
    {
        $instance = Body::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <body>
            </body>
            HTML,
            $instance->render()
        );
    }
}
