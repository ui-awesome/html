<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Textual\Span;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Interop\RenderInterface, Textual\Span};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <span></span>
            HTML,
            Span::widget()->prefix('value')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <span></span>
            HTML,
            Span::widget()->prefix('value')->prefixAttributes(['class' => 'value'])->prefixTag('div')->render()
        );
    }

    public function testPrefixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <span></span>
            HTML,
            Span::widget()->prefix('value')->prefixClass('value')->prefixTag('div')->render()
        );
    }

    public function testPrefixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            value
            </div>
            <span></span>
            HTML,
            Span::widget()->prefix('value')->prefixTag('div')->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <span></span>
            HTML,
            Span::widget()->prefix('value')->prefixTag(false)->render()
        );
    }

    public function testRender(): void
    {
        $instance = Span::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <span></span>
            HTML,
            $instance->render(),
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span></span>
            value
            HTML,
            Span::widget()->suffix('value')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span></span>
            <div class="value">
            value
            </div>
            HTML,
            Span::widget()->suffix('value')->suffixAttributes(['class' => 'value'])->suffixTag('div')->render()
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span></span>
            <div class="value">
            value
            </div>
            HTML,
            Span::widget()->suffix('value')->suffixClass('value')->suffixTag('div')->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span></span>
            <div>
            value
            </div>
            HTML,
            Span::widget()->suffix('value')->suffixTag('div')->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span></span>
            value
            HTML,
            Span::widget()->suffix('value')->suffixTag(false)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>value</span>
            </div>
            HTML,
            Span::widget()->content('value')->template('<div>\n{tag}\n</div>')->render()
        );
    }
}
