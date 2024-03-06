<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\P;

use PHPForge\Support\Assert;
use UIAwesome\Html\Group\P;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p>value</p>
            HTML,
            P::widget()->begin() . 'value' . P::end()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p>
            </p>
            HTML,
            P::widget()->render(),
        );
    }
}
