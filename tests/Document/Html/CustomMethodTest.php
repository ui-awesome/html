<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Document\Html;

use PHPForge\Support\Assert;
use UIAwesome\Html\Document\Html;

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
        Assert::equalsWithoutLE(
            <<<HTML
            <html>
            </html>
            HTML,
            Html::widget()->render()
        );
    }
}
