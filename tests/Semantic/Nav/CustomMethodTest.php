<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\Nav;

use PHPForge\Support\Assert;
use UIAwesome\Html\Semantic\Nav;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>value</nav>
            HTML,
            Nav::widget()->begin() . 'value' . Nav::end()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            </nav>
            HTML,
            Nav::widget()->render(),
        );
    }
}
