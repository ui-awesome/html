<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\DatetimeLocal;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\DatetimeLocal;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAriaDescribedBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" aria-describedby="value">
            HTML,
            DatetimeLocal::widget()->ariaDescribedBy('value')->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" aria-label="value">
            HTML,
            DatetimeLocal::widget()->ariaLabel('value')->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="datetime-local-6582f2d099e8b" type="datetime-local">
            HTML,
            DatetimeLocal::widget()->attributes(['class' => 'value'])->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testAutofocus(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" autofocus>
            HTML,
            DatetimeLocal::widget()->autofocus()->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="datetime-local-6582f2d099e8b" type="datetime-local">
            HTML,
            DatetimeLocal::widget()->class('value')->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" data-value="value">
            HTML,
            DatetimeLocal::widget()->dataAttributes(['value' => 'value'])->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testDisabled(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" disabled>
            HTML,
            DatetimeLocal::widget()->disabled()->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testForm(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" form="value">
            HTML,
            DatetimeLocal::widget()->form('value')->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" aria-describedby="datetime-local-6582f2d099e8b-help">
            HTML,
            DatetimeLocal::widget()->ariaDescribedBy()->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeByWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local">
            HTML,
            DatetimeLocal::widget()->ariaDescribedBy(false)->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testGenerateId(): void
    {
        $this->assertStringContainsString('id="datetime-local-', DatetimeLocal::widget()->render());
    }

    public function testGetValue(): void
    {
        $this->assertSame('value', DatetimeLocal::widget()->value('value')->getValue());
    }

    public function testHidden(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" hidden>
            HTML,
            DatetimeLocal::widget()->hidden()->id('datetime-local-6582f2d099e8b')->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="value" type="datetime-local">
            HTML,
            DatetimeLocal::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" lang="value">
            HTML,
            DatetimeLocal::widget()->id('datetime-local-6582f2d099e8b')->lang('value')->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" name="value" type="datetime-local">
            HTML,
            DatetimeLocal::widget()->id('datetime-local-6582f2d099e8b')->name('value')->render()
        );
    }

    public function testReadonly(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" readonly>
            HTML,
            DatetimeLocal::widget()->id('datetime-local-6582f2d099e8b')->readonly()->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" style="value">
            HTML,
            DatetimeLocal::widget()->id('datetime-local-6582f2d099e8b')->style('value')->render()
        );
    }

    public function testTabIndex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" tabindex="1">
            HTML,
            DatetimeLocal::widget()->id('datetime-local-6582f2d099e8b')->tabIndex(1)->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" title="value">
            HTML,
            DatetimeLocal::widget()->id('datetime-local-6582f2d099e8b')->title('value')->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local" value="value">
            HTML,
            DatetimeLocal::widget()->id('datetime-local-6582f2d099e8b')->value('value')->render()
        );
    }

    public function testValueWithEmpty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="datetime-local-6582f2d099e8b" type="datetime-local">
            HTML,
            DatetimeLocal::widget()->id('datetime-local-6582f2d099e8b')->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input name="FormModelName[property]" type="datetime-local">
            HTML,
            DatetimeLocal::widget()->fieldAttributes('FormModelName', 'property')->id(null)->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="formmodelname-property" type="datetime-local">
            HTML,
            DatetimeLocal::widget()->fieldAttributes('FormModelName', 'property')->name(null)->render()
        );
    }
}
