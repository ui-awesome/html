<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Main;

use PHPForge\Support\Assert;
use UIAwesome\Html\Group\Main;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main class="value">
            </main>
            HTML,
            Main::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main class="value">
            </main>
            HTML,
            Main::widget()->class('value')->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main>
            value
            </main>
            HTML,
            Main::widget()->content('value')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main data-value="value">
            </main>
            HTML,
            Main::widget()->dataAttributes(['value' => 'value'])->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main id="value">
            </main>
            HTML,
            Main::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main lang="value">
            </main>
            HTML,
            Main::widget()->lang('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main style="value">
            </main>
            HTML,
            Main::widget()->style('value')->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <main title="value">
            </main>
            HTML,
            Main::widget()->title('value')->render()
        );
    }
}
