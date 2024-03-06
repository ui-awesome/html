<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Li;

use PHPForge\Support\Assert;
use UIAwesome\Html\Group\Li;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li class="value">
            </li>
            HTML,
            Li::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li class="value">
            </li>
            HTML,
            Li::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            value
            </li>
            HTML,
            Li::widget()->content('value')->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li id="value">
            </li>
            HTML,
            Li::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li lang="value">
            </li>
            HTML,
            Li::widget()->lang('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li style="value">
            </li>
            HTML,
            Li::widget()->style('value')->render()
        );
    }

    public function testTabIndex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li tabindex="1">
            </li>
            HTML,
            Li::widget()->tabIndex(1)->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li title="value">
            </li>
            HTML,
            Li::widget()->title('value')->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li value="value">
            </li>
            HTML,
            Li::widget()->value('value')->render()
        );
    }
}
