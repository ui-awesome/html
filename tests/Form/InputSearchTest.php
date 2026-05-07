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
use UIAwesome\Html\Form\InputSearch;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputSearch} class.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputSearchTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputSearch::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::SEARCH,
                'class' => 'value',
            ],
            InputSearch::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" accesskey="value">
            HTML,
            InputSearch::tag()
                ->accesskey('value')
                ->id('inputsearch')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-label="value">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputsearch')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-label="value">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputsearch')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" data-value="value">
            HTML,
            InputSearch::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputsearch')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" data-value="value">
            HTML,
            InputSearch::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputsearch')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputSearch::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputsearch')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-controls="value" aria-label="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->ariaAttributes([
                    'controls' => 'value',
                    'label' => 'value',
                ])
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->attributes(['class' => 'value'])
                ->id('inputsearch')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autocomplete="on">
            HTML,
            InputSearch::tag()
                ->autocomplete('on')
                ->id('inputsearch')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autocomplete="on">
            HTML,
            InputSearch::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputsearch')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autofocus>
            HTML,
            InputSearch::tag()
                ->autofocus(true)
                ->id('inputsearch')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->class('value')
                ->id('inputsearch')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->class(BackedString::VALUE)
                ->id('inputsearch')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" data-value="value">
            HTML,
            InputSearch::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputsearch')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsearch" type="search">
            HTML,
            InputSearch::tag(['class' => 'default-class'])
                ->id('inputsearch')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsearch" type="search" title="default-title">
            HTML,
            InputSearch::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputsearch')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dir="ltr">
            HTML,
            InputSearch::tag()
                ->dir('ltr')
                ->id('inputsearch')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dirname="search.dir">
            HTML,
            InputSearch::tag()
                ->dirname('search.dir')
                ->id('inputsearch')
                ->render(),
            "'dirname' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dir="ltr">
            HTML,
            InputSearch::tag()
                ->dir(Direction::LTR)
                ->id('inputsearch')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" disabled>
            HTML,
            InputSearch::tag()
                ->disabled(true)
                ->id('inputsearch')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputSearch::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputsearch')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" form="value">
            HTML,
            InputSearch::tag()
                ->form('value')
                ->id('inputsearch')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputSearch::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputSearch::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" hidden>
            HTML,
            InputSearch::tag()
                ->hidden(true)
                ->id('inputsearch')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" lang="en">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" lang="en">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" list="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" maxlength="10">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->maxlength(10)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" minlength="3">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->minlength(3)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" name="value" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" pattern="search.*">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->pattern('search.*')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" placeholder="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" readonly>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputsearch')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->addAttribute('class', 'value')
                ->id('inputsearch')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputsearch')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputsearch')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" required>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" role="searchbox">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->role('searchbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" role="searchbox">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->role(Role::SEARCHBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" title="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" size="20">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->size(20)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSizeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" size="1">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->size(BackedInteger::VALUE)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" spellcheck="true">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" style='value'>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" tabindex="1">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
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
            <input id="inputsearch" type="search">
            </div>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputsearch')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" title="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search">
            HTML,
            (string) InputSearch::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" translate="no">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" translate="no">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputSearch::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="search">
            HTML,
            InputSearch::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputSearch::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" value="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
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
                implode("', '", Enum::normalizeStringArray(Direction::cases())),
            ),
        );

        InputSearch::tag()->dir('invalid-value');
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

        InputSearch::tag()->lang('invalid-value');
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

        InputSearch::tag()->maxlength(-1);
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

        InputSearch::tag()->minlength(-1);
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

        InputSearch::tag()->role('invalid-value');
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

        InputSearch::tag()->tabIndex(-2);
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

        InputSearch::tag()->translate('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TYPE->value,
                implode("', '", Enum::normalizeStringArray(Type::cases())),
            ),
        );

        InputSearch::tag()->type('invalid-value');
    }
}
