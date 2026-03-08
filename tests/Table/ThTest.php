<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    ContentEditable,
    Data,
    Direction,
    Draggable,
    GlobalAttribute,
    Language,
    Role,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Table\Th;
use UIAwesome\Html\Table\Values\Scope;
use UIAwesome\Html\Tests\Provider\Table\ThProvider;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Th} rendering and table header cell attribute behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*` and enum-backed values.
 * - Applies table header cell specific attributes (`abbr`, `colspan`, `headers`, `rowspan`, `scope`) and renders
 *   expected output.
 * - Covers `colspan` and `rowspan` boundary values for minimum and maximum valid limits with integer and
 *   numeric-string inputs.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, begin/end usage, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('table')]
final class ThTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Th::tag()
                ->content('<value>')
                ->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Th::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Th::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            <value>
            </th>
            HTML,
            Th::tag()
                ->html('<value>')
                ->render(),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAbbr(): void
    {
        self::assertSame(
            <<<HTML
            <th abbr="value">
            </th>
            HTML,
            Th::tag()
                ->abbr('value')
                ->render(),
            "Failed asserting that element renders correctly with 'abbr' attribute.",
        );
    }

    public function testRenderWithAbbrUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th abbr="value">
            </th>
            HTML,
            Th::tag()
                ->abbr(BackedString::VALUE)
                ->render(),
            "Failed asserting that element renders correctly with 'abbr' attribute.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <th accesskey="value">
            </th>
            HTML,
            Th::tag()
                ->accesskey('value')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <th aria-label="value">
            </th>
            HTML,
            Th::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th aria-label="value">
            </th>
            HTML,
            Th::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <th data-value="value">
            </th>
            HTML,
            Th::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th data-value="value">
            </th>
            HTML,
            Th::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <th aria-controls="value" aria-label="value">
            </th>
            HTML,
            Th::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <th class="value">
            </th>
            HTML,
            Th::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <th autofocus>
            </th>
            HTML,
            Th::tag()
                ->autofocus(true)
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            Content
            </th>
            HTML,
            Th::tag()->begin() . 'Content' . Th::end(),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <th class="value">
            </th>
            HTML,
            Th::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th class="value">
            </th>
            HTML,
            Th::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    #[DataProviderExternal(ThProvider::class, 'colspanValues')]
    public function testRenderWithColspanValues(int|string $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Th::tag()
                ->colspan($value)
                ->render(),
            "Failed asserting that element renders correctly with 'colspan' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            value
            </th>
            HTML,
            Th::tag()
                ->content('value')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <th contenteditable="true">
            </th>
            HTML,
            Th::tag()
                ->contentEditable(true)
                ->render(),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th contenteditable="true">
            </th>
            HTML,
            Th::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <th data-value="value">
            </th>
            HTML,
            Th::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <th class="default-class">
            </th>
            HTML,
            Th::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <th class="default-class">
            </th>
            HTML,
            Th::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            </th>
            HTML,
            Th::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <th dir="ltr">
            </th>
            HTML,
            Th::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th dir="ltr">
            </th>
            HTML,
            Th::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <th draggable="true">
            </th>
            HTML,
            Th::tag()
                ->draggable(true)
                ->render(),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th draggable="true">
            </th>
            HTML,
            Th::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Th::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <th class="default-class">
            </th>
            HTML,
            Th::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            Th::class,
            [],
        );
    }

    public function testRenderWithHeaders(): void
    {
        self::assertSame(
            <<<HTML
            <th headers="value1 value2">
            </th>
            HTML,
            Th::tag()
                ->headers('value1 value2')
                ->render(),
            "Failed asserting that element renders correctly with 'headers' attribute.",
        );
    }

    public function testRenderWithHeadersUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th headers="value">
            </th>
            HTML,
            Th::tag()
                ->headers(BackedString::VALUE)
                ->render(),
            "Failed asserting that element renders correctly with 'headers' attribute.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <th hidden>
            </th>
            HTML,
            Th::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <th id="value">
            </th>
            HTML,
            Th::tag()
                ->id('value')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <th lang="en">
            </th>
            HTML,
            Th::tag()
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th lang="en">
            </th>
            HTML,
            Th::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <th itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </th>
            HTML,
            Th::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
            'Failed asserting that element renders correctly with microdata attributes.',
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            </th>
            HTML,
            Th::tag()
                ->addAriaAttribute('label', 'value')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            </th>
            HTML,
            Th::tag()
                ->setAttribute('class', 'value')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            </th>
            HTML,
            Th::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <th role="banner">
            </th>
            HTML,
            Th::tag()
                ->role('banner')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th role="banner">
            </th>
            HTML,
            Th::tag()
                ->role(Role::BANNER)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    #[DataProviderExternal(ThProvider::class, 'rowspanValues')]
    public function testRenderWithRowspanValues(int|string $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Th::tag()
                ->rowspan($value)
                ->render(),
            "Failed asserting that element renders correctly with 'rowspan' attribute.",
        );
    }

    public function testRenderWithScope(): void
    {
        self::assertSame(
            <<<HTML
            <th scope="row">
            </th>
            HTML,
            Th::tag()
                ->scope('row')
                ->render(),
            "Failed asserting that element renders correctly with 'scope' attribute.",
        );
    }

    public function testRenderWithScopeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th scope="row">
            </th>
            HTML,
            Th::tag()
                ->scope(Scope::ROW)
                ->render(),
            "Failed asserting that element renders correctly with 'scope' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <th class="value">
            </th>
            HTML,
            Th::tag()
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th title="value">
            </th>
            HTML,
            Th::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <th spellcheck="true">
            </th>
            HTML,
            Th::tag()
                ->spellcheck(true)
                ->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <th style='value'>
            </th>
            HTML,
            Th::tag()
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <th tabindex="3">
            </th>
            HTML,
            Th::tag()
                ->tabIndex(3)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <th class="text-muted">
            </th>
            HTML,
            Th::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <th title="value">
            </th>
            HTML,
            Th::tag()
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            </th>
            HTML,
            (string) Th::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <th translate="no">
            </th>
            HTML,
            Th::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <th translate="no">
            </th>
            HTML,
            Th::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Th::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <th class="from-global" id="value">
            </th>
            HTML,
            Th::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            Th::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $th = Th::tag();

        self::assertNotSame(
            $th,
            $th->abbr(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $th,
            $th->colspan(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $th,
            $th->headers(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $th,
            $th->rowspan(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $th,
            $th->scope(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingColspanMaxValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '1001',
                'colspan',
                '1 <= value <= 1000',
            ),
        );

        Th::tag()->colspan(1001);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingColspanMinValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '0',
                'colspan',
                '1 <= value <= 1000',
            ),
        );

        Th::tag()->colspan(0);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingContentEditable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::CONTENTEDITABLE->value,
                implode("', '", Enum::normalizeArray(ContentEditable::cases())),
            ),
        );

        Th::tag()->contentEditable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDir(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DIR->value,
                implode("', '", Enum::normalizeArray(Direction::cases())),
            ),
        );

        Th::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDraggable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DRAGGABLE->value,
                implode("', '", Enum::normalizeArray(Draggable::cases())),
            ),
        );

        Th::tag()->draggable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLang(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::LANG->value,
                implode("', '", Enum::normalizeArray(Language::cases())),
            ),
        );

        Th::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::ROLE->value,
                implode("', '", Enum::normalizeArray(Role::cases())),
            ),
        );

        Th::tag()->role('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRowspanMaxValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '65535',
                'rowspan',
                '0 <= value <= 65534',
            ),
        );

        Th::tag()->rowspan(65535);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRowspanMinValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-1',
                'rowspan',
                '0 <= value <= 65534',
            ),
        );

        Th::tag()->rowspan(-1);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingScope(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'scope',
                implode("', '", Enum::normalizeArray(Scope::cases())),
            ),
        );

        Th::tag()->scope('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTabindex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-2',
                GlobalAttribute::TABINDEX->value,
                'value >= -1',
            ),
        );

        Th::tag()->tabIndex(-2);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTranslate(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::TRANSLATE->value,
                implode("', '", Enum::normalizeArray(Translate::cases())),
            ),
        );

        Th::tag()->translate('invalid-value');
    }
}
