<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Document\Html;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Document\Html, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <html>value</html>
            HTML,
            Html::widget()->begin() . 'value' . Html::end()
        );
    }

    public function testRender(): void
    {
        $instance = Html::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <html>
            </html>
            HTML,
            $instance->render()
        );
    }
}
