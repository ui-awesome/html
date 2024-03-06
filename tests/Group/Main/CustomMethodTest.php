<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Main;

use PHPForge\Support\Assert;
use UIAwesome\Html\Group\Main;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main>value</main>
            HTML,
            Main::widget()->begin() . 'value' . Main::end()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main>
            </main>
            HTML,
            Main::widget()->render()
        );
    }
}
