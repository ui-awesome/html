<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\P;

use PHPForge\Support\Assert;
use UIAwesome\Html\Group\P;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p class="value">
            </p>
            HTML,
            P::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p class="value">
            </p>
            HTML,
            P::widget()->class('value')->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p>
            value
            </p>
            HTML,
            P::widget()->content('value')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p data-value="value">
            </p>
            HTML,
            P::widget()->dataAttributes(['value' => 'value'])->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p id="value">
            </p>
            HTML,
            P::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p lang="value">
            </p>
            HTML,
            P::widget()->lang('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p style="value">
            </p>
            HTML,
            P::widget()->style('value')->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <p title="value">
            </p>
            HTML,
            P::widget()->title('value')->render()
        );
    }
}
