<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Ul;

use PHPForge\Support\Assert;
use UIAwesome\Html\Group\Ul;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="value">
            </ul>
            HTML,
            Ul::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="value">
            </ul>
            HTML,
            Ul::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul>
            value
            </ul>
            HTML,
            Ul::widget()->content('value')->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul id="value">
            </ul>
            HTML,
            Ul::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul lang="value">
            </ul>
            HTML,
            Ul::widget()->lang('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul style="value">
            </ul>
            HTML,
            Ul::widget()->style('value')->render(),
        );
    }

    public function testTabIndex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul tabindex="1">
            </ul>
            HTML,
            Ul::widget()->tabIndex(1)->render(),
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul title="value">
            </ul>
            HTML,
            Ul::widget()->title('value')->render(),
        );
    }
}
