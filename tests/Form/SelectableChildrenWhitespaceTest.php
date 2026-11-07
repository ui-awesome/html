<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\{Optgroup, Option, Select};
use UIAwesome\Html\Tests\Provider\Form\SelectableChildrenWhitespaceProvider;

/**
 * Unit tests for whitespace preservation around deferred select and optgroup children.
 *
 * {@see SelectableChildrenWhitespaceProvider} for test case data providers.
 */
#[Group('form')]
final class SelectableChildrenWhitespaceTest extends TestCase
{
    #[DataProviderExternal(SelectableChildrenWhitespaceProvider::class, 'contentAfterOption')]
    public function testRenderWithContentAfterOption(
        Optgroup|Select $element,
        string $content,
        string $expected,
    ): void {
        self::assertSame(
            $expected,
            $element
                ->option(Option::tag()->content('Santiago'))
                ->content($content)
                ->render(),
            'Following content must be separated without losing user whitespace or escaping.',
        );
    }

    #[DataProviderExternal(SelectableChildrenWhitespaceProvider::class, 'contentBeforeOption')]
    public function testRenderWithContentBeforeOption(
        Optgroup|Select $element,
        string $content,
        string $expected,
    ): void {
        self::assertSame(
            $expected,
            $element
                ->content($content)
                ->option(Option::tag()->content('Santiago'))
                ->render(),
            'Preceding content must retain its whitespace without an added separator.',
        );
    }

    public function testRenderWithOptgroupHtmlAfterOption(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup>
            <option>
            Santiago
            </option>
            <span>After</span>
            </optgroup>
            HTML,
            Optgroup::tag()
                ->option(Option::tag()->content('Santiago'))
                ->html('<span>After</span>')
                ->render(),
            'Following raw HTML must be separated without encoding it.',
        );
    }

    public function testRenderWithOptgroupMixedContentPreservesWhitespace(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup>
            Before<option>
            First
            </option>
            Between

            <option>
            Second
            </option>
            After
            </optgroup>
            HTML,
            Optgroup::tag()
                ->content('Before')
                ->option(Option::tag()->content('First'))
                ->content("Between\n\n")
                ->option(Option::tag()->content('Second'))
                ->content('After')
                ->render(),
            'Mixed content must retain its order, blank lines, and existing boundaries.',
        );
    }

    public function testRenderWithOptgroupOptionsPreservesWhitespace(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup>
            <option>
            first

            line

            </option>
            <option>
            A &amp; B
            </option>
            </optgroup>
            HTML,
            Optgroup::tag()->options(
                Option::tag()->content("first\n\nline\n"),
                Option::tag()->content('A & B'),
            )->render(),
            'Deferred option rendering must preserve content and separate only the children.',
        );
    }

    public function testRenderWithSelectHtmlAfterOption(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option>
            Santiago
            </option>
            <span>After</span>
            </select>
            HTML,
            Select::tag()
                ->option(Option::tag()->content('Santiago'))
                ->html('<span>After</span>')
                ->render(),
            'Following raw HTML must be separated without encoding it.',
        );
    }

    public function testRenderWithSelectMixedContentPreservesWhitespace(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            Before<option>
            First
            </option>
            Between

            <option>
            Second
            </option>
            After
            </select>
            HTML,
            Select::tag()
                ->content('Before')
                ->option(Option::tag()->content('First'))
                ->content("Between\n\n")
                ->option(Option::tag()->content('Second'))
                ->content('After')
                ->render(),
            'Mixed content must retain its order, blank lines, and existing boundaries.',
        );
    }

    public function testRenderWithSelectOptionsPreservesWhitespace(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option>
            first

            line

            </option>
            <option>
            A &amp; B
            </option>
            </select>
            HTML,
            Select::tag()->options(
                Option::tag()->content("first\n\nline\n"),
                Option::tag()->content('A & B'),
            )->render(),
            'Deferred option rendering must preserve content and separate only the children.',
        );
    }
}
