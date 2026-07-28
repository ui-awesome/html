<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Root;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Root\Html;

/**
 * Unit tests for {@see Html} rendering and template attribute behavior.
 */
#[Group('root')]
final class HtmlTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <html>
            &lt;value&gt;
            </html>
            HTML,
            Html::tag()->content('<value>')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <html class="default-class">
            </html>
            HTML,
            Html::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <html>
            </html>
            HTML,
            (string) Html::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
