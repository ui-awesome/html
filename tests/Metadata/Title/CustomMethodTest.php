<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata\Title;

use PHPForge\Support\Assert;
use UIAwesome\Html\Metadata\Title;

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
        Assert::equalsWithoutLE(
            <<<HTML
            <title>
            </title>
            HTML,
            Title::widget()->render(),
        );
    }
}
