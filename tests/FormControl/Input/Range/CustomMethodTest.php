<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Range;

use PHPForge\Support\Assert;
use UIAwesome\Html\{FormControl\Input\Range, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testFieldAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="formmodelname-property" name="FormModelName[property]" type="range">
            HTML,
            Range::widget()->fieldAttributes('FormModelName', 'property')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <input id="range-6582f2d099e8b" type="range">
            HTML,
            Range::widget()->id('range-6582f2d099e8b')->prefix('value')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <input id="range-6582f2d099e8b" type="range">
            HTML,
            Range::widget()
                ->id('range-6582f2d099e8b')
                ->prefix('value')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag('div')
                ->render()
        );
    }

    public function testPrefixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <input id="range-6582f2d099e8b" type="range">
            HTML,
            Range::widget()
                ->id('range-6582f2d099e8b')
                ->prefix('value')
                ->prefixClass('value')
                ->prefixTag('div')
                ->render()
        );
    }

    public function testPrefixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            value
            </article>
            <input id="range-6582f2d099e8b" type="range">
            HTML,
            Range::widget()->id('range-6582f2d099e8b')->prefix('value')->prefixTag('article')->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <input id="range-6582f2d099e8b" type="range">
            HTML,
            Range::widget()->id('range-6582f2d099e8b')->prefix('value')->prefixTag(false)->render()
        );
    }

    public function testRender(): void
    {
        $instance = Range::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="range-6582f2d099e8b" type="range">
            HTML,
            $instance->id('range-6582f2d099e8b')->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="range-6582f2d099e8b" type="range">
            value
            HTML,
            Range::widget()->id('range-6582f2d099e8b')->suffix('value')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="range-6582f2d099e8b" type="range">
            <div class="value">
            value
            </div>
            HTML,
            Range::widget()
                ->id('range-6582f2d099e8b')
                ->suffix('value')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag('div')
                ->render()
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="range-6582f2d099e8b" type="range">
            <div class="value">
            value
            </div>
            HTML,
            Range::widget()
                ->id('range-6582f2d099e8b')
                ->suffix('value')
                ->suffixClass('value')
                ->suffixTag('div')
                ->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="range-6582f2d099e8b" type="range">
            <article>
            value
            </article>
            HTML,
            Range::widget()->id('range-6582f2d099e8b')->suffix('value')->suffixTag('article')->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="range-6582f2d099e8b" type="range">
            value
            HTML,
            Range::widget()->id('range-6582f2d099e8b')->suffix('value')->suffixTag(false)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="range-6582f2d099e8b" type="range">
            </div>
            HTML,
            Range::widget()->id('range-6582f2d099e8b')->template('<div>\n{tag}\n</div>')->render()
        );
    }
}
