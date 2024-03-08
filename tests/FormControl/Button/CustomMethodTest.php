<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Button;

use PHPForge\Support\Assert;
use UIAwesome\Html\{FormControl\Button, Interop\RenderInterface};

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
            <button id="button-658716145f1d9" type="button"></button>
            </div>
            HTML,
            Button::widget()
                ->containerAttributes(['class' => 'value'])
                ->containerTag()
                ->id('button-658716145f1d9')
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <button id="button-658716145f1d9" type="button"></button>
            </div>
            HTML,
            Button::widget()->containerClass('value')->containerTag()->id('button-658716145f1d9')->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <button id="button-658716145f1d9" type="button"></button>
            </div>
            HTML,
            Button::widget()->containerTag()->id('button-658716145f1d9')->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span><button id="button-658716145f1d9" type="button"></button></span>
            HTML,
            Button::widget()->containerTag('span')->id('button-658716145f1d9')->render()
        );
    }

    public function testContainerTagWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button id="button-658716145f1d9" type="button"></button>
            HTML,
            Button::widget()->containerTag(false)->id('button-658716145f1d9')->render()
        );
    }

    public function testContainerTagWithFalseWithDefinitions(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button id="button-658716145f1d9" type="button"></button>
            HTML,
            Button::widget(['containerTag()' => [false]])->id('button-658716145f1d9')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <button id="button-658716145f1d9" type="button"></button>
            HTML,
            Button::widget()->id('button-658716145f1d9')->prefix('value')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <button id="button-658716145f1d9" type="button"></button>
            HTML,
            Button::widget()
                ->id('button-658716145f1d9')
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
            <button id="button-658716145f1d9" type="button"></button>
            HTML,
            Button::widget()
                ->id('button-658716145f1d9')
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
            <button id="button-658716145f1d9" type="button"></button>
            HTML,
            Button::widget()->id('button-658716145f1d9')->prefix('value')->prefixTag('span')->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <button id="button-658716145f1d9" type="button"></button>
            HTML,
            Button::widget()->id('button-658716145f1d9')->prefix('value')->prefixTag(false)->render()
        );
    }

    public function testRender(): void
    {
        $instance = Button::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <button id="button-658716145f1d9" type="button"></button>
            HTML,
            $instance->id('button-658716145f1d9')->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button id="button-658716145f1d9" type="button"></button>
            value
            HTML,
            Button::widget()->id('button-658716145f1d9')->suffix('value')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button id="button-658716145f1d9" type="button"></button>
            <div class="value">
            value
            </div>
            HTML,
            Button::widget()
                ->id('button-658716145f1d9')
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
            <button id="button-658716145f1d9" type="button"></button>
            <div class="value">
            value
            </div>
            HTML,
            Button::widget()
                ->id('button-658716145f1d9')
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
            <button id="button-658716145f1d9" type="button"></button>
            <span>value</span>
            HTML,
            Button::widget()->id('button-658716145f1d9')->suffix('value')->suffixTag('span')->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button id="button-658716145f1d9" type="button"></button>
            value
            HTML,
            Button::widget()->id('button-658716145f1d9')->suffix('value')->suffixTag(false)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <button id="button-658716145f1d9" type="button"></button>
            </div>
            HTML,
            Button::widget()->id('button-658716145f1d9')->template('<div>\n{tag}\n</div>')->render()
        );
    }
}
