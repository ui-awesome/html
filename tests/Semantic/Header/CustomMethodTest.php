<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\Header;

use PHPForge\Support\Assert;
use UIAwesome\Html\Semantic\Header;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <header>value</header>
            HTML,
            Header::widget()->begin() . 'value' . Header::end()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <header>
            </header>
            HTML,
            Header::widget()->render()
        );
    }
}
