<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Textual\I;

use PHPForge\Support\Assert;
use UIAwesome\Html\Textual\I;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i class="value"></i>
            HTML,
            I::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i class="value"></i>
            HTML,
            I::widget()->class('value')->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i>value</i>
            HTML,
            I::widget()->content('value')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i data-value="value"></i>
            HTML,
            I::widget()->dataAttributes(['value' => 'value'])->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i id="value"></i>
            HTML,
            I::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i lang="value"></i>
            HTML,
            I::widget()->lang('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i style="value"></i>
            HTML,
            I::widget()->style('value')->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i title="value"></i>
            HTML,
            I::widget()->title('value')->render()
        );
    }
}
