<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Flow;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Flow\Pre;

/**
 * Unit tests for {@see Pre} rendering and global attribute behavior.
 */
#[Group('flow')]
final class PreTest extends TestCase
{
    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <pre>
            <value>
            </pre>
            HTML,
            Pre::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <pre>
              first

                second
            </pre>
            HTML,
            Pre::tag()->begin() . "  first\n\n    second" . Pre::end(),
            'Indentation and blank lines must survive begin/end verbatim.',
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <pre>
            value
            </pre>
            HTML,
            Pre::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <pre class="default-class">
            </pre>
            HTML,
            Pre::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <pre>
            </pre>
            HTML,
            Pre::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <pre>
            </pre>
            HTML,
            (string) Pre::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
