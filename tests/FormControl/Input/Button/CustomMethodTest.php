<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Button;

use PHPForge\Support\Assert;
use UIAwesome\Html\{FormControl\Input\Button, Interop\RenderInterface};

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
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->containerAttributes(['class' => 'value'])->id('button-6582f2d099e8b')->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->containerClass('value')->id('button-6582f2d099e8b')->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->containerTag()->id('button-6582f2d099e8b')->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span><input id="button-6582f2d099e8b" type="button"></span>
            HTML,
            Button::widget()->containerTag('span')->id('button-6582f2d099e8b')->render()
        );
    }

    public function testContainerTagWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="button-6582f2d099e8b" type="button">
            HTML,
            Button::widget()->containerTag(false)->id('button-6582f2d099e8b')->render()
        );
    }

    public function testContainerTagWithDefinitionsDefaultValue(): void
    {
        $this->assertStringContainsString('<div>', Button::widget()->id('button-658716145f1d9')->render());
    }

    public function testContainerTagWithWithDefinitionsFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="button-6582f2d099e8b" type="button">
            HTML,
            Button::widget(['containerTag()' => [false]])->id('button-6582f2d099e8b')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            value
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->prefix('value')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            value
            </div>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()
                ->id('button-6582f2d099e8b')
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
            <div>
            <div class="value">
            value
            </div>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()
                ->id('button-6582f2d099e8b')
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
            <div>
            <span>value</span>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->prefix('value')->prefixTag('span')->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            value
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->prefix('value')->prefixTag(false)->render()
        );
    }

    public function testRender(): void
    {
        $instance = Button::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            $instance->id('button-6582f2d099e8b')->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="button-6582f2d099e8b" type="button">
            value
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->suffix('value')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="button-6582f2d099e8b" type="button">
            <div class="value">
            value
            </div>
            </div>
            HTML,
            Button::widget()
                ->id('button-6582f2d099e8b')
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
            <div>
            <input id="button-6582f2d099e8b" type="button">
            <div class="value">
            value
            </div>
            </div>
            HTML,
            Button::widget()
                ->id('button-6582f2d099e8b')
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
            <div>
            <input id="button-6582f2d099e8b" type="button">
            <span>value</span>
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->suffix('value')->suffixTag('span')->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="button-6582f2d099e8b" type="button">
            value
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->suffix('value')->suffixTag(false)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->template('<div>\n{tag}\n</div>')->render()
        );
    }
}
