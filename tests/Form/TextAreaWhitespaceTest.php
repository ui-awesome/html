<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Flow\Div;
use UIAwesome\Html\Form\TextArea;
use UIAwesome\Html\Tests\Provider\Form\TextAreaWhitespaceProvider;

/**
 * Unit tests for whitespace preservation in {@see TextArea}.
 *
 * {@see TextAreaWhitespaceProvider} for test case data providers.
 */
#[Group('form')]
final class TextAreaWhitespaceTest extends TestCase
{
    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <textarea>A &amp; B</textarea>
            HTML,
            TextArea::tag()->html('A &amp; B')->render(),
            'Raw HTML content must not be encoded again.',
        );
    }

    public function testRenderInsideTwoBlocksPreservesContent(): void
    {
        $textarea = TextArea::tag()->name('comment')->content("\nfirst\n\nsecond\n");

        self::assertSame(
            <<<HTML
            <div>
            <div>
            <textarea name="comment">

            first

            second
            </textarea>
            </div>
            </div>
            HTML,
            Div::tag()->html(Div::tag()->html($textarea))->render(),
            'Enclosing blocks must preserve the protective LF and textarea content.',
        );
    }

    #[TestWith(['', '<textarea></textarea>'], 'empty')]
    #[TestWith(['value', '<textarea>value</textarea>'], 'plain')]
    #[TestWith(["first\n\nsecond\n", "<textarea>first\n\nsecond\n</textarea>"], 'blank line and trailing LF')]
    public function testRenderWithBeginEnd(string $content, string $expected): void
    {
        self::assertSame(
            $expected,
            TextArea::tag()->begin() . $content . TextArea::end(),
            'Streaming delimiters must not add line breaks to the value.',
        );
    }

    #[DataProviderExternal(TextAreaWhitespaceProvider::class, 'content')]
    public function testRenderWithContentPreservesWhitespace(string $content, string $expected): void
    {
        self::assertSame(
            $expected,
            TextArea::tag()
                ->content($content)
                ->render(),
            'Textarea content must retain its whitespace and remain encoded.',
        );
    }
}
