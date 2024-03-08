<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Date;

use PHPForge\Support\Assert;
use UIAwesome\Html\{FormControl\Input\Date, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testFieldAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="formmodelname-property" name="FormModelName[property]" type="date">
            HTML,
            Date::widget()->fieldAttributes('FormModelName', 'property')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <input id="date-6582f2d099e8b" type="date">
            HTML,
            Date::widget()->id('date-6582f2d099e8b')->prefix('value')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <input id="date-6582f2d099e8b" type="date">
            HTML,
            Date::widget()
                ->id('date-6582f2d099e8b')
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
            <input id="date-6582f2d099e8b" type="date">
            HTML,
            Date::widget()->id('date-6582f2d099e8b')->prefix('value')->prefixClass('value')->prefixTag('div')->render()
        );
    }

    public function testPrefixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            value
            </article>
            <input id="date-6582f2d099e8b" type="date">
            HTML,
            Date::widget()->id('date-6582f2d099e8b')->prefix('value')->prefixTag('article')->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <input id="date-6582f2d099e8b" type="date">
            HTML,
            Date::widget()->id('date-6582f2d099e8b')->prefix('value')->prefixTag(false)->render()
        );
    }

    public function testRender(): void
    {
        $instance = Date::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="date-6582f2d099e8b" type="date">
            HTML,
            $instance->id('date-6582f2d099e8b')->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="date-6582f2d099e8b" type="date">
            value
            HTML,
            Date::widget()->id('date-6582f2d099e8b')->suffix('value')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="date-6582f2d099e8b" type="date">
            <div class="value">
            value
            </div>
            HTML,
            Date::widget()
                ->id('date-6582f2d099e8b')
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
            <input id="date-6582f2d099e8b" type="date">
            <div class="value">
            value
            </div>
            HTML,
            Date::widget()->id('date-6582f2d099e8b')->suffix('value')->suffixClass('value')->suffixTag('div')->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="date-6582f2d099e8b" type="date">
            <article>
            value
            </article>
            HTML,
            Date::widget()->id('date-6582f2d099e8b')->suffix('value')->suffixTag('article')->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="date-6582f2d099e8b" type="date">
            value
            HTML,
            Date::widget()->id('date-6582f2d099e8b')->suffix('value')->suffixTag(false)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="date-6582f2d099e8b" type="date">
            </div>
            HTML,
            Date::widget()->id('date-6582f2d099e8b')->template('<div>\n{tag}\n</div>')->render()
        );
    }
}
