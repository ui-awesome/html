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
    Data,
    Direction,
    GlobalAttribute,
    Language,
    Role,
    Translate,
    Type,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputUrl;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for the {@see InputUrl} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input url specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `maxlength`,
 *   `minlength`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `spellcheck`, `tabindex`, `value`)
 *   and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputUrl} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputUrlTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputUrl::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::URL,
                'class' => 'value',
            ],
            InputUrl::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" accesskey="value">
            HTML,
            InputUrl::tag()
                ->accesskey('value')
                ->id('inputurl')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" aria-label="value">
            HTML,
            InputUrl::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputurl')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" aria-label="value">
            HTML,
            InputUrl::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputurl')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" data-value="value">
            HTML,
            InputUrl::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputurl')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" data-value="value">
            HTML,
            InputUrl::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputurl')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputUrl::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputurl')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" aria-controls="value" aria-label="value">
            HTML,
            InputUrl::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputurl')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->class('value')
                ->id('inputurl')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" autocomplete="on">
            HTML,
            InputUrl::tag()
                ->autocomplete('on')
                ->id('inputurl')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" autocomplete="on">
            HTML,
            InputUrl::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputurl')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" autofocus>
            HTML,
            InputUrl::tag()
                ->autofocus(true)
                ->id('inputurl')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->class('value')
                ->id('inputurl')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->class(BackedString::VALUE)
                ->id('inputurl')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" data-value="value">
            HTML,
            InputUrl::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputurl')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputurl" type="url">
            HTML,
            InputUrl::tag(['class' => 'default-class'])
                ->id('inputurl')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputurl" type="url" title="default-title">
            HTML,
            InputUrl::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputurl')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" dir="ltr">
            HTML,
            InputUrl::tag()
                ->dir('ltr')
                ->id('inputurl')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" dir="ltr">
            HTML,
            InputUrl::tag()
                ->dir(Direction::LTR)
                ->id('inputurl')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" disabled>
            HTML,
            InputUrl::tag()
                ->disabled(true)
                ->id('inputurl')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputUrl::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputurl')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" form="value">
            HTML,
            InputUrl::tag()
                ->form('value')
                ->id('inputurl')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputUrl::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputUrl::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" hidden>
            HTML,
            InputUrl::tag()
                ->hidden(true)
                ->id('inputurl')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" lang="en">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" lang="en">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" list="value">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" maxlength="10">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->maxlength(10)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" minlength="5">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->minlength(5)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" name="value" type="url">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" pattern="https://.*">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->pattern('https://.*')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" placeholder="value">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" readonly>
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputurl')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->addAttribute('class', 'value')
                ->id('inputurl')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputurl')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputurl')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" required>
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" role="textbox">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" role="textbox">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" title="value">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" size="30">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->size(30)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSizeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" size="1">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->size(BackedInteger::VALUE)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" spellcheck="true">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" style='value'>
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" tabindex="1">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value">
            <input id="inputurl" type="url">
            </div>
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputurl')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" title="value">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="url">
            HTML,
            (string) InputUrl::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" translate="no">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" translate="no">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputUrl::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="url">
            HTML,
            InputUrl::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputUrl::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" value="value">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDir(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DIR->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Direction::cases())),
            ),
        );

        InputUrl::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLang(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::LANG->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Language::cases())),
            ),
        );

        InputUrl::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingMaxlength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-1',
                Attribute::MAXLENGTH->value,
                'value >= 0',
            ),
        );

        InputUrl::tag()->maxlength(-1);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingMinlength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-1',
                Attribute::MINLENGTH->value,
                'value >= 0',
            ),
        );

        InputUrl::tag()->minlength(-1);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::ROLE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Role::cases())),
            ),
        );

        InputUrl::tag()->role('invalid-value');
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

        InputUrl::tag()->tabIndex(-2);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTranslate(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::TRANSLATE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Translate::cases())),
            ),
        );

        InputUrl::tag()->translate('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TYPE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Type::cases())),
            ),
        );

        InputUrl::tag()->type('invalid-value');
    }
}
