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
use UIAwesome\Html\Form\InputHidden;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputHidden} class.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputHiddenTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputHidden::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::HIDDEN,
                'class' => 'value',
            ],
            InputHidden::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" accesskey="value">
            HTML,
            InputHidden::tag()
                ->accesskey('value')
                ->id('inputhidden')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-label="value">
            HTML,
            InputHidden::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputhidden')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-label="value">
            HTML,
            InputHidden::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputhidden')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" data-value="value">
            HTML,
            InputHidden::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputhidden')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" data-value="value">
            HTML,
            InputHidden::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputhidden')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputHidden::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputhidden')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-controls="value" aria-label="value">
            HTML,
            InputHidden::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputhidden')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->attributes(['class' => 'value'])
                ->id('inputhidden')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" autocomplete="on">
            HTML,
            InputHidden::tag()
                ->autocomplete('on')
                ->id('inputhidden')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" autocomplete="on">
            HTML,
            InputHidden::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputhidden')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->class('value')
                ->id('inputhidden')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->class(BackedString::VALUE)
                ->id('inputhidden')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" data-value="value">
            HTML,
            InputHidden::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputhidden')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag(['class' => 'default-class'])
                ->id('inputhidden')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputhidden" type="hidden" title="default-title">
            HTML,
            InputHidden::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputhidden')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" dir="ltr">
            HTML,
            InputHidden::tag()
                ->dir('ltr')
                ->id('inputhidden')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" dir="ltr">
            HTML,
            InputHidden::tag()
                ->dir(Direction::LTR)
                ->id('inputhidden')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" disabled>
            HTML,
            InputHidden::tag()
                ->disabled(true)
                ->id('inputhidden')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputHidden::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputhidden')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" form="value">
            HTML,
            InputHidden::tag()
                ->form('value')
                ->id('inputhidden')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputHidden::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputHidden::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" hidden>
            HTML,
            InputHidden::tag()
                ->hidden(true)
                ->id('inputhidden')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" lang="en">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" lang="en">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" name="value" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
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
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
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
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
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
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputhidden')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" role="presentation">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->role('presentation')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" role="presentation">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->role(Role::PRESENTATION)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" title="value">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" style='value'>
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputhidden')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" title="value">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="hidden">
            HTML,
            (string) InputHidden::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" translate="no">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" translate="no">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputHidden::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="id-user" type="hidden">
            HTML,
            InputHidden::tag(['id' => 'id-user'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputHidden::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" value="value">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
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

        InputHidden::tag()->dir('invalid-value');
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

        InputHidden::tag()->lang('invalid-value');
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

        InputHidden::tag()->role('invalid-value');
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

        InputHidden::tag()->translate('invalid-value');
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

        InputHidden::tag()->type('invalid-value');
    }
}
