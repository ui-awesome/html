<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\H;

use PHPForge\Support\Assert;
use UIAwesome\Html\Semantic\H;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h1 class="value">
            </h1>
            HTML,
            H::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h1 class="value">
            </h1>
            HTML,
            H::widget()->class('value')->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h1>
            value
            </h1>
            HTML,
            H::widget()->content('value')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h1 data-value="value">
            </h1>
            HTML,
            H::widget()->dataAttributes(['value' => 'value'])->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h1 id="value">
            </h1>
            HTML,
            H::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h1 lang="value">
            </h1>
            HTML,
            H::widget()->lang('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h1 style="value">
            </h1>
            HTML,
            H::widget()->style('value')->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <h1 title="value">
            </h1>
            HTML,
            H::widget()->title('value')->render()
        );
    }
}
