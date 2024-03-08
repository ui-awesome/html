<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Textual\I;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Interop\RenderInterface, Textual\I};

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
            <i></i>
            HTML,
            I::widget()->prefix('value')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <i></i>
            HTML,
            I::widget()->prefix('value')->prefixAttributes(['class' => 'value'])->prefixTag('div')->render()
        );
    }

    public function testPrefixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <i></i>
            HTML,
            I::widget()->prefix('value')->prefixClass('value')->prefixTag('div')->render()
        );
    }

    public function testPrefixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span>value</span>
            <i></i>
            HTML,
            I::widget()->prefix('value')->prefixTag('span')->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <i></i>
            HTML,
            I::widget()->prefix('value')->prefixTag(false)->render()
        );
    }

    public function testRender(): void
    {
        $instance = I::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <i></i>
            HTML,
            $instance->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i></i>
            value
            HTML,
            I::widget()->suffix('value')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i></i>
            <div class="value">
            value
            </div>
            HTML,
            I::widget()->suffix('value')->suffixAttributes(['class' => 'value'])->suffixTag('div')->render()
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i></i>
            <div class="value">
            value
            </div>
            HTML,
            I::widget()->suffix('value')->suffixClass('value')->suffixTag('div')->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i></i>
            <span>value</span>
            HTML,
            I::widget()->suffix('value')->suffixTag('span')->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <i></i>
            value
            HTML,
            I::widget()->suffix('value')->suffixTag(false)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <i>value</i>
            </div>
            HTML,
            I::widget()->content('value')->template('<div>\n{tag}\n</div>')->render()
        );
    }
}
