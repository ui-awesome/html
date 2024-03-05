<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Div;

use PHPForge\Support\Assert;
use UIAwesome\Html\Group\Div;

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
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            </div>
            HTML,
            Div::widget()->render(),
        );
    }
}
