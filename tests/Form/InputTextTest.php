<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
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
use UIAwesome\Html\Form\InputText;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputText} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input text specific attributes (`autocomplete`, `autofocus`, `dirname`, `disabled`, `form`, `list`,
 *   `maxlength`, `minlength`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `spellcheck`,
 *   `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputText} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputTextTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputText::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::TEXT,
                'class' => 'value',
            ],
            InputText::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" accesskey="value">
            HTML,
            InputText::tag()
                ->accesskey('value')
                ->id('inputtext')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-label="value">
            HTML,
            InputText::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputtext')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-label="value">
            HTML,
            InputText::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputtext')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" data-value="value">
            HTML,
            InputText::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputtext')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" data-value="value">
            HTML,
            InputText::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputtext')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputText::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputtext')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-controls="value" aria-label="value">
            HTML,
            InputText::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputtext')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->attributes(['class' => 'value'])
                ->id('inputtext')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" autocomplete="on">
            HTML,
            InputText::tag()
                ->autocomplete('on')
                ->id('inputtext')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" autocomplete="on">
            HTML,
            InputText::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputtext')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" autofocus>
            HTML,
            InputText::tag()
                ->autofocus(true)
                ->id('inputtext')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->class('value')
                ->id('inputtext')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->class(BackedString::VALUE)
                ->id('inputtext')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" data-value="value">
            HTML,
            InputText::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputtext')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtext" type="text">
            HTML,
            InputText::tag(['class' => 'default-class'])
                ->id('inputtext')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtext" type="text" title="default-title">
            HTML,
            InputText::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputtext')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" dir="ltr">
            HTML,
            InputText::tag()
                ->dir('ltr')
                ->id('inputtext')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" dirname="comment.dir">
            HTML,
            InputText::tag()
                ->dirname('comment.dir')
                ->id('inputtext')
                ->render(),
            "'dirname' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" dir="ltr">
            HTML,
            InputText::tag()
                ->dir(Direction::LTR)
                ->id('inputtext')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" disabled>
            HTML,
            InputText::tag()
                ->disabled(true)
                ->id('inputtext')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputText::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputtext')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" form="value">
            HTML,
            InputText::tag()
                ->form('value')
                ->id('inputtext')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputText::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputText::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" hidden>
            HTML,
            InputText::tag()
                ->hidden(true)
                ->id('inputtext')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" lang="en">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" lang="en">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" list="value">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" maxlength="10">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->maxlength(10)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" minlength="5">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->minlength(5)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" name="value" type="text">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" pattern='[A-Za-z]{3}'>
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->pattern('[A-Za-z]{3}')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" placeholder="value">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" readonly>
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputtext')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->addAttribute('class', 'value')
                ->id('inputtext')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputtext')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputtext')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" required>
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" role="textbox">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" role="textbox">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" title="value">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" size="20">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->size(20)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" spellcheck="true">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" style='value'>
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" tabindex="1">
            HTML,
            InputText::tag()
                ->id('inputtext')
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
            <input id="inputtext" type="text">
            </div>
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputtext')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" title="value">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="text">
            HTML,
            (string) InputText::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" translate="no">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" translate="no">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputText::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="text">
            HTML,
            InputText::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputText::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" value="value">
            HTML,
            InputText::tag()
                ->id('inputtext')
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

        InputText::tag()->dir('invalid-value');
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

        InputText::tag()->lang('invalid-value');
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

        InputText::tag()->maxlength(-1);
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

        InputText::tag()->minlength(-1);
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

        InputText::tag()->role('invalid-value');
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

        InputText::tag()->tabIndex(-2);
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

        InputText::tag()->translate('invalid-value');
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

        InputText::tag()->type('invalid-value');
    }
}
