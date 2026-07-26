<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use Stringable;
use UIAwesome\Html\Form\Values\SelectTag;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Html;
use UIAwesome\Html\Interop\{Block, Inline, Lists, MetadataBlock, MetadataVoid, Root, Table, Voids};
use UIAwesome\Html\Tests\Provider\HtmlProvider;

/**
 * Unit tests for {@see Html} static factory methods and the `el()` terminal shortcut.
 *
 * {@see HtmlProvider} for test case data providers.
 */
#[Group('html')]
final class HtmlTest extends TestCase
{
    public function testElEncodesAttributeValue(): void
    {
        self::assertSame(
            <<<HTML
            <div title="&quot;&gt;&lt;script&gt;alert(&apos;xss&apos;)&lt;/script&gt;">
            value
            </div>
            HTML,
            Html::el('div', ['title' => '"><script>alert(\'xss\')</script>'], 'value'),
            'Attribute value must be escaped.',
        );
    }

    public function testElEncodesContentForBlockElement(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            &lt;script&gt;alert("xss")&lt;/script&gt;
            </div>
            HTML,
            Html::el('div', [], '<script>alert("xss")</script>'),
            'Block content must be escaped.',
        );
    }

    public function testElEncodesContentForInlineElement(): void
    {
        self::assertSame(
            <<<HTML
            <span>&lt;script&gt;alert("xss")&lt;/script&gt;</span>
            HTML,
            Html::el('span', [], '<script>alert("xss")</script>'),
            'Inline content must be escaped.',
        );
    }

    public function testElIgnoresContentForVoidElement(): void
    {
        self::assertSame(
            <<<HTML
            <hr>
            HTML,
            Html::el('hr', [], 'value'),
            'Void element must not carry content.',
        );
    }

    public function testElRendersBlockElement(): void
    {
        self::assertSame(
            <<<HTML
            <div class="container">
            value
            </div>
            HTML,
            Html::el('div', ['class' => 'container'], 'value'),
            'Block tag must render with attributes and content.',
        );
    }

    public function testElRendersBlockElementWithoutContent(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            </div>
            HTML,
            Html::el('div'),
            'Empty content must still close the tag.',
        );
    }

    public function testElRendersInlineElement(): void
    {
        self::assertSame(
            <<<HTML
            <span class="badge">value</span>
            HTML,
            Html::el('span', ['class' => 'badge'], 'value'),
            'Inline tag must render without line breaks.',
        );
    }

    public function testElRendersListElement(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            value
            </li>
            HTML,
            Html::el('li', [], 'value'),
            'List tag must render as a block.',
        );
    }

    public function testElRendersMetadataBlockElement(): void
    {
        self::assertSame(
            <<<HTML
            <title>
            value
            </title>
            HTML,
            Html::el('title', [], 'value'),
            'Metadata block tag must render as a block.',
        );
    }

    public function testElRendersMetadataVoidElement(): void
    {
        self::assertSame(
            <<<HTML
            <meta charset="utf-8">
            HTML,
            Html::el('meta', ['charset' => 'utf-8']),
            'Metadata void tag must render as a void.',
        );
    }

    public function testElRendersOptionElement(): void
    {
        self::assertSame(
            <<<HTML
            <option value="1">
            value
            </option>
            HTML,
            Html::el('option', ['value' => '1'], 'value'),
            'Select tag must render as a block.',
        );
    }

    public function testElRendersRootElement(): void
    {
        self::assertSame(
            <<<HTML
            <body>
            value
            </body>
            HTML,
            Html::el('body', [], 'value'),
            'Root tag must render as a block.',
        );
    }

    public function testElRendersStringableContent(): void
    {
        $content = new class implements Stringable {
            public function __toString(): string
            {
                return 'value';
            }
        };

        self::assertSame(
            <<<HTML
            <div>
            value
            </div>
            HTML,
            Html::el('div', [], $content),
            'Stringable content must be cast to `string`.',
        );
    }

    public function testElRendersTableElement(): void
    {
        self::assertSame(
            <<<HTML
            <td>
            value
            </td>
            HTML,
            Html::el('td', [], 'value'),
            'Table tag must render as a block.',
        );
    }

    public function testElRendersVoidElement(): void
    {
        self::assertSame(
            <<<HTML
            <img src="image.png" alt="value">
            HTML,
            Html::el('img', ['src' => 'image.png', 'alt' => 'value']),
            'Void tag must render self-closed with attributes.',
        );
    }

    public function testFacadeExposesFactoryForEveryProvidedMethod(): void
    {
        $methods = [];

        foreach ((new ReflectionClass(Html::class))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->isStatic()) {
                $methods[] = $method->getName();
            }
        }

        $expected = array_keys(HtmlProvider::factory());
        $expected[] = 'el';

        sort($expected);
        sort($methods);

        self::assertSame($expected, $methods, 'Provider must map every public static factory.');
    }

    /**
     * @phpstan-param Closure(): object $factory
     * @phpstan-param class-string $expected
     */
    #[DataProviderExternal(HtmlProvider::class, 'factory')]
    public function testFactoryReturnsExpectedElementInstance(Closure $factory, string $expected): void
    {
        $element = $factory();

        self::assertSame($expected, $element::class, 'Factory must return the mapped element class.');
    }

    public function testThrowInvalidArgumentExceptionForUnknownTag(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'unknown',
                'tag',
                implode(
                    "', '",
                    Enum::normalizeStringArray(
                        [
                            ...Block::cases(),
                            ...Inline::cases(),
                            ...Lists::cases(),
                            ...MetadataBlock::cases(),
                            ...MetadataVoid::cases(),
                            ...Root::cases(),
                            ...SelectTag::cases(),
                            ...Table::cases(),
                            ...Voids::cases(),
                        ],
                    ),
                ),
            ),
        );

        Html::el('unknown');
    }
}
