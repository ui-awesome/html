<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Tel;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Tel;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAriaDescribedBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" aria-describedby="value">
            HTML,
            Tel::widget()->ariaDescribedBy('value')->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" aria-label="value">
            HTML,
            Tel::widget()->ariaLabel('value')->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="tel-6582f2d099e8b" type="tel">
            HTML,
            Tel::widget()->attributes([
                'class' => 'value',
            ])->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testAutocomplete(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" autocomplete="on">
            HTML,
            Tel::widget()->autocomplete('on')->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testAutofocus(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" autofocus>
            HTML,
            Tel::widget()->autofocus()->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="tel-6582f2d099e8b" type="tel">
            HTML,
            Tel::widget()->class('value')->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" data-value="value">
            HTML,
            Tel::widget()->dataAttributes([
                'value' => 'value',
            ])->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testDirname(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" dirname="value">
            HTML,
            Tel::widget()->dirname('value')->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testDisabled(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" disabled>
            HTML,
            Tel::widget()->disabled()->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testForm(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" form="value">
            HTML,
            Tel::widget()->form('value')->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" aria-describedby="tel-6582f2d099e8b-help">
            HTML,
            Tel::widget()->ariaDescribedBy()->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeByWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel">
            HTML,
            Tel::widget()->ariaDescribedBy(false)->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testGenerateId(): void
    {
        $this->assertStringContainsString('id="tel-', Tel::widget()->render());
    }

    public function testGetValue(): void
    {
        $this->assertSame('value', Tel::widget()->value('value')->getValue());
    }

    public function testHidden(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" hidden>
            HTML,
            Tel::widget()->hidden()->id('tel-6582f2d099e8b')->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="value" type="tel">
            HTML,
            Tel::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" lang="value">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->lang('value')->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" name="value" type="tel">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->name('value')->render()
        );
    }

    public function testPlaceholder(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" placeholder="value">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->placeholder('value')->render()
        );
    }

    public function testReadonly(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" readonly>
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->readonly()->render()
        );
    }

    public function testSize(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" size="1">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->size(1)->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" style="value">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->style('value')->render()
        );
    }

    public function testTabIndex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" tabindex="1">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->tabIndex(1)->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" title="value">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->title('value')->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" value="123456789">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->value('123456789')->render()
        );
    }

    public function testValueWithEmpty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input name="FormModelName[property]" type="tel">
            HTML,
            Tel::widget()->fieldAttributes('FormModelName', 'property')->id(null)->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="formmodelname-property" type="tel">
            HTML,
            Tel::widget()->fieldAttributes('FormModelName', 'property')->name(null)->render()
        );
    }
}
