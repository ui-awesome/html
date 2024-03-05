<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Radio;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Radio;

final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="radio-6582f2d099e8b" type="radio">
            </div>
            HTML,
            Radio::widget()
                ->containerAttributes(['class' => 'value'])
                ->containerTag()
                ->id('radio-6582f2d099e8b')
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="radio-6582f2d099e8b" type="radio">
            </div>
            HTML,
            Radio::widget()->containerClass('value')->containerTag()->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="radio-6582f2d099e8b" type="radio">
            </div>
            HTML,
            Radio::widget()->containerTag()->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span><input id="radio-6582f2d099e8b" type="radio"></span>
            HTML,
            Radio::widget()->containerTag('span')->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testContainerTagWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()->containerTag(false)->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testContainerTagWithFalseWithDefinitions(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget(['containerTag()' => [false]])->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testFieldAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="formmodelname-property" name="FormModelName[property]" type="radio">
            HTML,
            Radio::widget()->fieldAttributes('FormModelName', 'property')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->prefix('value')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()
                ->id('radio-6582f2d099e8b')
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
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()
                ->id('radio-6582f2d099e8b')
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
            <span>value</span>
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->prefix('value')->prefixTag('span')->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->prefix('value')->prefixTag(false)->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio">
            value
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->suffix('value')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio">
            <div class="value">
            value
            </div>
            HTML,
            Radio::widget()
                ->id('radio-6582f2d099e8b')
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
            <input id="radio-6582f2d099e8b" type="radio">
            <div class="value">
            value
            </div>
            HTML,
            Radio::widget()
                ->id('radio-6582f2d099e8b')
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
            <input id="radio-6582f2d099e8b" type="radio">
            <span>value</span>
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->suffix('value')->suffixTag('span')->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio">
            value
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->suffix('value')->suffixTag(false)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="radio-6582f2d099e8b" type="radio">
            </div>
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->template('<div>\n{tag}\n</div>')->render()
        );
    }

    public function testUncheckedAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" name="name" type="hidden" value="0">
            <input id="radio-6582f2d099e8b" name="name" type="radio">
            HTML,
            Radio::widget()
                ->id('radio-6582f2d099e8b')
                ->name('name')
                ->uncheckedAttributes(['class' => 'value'])
                ->uncheckedValue('0')
                ->render()
        );
    }

    public function testUncheckedClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" name="name" type="hidden" value="0">
            <input id="radio-6582f2d099e8b" name="name" type="radio">
            HTML,
            Radio::widget()
                ->id('radio-6582f2d099e8b')
                ->name('name')
                ->uncheckedClass('value')
                ->uncheckedValue('0')
                ->render()
        );
    }

    public function testUncheckedValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input name="name" type="hidden" value="0">
            <input id="radio-6582f2d099e8b" name="name" type="radio" value="1">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->name('name')->uncheckedValue('0')->value(1)->render()
        );
    }
}
