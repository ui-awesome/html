<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\Footer;

use PHPForge\Support\Assert;
use UIAwesome\Html\Semantic\Footer;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer>value</footer>
            HTML,
            Footer::widget()->begin() . 'value' . Footer::end()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer>
            </footer>
            HTML,
            Footer::widget()->render()
        );
    }
}
