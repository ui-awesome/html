<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\Nav;

use PHPForge\Support\Assert;
use UIAwesome\Html\Semantic\Nav;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="value">
            </nav>
            HTML,
            Nav::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="value">
            </nav>
            HTML,
            Nav::widget()->class('value')->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            value
            </nav>
            HTML,
            Nav::widget()->content('value')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav data-value="value">
            </nav>
            HTML,
            Nav::widget()->dataAttributes(['value' => 'value'])->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="value">
            </nav>
            HTML,
            Nav::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav lang="value">
            </nav>
            HTML,
            Nav::widget()->lang('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav style="value">
            </nav>
            HTML,
            Nav::widget()->style('value')->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav title="value">
            </nav>
            HTML,
            Nav::widget()->title('value')->render()
        );
    }
}
