<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Datetime;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Datetime;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAriaDescribedBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" aria-describedby="value">
            HTML,
            Datetime::widget()->ariaDescribedBy('value')->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" aria-label="value">
            HTML,
            Datetime::widget()->ariaLabel('value')->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="datetime-6582f2d099e8b" type="datetime">
            HTML,
            Datetime::widget()->attributes(['class' => 'value'])->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testAutofocus(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" autofocus>
            HTML,
            Datetime::widget()->autofocus()->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="datetime-6582f2d099e8b" type="datetime">
            HTML,
            Datetime::widget()->class('value')->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" data-value="value">
            HTML,
            Datetime::widget()->dataAttributes(['value' => 'value'])->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testDisabled(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" disabled>
            HTML,
            Datetime::widget()->disabled()->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testForm(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" form="value">
            HTML,
            Datetime::widget()->form('value')->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" aria-describedby="datetime-6582f2d099e8b-help">
            HTML,
            Datetime::widget()->ariaDescribedBy()->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeByWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime">
            HTML,
            Datetime::widget()->ariaDescribedBy(false)->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testGenerateId(): void
    {
        $this->assertStringContainsString('id="datetime-', Datetime::widget()->render());
    }

    public function testGetValue(): void
    {
        $this->assertSame('value', Datetime::widget()->value('value')->getValue());
    }

    public function testHidden(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" hidden>
            HTML,
            Datetime::widget()->hidden()->id('datetime-6582f2d099e8b')->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="value" type="datetime">
            HTML,
            Datetime::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" lang="value">
            HTML,
            Datetime::widget()->id('datetime-6582f2d099e8b')->lang('value')->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" name="value" type="datetime">
            HTML,
            Datetime::widget()->id('datetime-6582f2d099e8b')->name('value')->render()
        );
    }

    public function testReadonly(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" readonly>
            HTML,
            Datetime::widget()->id('datetime-6582f2d099e8b')->readonly()->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" style="value">
            HTML,
            Datetime::widget()->id('datetime-6582f2d099e8b')->style('value')->render()
        );
    }

    public function testTabIndex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" tabindex="1">
            HTML,
            Datetime::widget()->id('datetime-6582f2d099e8b')->tabIndex(1)->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" title="value">
            HTML,
            Datetime::widget()->id('datetime-6582f2d099e8b')->title('value')->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime" value="value">
            HTML,
            Datetime::widget()->id('datetime-6582f2d099e8b')->value('value')->render()
        );
    }

    public function testValueWithEmpty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-6582f2d099e8b" type="datetime">
            HTML,
            Datetime::widget()->id('datetime-6582f2d099e8b')->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input name="FormModelName[property]" type="datetime">
            HTML,
            Datetime::widget()->fieldAttributes('FormModelName', 'property')->id(null)->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="formmodelname-property" type="datetime">
            HTML,
            Datetime::widget()->fieldAttributes('FormModelName', 'property')->name(null)->render()
        );
    }
}
