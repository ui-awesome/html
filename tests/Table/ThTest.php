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
 * {@see ThProvider} for test case data providers.
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
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Th::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Th::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
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
            'Raw HTML content must be applied.',
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
            "'abbr' must be serialized.",
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
            "'abbr' must be serialized.",
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
            "'accesskey' must be serialized.",
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
            'ARIA attribute must be added.',
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
            'ARIA attribute must be added.',
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
            'Data attribute must be added.',
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
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <th onclick="alert(&apos;Clicked!&apos;)">
            </th>
            HTML,
            Th::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
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
            'ARIA attribute map must be applied.',
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
            'Attribute map must be applied.',
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
            "'autofocus' must be serialized.",
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
            'begin/end must produce a complete element.',
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
            "'class' must be serialized.",
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
            "'class' must be serialized.",
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
            "'colspan' must be serialized.",
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
            'Bare element must render with no attributes.',
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
            "'contentEditable' must be serialized.",
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
            "'contentEditable' must be serialized.",
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
            'Data attribute map must be applied.',
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
            'Constructor configuration must be applied.',
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
            'Default provider must contribute attributes.',
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
            'Bare element must render with no attributes.',
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
            "'dir' must be serialized.",
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
            "'dir' must be serialized.",
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
            "'draggable' must be serialized.",
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
            "'draggable' must be serialized.",
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
            'Factory defaults must be applied.',
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
            "'headers' must be serialized.",
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
            "'headers' must be serialized.",
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
            "'hidden' must be serialized.",
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
            "'id' must be serialized.",
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
            "'lang' must be serialized.",
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
            "'lang' must be serialized.",
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
            'Microdata attributes must be serialized.',
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
            'ARIA attribute must be removed.',
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
                ->addAttribute('class', 'value')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
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
            'Data attribute must be removed.',
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
            "'role' must be serialized.",
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
            "'role' must be serialized.",
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
            "'rowspan' must be serialized.",
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
            "'scope' must be serialized.",
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
            "'scope' must be serialized.",
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
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
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
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
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
            "'spellcheck' must be serialized.",
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
            "'style' must be serialized.",
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
            "'tabindex' must be serialized.",
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
            'Theme provider must contribute classes.',
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
            "'title' must be serialized.",
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
            'Casting to string must produce HTML.',
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
            "'translate' must be serialized.",
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
            "'translate' must be serialized.",
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
            'User attributes must take precedence over factory defaults.',
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
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $th,
            $th->colspan(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $th,
            $th->headers(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $th,
            $th->rowspan(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $th,
            $th->scope(null),
            'New instance must be returned (immutability).',
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
                implode("', '", Enum::normalizeStringArray(ContentEditable::cases())),
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
                implode("', '", Enum::normalizeStringArray(Direction::cases())),
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
                implode("', '", Enum::normalizeStringArray(Draggable::cases())),
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
                implode("', '", Enum::normalizeStringArray(Language::cases())),
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
                implode("', '", Enum::normalizeStringArray(Role::cases())),
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
                implode("', '", Enum::normalizeStringArray(Scope::cases())),
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
                implode("', '", Enum::normalizeStringArray(Translate::cases())),
            ),
        );

        Th::tag()->translate('invalid-value');
    }
}
