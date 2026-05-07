<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\{BackedInteger, BackedString};
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
    Autocomplete,
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
use UIAwesome\Html\Form\{Optgroup, Option, Select};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Select} rendering and attribute behavior.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class SelectTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Select::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Select::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Select::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <value>
            </select>
            HTML,
            Select::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <select accesskey="value">
            </select>
            HTML,
            Select::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <select aria-label="value">
            </select>
            HTML,
            Select::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select aria-label="value">
            </select>
            HTML,
            Select::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <select data-value="value">
            </select>
            HTML,
            Select::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select data-value="value">
            </select>
            HTML,
            Select::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <select onclick="alert(&apos;Clicked!&apos;)">
            </select>
            HTML,
            Select::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <select aria-controls="value" aria-label="value">
            </select>
            HTML,
            Select::tag()
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
            <select class="value">
            </select>
            HTML,
            Select::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <select autocomplete="on">
            </select>
            HTML,
            Select::tag()
                ->autocomplete('on')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select autocomplete="on">
            </select>
            HTML,
            Select::tag()
                ->autocomplete(Autocomplete::ON)
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <select autofocus>
            </select>
            HTML,
            Select::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            Content
            </select>
            HTML,
            Select::tag()->begin() . 'Content' . Select::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <select class="value">
            </select>
            HTML,
            Select::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select class="value">
            </select>
            HTML,
            Select::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="dog">Dog</option>
            </select>
            HTML,
            Select::tag()
                ->html('<option value="dog">Dog</option>')
                ->render(),
            'Inline content must be rendered.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <select contenteditable="true">
            </select>
            HTML,
            Select::tag()
                ->contentEditable(true)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select contenteditable="true">
            </select>
            HTML,
            Select::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <select data-value="value">
            </select>
            HTML,
            Select::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <select class="default-class">
            </select>
            HTML,
            Select::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <select class="default-class">
            </select>
            HTML,
            Select::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <select dir="ltr">
            </select>
            HTML,
            Select::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select dir="ltr">
            </select>
            HTML,
            Select::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <select disabled>
            </select>
            HTML,
            Select::tag()
                ->disabled(true)
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <select draggable="true">
            </select>
            HTML,
            Select::tag()
                ->draggable(true)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select draggable="true">
            </select>
            HTML,
            Select::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <select onfocus="handleFocus()" onblur="handleBlur()">
            </select>
            HTML,
            Select::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <select form="value">
            </select>
            HTML,
            Select::tag()
                ->form('value')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Select::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <select class="default-class">
            </select>
            HTML,
            Select::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Select::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <select hidden>
            </select>
            HTML,
            Select::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <select id="value">
            </select>
            HTML,
            Select::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <select lang="en">
            </select>
            HTML,
            Select::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select lang="en">
            </select>
            HTML,
            Select::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <select itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </select>
            HTML,
            Select::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
            'Microdata attributes must be serialized.',
        );
    }

    public function testRenderWithMultiple(): void
    {
        self::assertSame(
            <<<HTML
            <select multiple>
            </select>
            HTML,
            Select::tag()
                ->multiple(true)
                ->render(),
            "'multiple' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <select name="value">
            </select>
            HTML,
            Select::tag()
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithOptgroup(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <optgroup label="Chile">
            <option value="1">
            Santiago
            </option>
            </optgroup>
            </select>
            HTML,
            Select::tag()
                ->optgroup(
                    Optgroup::tag()
                        ->label('Chile')
                        ->option(Option::tag()->value('1')->content('Santiago')),
                )
                ->render(),
            'Optgroup must be appended.',
        );
    }

    public function testRenderWithOption(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="1">
            Santiago
            </option>
            </select>
            HTML,
            Select::tag()
                ->option(Option::tag()->value('1')->content('Santiago'))
                ->render(),
            'Option must be appended.',
        );
    }

    public function testRenderWithOptions(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="dog">
            Dog
            </option>
            <option value="cat">
            Cat
            </option>
            <option value="hamster">
            Hamster
            </option>
            </select>
            HTML,
            Select::tag()
                ->options(['dog', 'Dog'], ['cat', 'Cat'], ['hamster', 'Hamster'])
                ->render(),
            'Options collection must be applied.',
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            </select>
            HTML,
            Select::tag()
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
            <select>
            </select>
            HTML,
            Select::tag()
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
            <select>
            </select>
            HTML,
            Select::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            </select>
            HTML,
            Select::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <select required>
            </select>
            HTML,
            Select::tag()
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <select role="banner">
            </select>
            HTML,
            Select::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select role="banner">
            </select>
            HTML,
            Select::tag()
                ->role(Role::BANNER)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <select class="value">
            </select>
            HTML,
            Select::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select title="value">
            </select>
            HTML,
            Select::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <select size="4">
            </select>
            HTML,
            Select::tag()
                ->size(4)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSizeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select size="1">
            </select>
            HTML,
            Select::tag()
                ->size(BackedInteger::VALUE)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <select spellcheck="true">
            </select>
            HTML,
            Select::tag()
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <select style='value'>
            </select>
            HTML,
            Select::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <select tabindex="3">
            </select>
            HTML,
            Select::tag()
                ->tabIndex(3)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <select class="text-muted">
            </select>
            HTML,
            Select::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <select title="value">
            </select>
            HTML,
            Select::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            </select>
            HTML,
            (string) Select::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <select translate="no">
            </select>
            HTML,
            Select::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select translate="no">
            </select>
            HTML,
            Select::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Select::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <select class="from-global" id="value">
            </select>
            HTML,
            Select::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Select::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $select = Select::tag();

        self::assertNotSame(
            $select,
            $select->option(Option::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $select,
            $select->optgroup(Optgroup::tag()->label('group')),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $select,
            $select->options(['dog', 'Dog']),
            'New instance must be returned (immutability).',
        );
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

        Select::tag()->contentEditable('invalid-value');
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

        Select::tag()->dir('invalid-value');
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

        Select::tag()->draggable('invalid-value');
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

        Select::tag()->lang('invalid-value');
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

        Select::tag()->role('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                'invalid-value',
                Attribute::SIZE->value,
                'value >= 0',
            ),
        );

        Select::tag()->size('invalid-value');
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

        Select::tag()->tabIndex(-2);
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

        Select::tag()->translate('invalid-value');
    }
}
