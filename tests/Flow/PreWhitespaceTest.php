<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Flow;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Flow\{Div, Pre};
use UIAwesome\Html\Tests\Provider\Flow\PreWhitespaceProvider;

/**
 * Unit tests for whitespace preservation in {@see Pre}.
 *
 * {@see PreWhitespaceProvider} for test case data providers.
 */
#[Group('flow')]
final class PreWhitespaceTest extends TestCase
{
    public function testRenderInsideTwoBlocksPreservesContent(): void
    {
        $pre = Pre::tag()->content("\n  first\n\n    second\n");

        self::assertSame(
            <<<HTML
            <div>
            <div>
            <pre>

              first

                second
            </pre>
            </div>
            </div>
            HTML,
            Div::tag()->html(Div::tag()->html($pre))->render(),
            'Enclosing blocks must preserve preformatted whitespace.',
        );
    }

    #[DataProviderExternal(PreWhitespaceProvider::class, 'content')]
    public function testRenderWithContentPreservesWhitespace(string $content, string $expected): void
    {
        self::assertSame(
            $expected,
            Pre::tag()
                ->content($content)
                ->render(),
            'Preformatted content must retain its whitespace and remain encoded.',
        );
    }
}
