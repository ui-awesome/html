<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\Section;

use PHPForge\Support\Assert;
use UIAwesome\Html\Semantic\Section;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <section>value</section>
            HTML,
            Section::widget()->begin() . 'value' . Section::end()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <section>
            </section>
            HTML,
            Section::widget()->render(),
        );
    }
}
