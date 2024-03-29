<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Textual\A;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Interop\RenderInterface, Textual\A};

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
            <a></a>
            HTML,
            A::widget()->prefix('value')->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <a></a>
            HTML,
            A::widget()->prefix('value')->prefixAttributes(['class' => 'value'])->prefixTag('div')->render()
        );
    }

    public function testPrefixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            value
            </div>
            <a></a>
            HTML,
            A::widget()->prefix('value')->prefixClass('value')->prefixTag('div')->render()
        );
    }

    public function testPrefixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span>value</span>
            <a></a>
            HTML,
            A::widget()->prefix('value')->prefixTag('span')->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            value
            <a></a>
            HTML,
            A::widget()->prefix('value')->prefixTag(false)->render()
        );
    }

    public function testRender(): void
    {
        $instance = A::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <a></a>
            HTML,
            $instance->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a></a>
            value
            HTML,
            A::widget()->suffix('value')->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a></a>
            <div class="value">
            value
            </div>
            HTML,
            A::widget()->suffix('value')->suffixAttributes(['class' => 'value'])->suffixTag('div')->render()
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a></a>
            <div class="value">
            value
            </div>
            HTML,
            A::widget()->suffix('value')->suffixClass('value')->suffixTag('div')->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a></a>
            <span>value</span>
            HTML,
            A::widget()->suffix('value')->suffixTag('span')->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a></a>
            value
            HTML,
            A::widget()->suffix('value')->suffixTag(false)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <a>value</a>
            </div>
            HTML,
            A::widget()->content('value')->template('<div>\n{tag}\n</div>')->render()
        );
    }
}
