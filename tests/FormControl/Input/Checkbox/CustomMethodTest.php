<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Checkbox;

use PHPForge\Support\Assert;
use UIAwesome\Html\{FormControl\Input\Checkbox, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            </div>
            HTML,
            Checkbox::widget()
                ->containerAttributes(['class' => 'value'])
                ->containerTag()
                ->id('checkbox-6582f2d099e8b')
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            </div>
            HTML,
            Checkbox::widget()->containerClass('value')->id('checkbox-6582f2d099e8b')->containerTag()->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            </div>
            HTML,
            Checkbox::widget()->containerTag()->id('checkbox-6582f2d099e8b')->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span><input id="checkbox-6582f2d099e8b" type="checkbox"></span>
            HTML,
            Checkbox::widget()->containerTag('span')->id('checkbox-6582f2d099e8b')->render()
        );
    }

    public function testContainerTagWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            HTML,
            Checkbox::widget()->containerTag(false)->id('checkbox-6582f2d099e8b')->render()
        );
    }

    public function testContainerTagWithFalseWithDefinitions(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            HTML,
            Checkbox::widget(['containerTag()' => [false]])->id('checkbox-6582f2d099e8b')->render()
        );
    }

    public function testFieldAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="formmodelname-property" name="FormModelName[property]" type="checkbox">
            HTML,
            Checkbox::widget()->fieldAttributes('FormModelName', 'property')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            HTML,
            Checkbox::widget()->id('checkbox-6582f2d099e8b')->prefix('value')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            HTML,
            Checkbox::widget()
                ->id('checkbox-6582f2d099e8b')
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
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            HTML,
            Checkbox::widget()
                ->id('checkbox-6582f2d099e8b')
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
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            HTML,
            Checkbox::widget()->id('checkbox-6582f2d099e8b')->prefix('value')->prefixTag('span')->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            HTML,
            Checkbox::widget()->id('checkbox-6582f2d099e8b')->prefix('value')->prefixTag(false)->render()
        );
    }

    public function testRender(): void
    {
        $instance = Checkbox::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            HTML,
            $instance->id('checkbox-6582f2d099e8b')->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            value
            HTML,
            Checkbox::widget()->id('checkbox-6582f2d099e8b')->suffix('value')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            <div class="value">
            value
            </div>
            HTML,
            Checkbox::widget()
                ->id('checkbox-6582f2d099e8b')
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
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            <div class="value">
            value
            </div>
            HTML,
            Checkbox::widget()
                ->id('checkbox-6582f2d099e8b')
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
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            <span>value</span>
            HTML,
            Checkbox::widget()->id('checkbox-6582f2d099e8b')->suffix('value')->suffixTag('span')->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            value
            HTML,
            Checkbox::widget()->id('checkbox-6582f2d099e8b')->suffix('value')->suffixTag(false)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkbox-6582f2d099e8b" type="checkbox">
            </div>
            HTML,
            Checkbox::widget()->id('checkbox-6582f2d099e8b')->template('<div>\n{tag}\n</div>')->render()
        );
    }

    public function testUncheckedAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" name="value" type="hidden" value="0">
            <input id="checkbox-6582f2d099e8b" name="value" type="checkbox" value="1">
            HTML,
            Checkbox::widget()
                ->id('checkbox-6582f2d099e8b')
                ->name('value')
                ->uncheckedAttributes(['class' => 'value'])
                ->uncheckedValue('0')
                ->value(1)
                ->render()
        );
    }

    public function testUncheckedClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" name="value" type="hidden" value="0">
            <input id="checkbox-6582f2d099e8b" name="value" type="checkbox" value="1">
            HTML,
            Checkbox::widget()
                ->id('checkbox-6582f2d099e8b')
                ->name('value')
                ->uncheckedClass('value')
                ->uncheckedValue('0')
                ->value(1)
                ->render()
        );
    }

    public function testUncheckedValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input name="value" type="hidden" value="0">
            <input id="checkbox-6582f2d099e8b" name="value" type="checkbox" value="1">
            HTML,
            Checkbox::widget()->id('checkbox-6582f2d099e8b')->name('value')->uncheckedValue('0')->value(1)->render()
        );
    }
}
