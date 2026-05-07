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
use UIAwesome\Html\Form\InputNumber;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputNumber} class.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputNumberTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputNumber::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::NUMBER,
                'class' => 'value',
            ],
            InputNumber::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" accesskey="value">
            HTML,
            InputNumber::tag()
                ->accesskey('value')
                ->id('inputnumber')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-label="value">
            HTML,
            InputNumber::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputnumber')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-label="value">
            HTML,
            InputNumber::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputnumber')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" data-value="value">
            HTML,
            InputNumber::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputnumber')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" data-value="value">
            HTML,
            InputNumber::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputnumber')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputNumber::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputnumber')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-controls="value" aria-label="value">
            HTML,
            InputNumber::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputnumber')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->attributes(['class' => 'value'])
                ->id('inputnumber')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" autocomplete="on">
            HTML,
            InputNumber::tag()
                ->autocomplete('on')
                ->id('inputnumber')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" autocomplete="on">
            HTML,
            InputNumber::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputnumber')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" autofocus>
            HTML,
            InputNumber::tag()
                ->autofocus(true)
                ->id('inputnumber')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->class('value')
                ->id('inputnumber')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->class(BackedString::VALUE)
                ->id('inputnumber')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" data-value="value">
            HTML,
            InputNumber::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputnumber')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputnumber" type="number">
            HTML,
            InputNumber::tag(['class' => 'default-class'])
                ->id('inputnumber')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputnumber" type="number" title="default-title">
            HTML,
            InputNumber::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputnumber')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" dir="ltr">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" dir="ltr">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" disabled>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->disabled(true)
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputNumber::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputnumber')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" form="value">
            HTML,
            InputNumber::tag()
                ->form('value')
                ->id('inputnumber')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputNumber::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputNumber::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" hidden>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" lang="en">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" lang="en">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" list="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" max="100">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->max(100)
                ->render(),
            "'max' must be serialized.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" min="10">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->min(10)
                ->render(),
            "'min' must be serialized.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" min="10" max="100">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->min(10)
                ->max(100)
                ->render(),
            'min and max must be serialized together.',
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" name="value" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" placeholder="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" readonly>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputnumber')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->addAttribute('class', 'value')
                ->id('inputnumber')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputnumber')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputnumber')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" required>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" role="spinbutton">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->role('spinbutton')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" role="spinbutton">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->role(Role::SPINBUTTON)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" title="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" step="2">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->step(2)
                ->render(),
            "'step' must be serialized.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" step="any">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->step('any')
                ->render(),
            'step must accept the literal `any`.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" style='value'>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" tabindex="1">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
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
            <input id="inputnumber" type="number">
            </div>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputnumber')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" title="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="number">
            HTML,
            (string) InputNumber::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" translate="no">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" translate="no">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputNumber::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="number">
            HTML,
            InputNumber::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(InputNumber::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" value="10">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->value(10)
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

        InputNumber::tag()->dir('invalid-value');
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

        InputNumber::tag()->lang('invalid-value');
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

        InputNumber::tag()->role('invalid-value');
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

        InputNumber::tag()->tabIndex(-2);
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

        InputNumber::tag()->translate('invalid-value');
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

        InputNumber::tag()->type('invalid-value');
    }
}
