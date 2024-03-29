<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Text;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Text;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAriaDescribedBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" aria-describedby="value">
            HTML,
            Text::widget()->ariaDescribedBy('value')->id('text-6582f2d099e8b')->render()
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" aria-label="value">
            HTML,
            Text::widget()->ariaLabel('value')->id('text-6582f2d099e8b')->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="text-6582f2d099e8b" type="text">
            HTML,
            Text::widget()->attributes([
                'class' => 'value',
            ])->id('text-6582f2d099e8b')->render()
        );
    }

    public function testAutocomplete(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" autocomplete="on">
            HTML,
            Text::widget()->autocomplete('on')->id('text-6582f2d099e8b')->render()
        );
    }

    public function testAutofocus(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" autofocus>
            HTML,
            Text::widget()->autofocus()->id('text-6582f2d099e8b')->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input class="value" id="text-6582f2d099e8b" type="text">
            HTML,
            Text::widget()->class('value')->id('text-6582f2d099e8b')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" data-value="value">
            HTML,
            Text::widget()->dataAttributes([
                'value' => 'value',
            ])->id('text-6582f2d099e8b')->render()
        );
    }

    public function testDirname(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" dirname="value">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->dirname('value')->render()
        );
    }

    public function testDisabled(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" disabled>
            HTML,
            Text::widget()->disabled()->id('text-6582f2d099e8b')->render()
        );
    }

    public function testForm(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" form="value">
            HTML,
            Text::widget()->form('value')->id('text-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" aria-describedby="text-6582f2d099e8b-help">
            HTML,
            Text::widget()->ariaDescribedBy()->id('text-6582f2d099e8b')->render()
        );
    }

    public function testGenerateAriaDescribeByWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text">
            HTML,
            Text::widget()->ariaDescribedBy(false)->id('text-6582f2d099e8b')->render()
        );
    }

    public function testGenerateId(): void
    {
        $this->assertStringContainsString('id="text-', Text::widget()->render());
    }

    public function testGetValue(): void
    {
        $this->assertSame('value', Text::widget()->value('value')->getValue());
    }

    public function testHidden(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" hidden>
            HTML,
            Text::widget()->hidden()->id('text-6582f2d099e8b')->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="value" type="text">
            HTML,
            Text::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" lang="value">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->lang('value')->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" name="value" type="text">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->name('value')->render()
        );
    }

    public function testPlaceholder(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" placeholder="value">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->placeholder('value')->render()
        );
    }

    public function testReadonly(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" readonly>
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->readonly()->render()
        );
    }

    public function testSize(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" size="1">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->size(1)->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" style="value">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->style('value')->render()
        );
    }

    public function testTabIndex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" tabindex="1">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->tabIndex(1)->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" title="value">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->title('value')->render()
        );
    }

    public function testValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text" value="value">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->value('value')->render()
        );
    }

    public function testValueWithEmpty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="text-6582f2d099e8b" type="text">
            HTML,
            Text::widget()->id('text-6582f2d099e8b')->value(null)->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input name="FormModelName[property]" type="text">
            HTML,
            Text::widget()->fieldAttributes('FormModelName', 'property')->id(null)->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="formmodelname-property" type="text">
            HTML,
            Text::widget()->fieldAttributes('FormModelName', 'property')->name(null)->render()
        );
    }
}
