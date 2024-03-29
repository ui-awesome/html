<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Radio;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Radio;

final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAriaDescribedBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" aria-describedby="value">
            HTML,
            Radio::widget()->ariaDescribedBy('value')->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" aria-label="value">
            HTML,
            Radio::widget()->ariaLabel('value')->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()->attributes(['class' => 'value', 'id' => 'radio-6582f2d099e8b'])->render()
        );
    }

    public function testAutofocus(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" autofocus>
            HTML,
            Radio::widget()->autofocus()->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testChecked(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="1" checked>
            HTML,
            Radio::widget()->checked(1)->id('radio-6582f2d099e8b')->value(1)->render()
        );
    }

    public function testCheckedWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="1">
            HTML,
            Radio::widget()->checked(false)->id('radio-6582f2d099e8b')->value(1)->render()
        );
    }

    public function testCheckedWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="1">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->checked(null)->value(1)->render()
        );
    }

    public function testCheckedWithTrue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" checked>
            HTML,
            Radio::widget()->checked(true)->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()->class('value')->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" data-value="value">
            HTML,
            Radio::widget()->dataAttributes(['value' => 'value'])->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testDisabled(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" disabled>
            HTML,
            Radio::widget()->disabled()->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testForm(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" form="value">
            HTML,
            Radio::widget()->form('value')->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" aria-describedby="radio-6582f2d099e8b-help">
            HTML,
            Radio::widget()->ariaDescribedBy()->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeByWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()->ariaDescribedBy(false)->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testGenerateId(): void
    {
        $this->assertStringContainsString('id="radio-', Radio::widget()->render());
    }

    public function testGetValue(): void
    {
        $this->assertSame('value', Radio::widget()->value('value')->getValue());
    }

    public function testHidden(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" hidden>
            HTML,
            Radio::widget()->hidden()->id('radio-6582f2d099e8b')->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="value" type="radio">
            HTML,
            Radio::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" lang="en">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->lang('en')->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" name="value" type="radio">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->name('value')->render()
        );
    }

    public function testReadonly(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" readonly>
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->readonly()->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" style="value">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->style('value')->render()
        );
    }

    public function testTabIndex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" tabindex="1">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->tabIndex(1)->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" title="value">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->title('value')->render()
        );
    }

    public function testValue(): void
    {
        // Value bool `false`.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="0">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->value(false)->render()
        );

        // Value bool `true`.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="1" checked>
            HTML,
            Radio::widget()->checked(true)->id('radio-6582f2d099e8b')->value(true)->render()
        );

        // Value int `0`.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="0">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->value(0)->render()
        );

        // Value int `1`.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="1" checked>
            HTML,
            Radio::widget()->checked(1)->id('radio-6582f2d099e8b')->value(1)->render()
        );

        // Value string `inactive`.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="inactive">
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->value('inactive')->render()
        );

        // Value string `active`.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="inactive" checked>
            HTML,
            Radio::widget()->checked('inactive')->id('radio-6582f2d099e8b')->value('inactive')->render()
        );
    }

    public function testValueWithDiferentTypes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" value="1" checked>
            HTML,
            Radio::widget()->checked(1)->id('radio-6582f2d099e8b')->value('1')->render()
        );
    }

    public function testValueWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio">
            HTML,
            Radio::widget()->checked(null)->id('radio-6582f2d099e8b')->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input name="FormModelName[property]" type="radio">
            HTML,
            Radio::widget()->fieldAttributes('FormModelName', 'property')->id(null)->render()
        );
    }

    public function testWihoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="formmodelname-property" type="radio">
            HTML,
            Radio::widget()->fieldAttributes('FormModelName', 'property')->name(null)->render()
        );
    }
}
