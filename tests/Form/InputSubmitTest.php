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
    Data,
    Direction,
    GlobalAttribute,
    Language,
    Role,
    Target,
    Translate,
    Type,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputSubmit;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputSubmit} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input submit specific attributes (`autofocus`, `form`, `formaction`, `formenctype`, `formmethod`,
 *   `formnovalidate`, `formtarget`, `name`, `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputSubmitTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputSubmit::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::SUBMIT,
                'class' => 'value',
            ],
            InputSubmit::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" accesskey="value">
            HTML,
            InputSubmit::tag()
                ->accesskey('value')
                ->id('inputsubmit')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-label="value">
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputsubmit')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-label="value">
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputsubmit')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" data-value="value">
            HTML,
            InputSubmit::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputsubmit')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" data-value="value">
            HTML,
            InputSubmit::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputsubmit')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputSubmit::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputsubmit')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-controls="value" aria-label="value">
            HTML,
            InputSubmit::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputsubmit')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->attributes(['class' => 'value'])
                ->id('inputsubmit')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" autofocus>
            HTML,
            InputSubmit::tag()
                ->autofocus(true)
                ->id('inputsubmit')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->class('value')
                ->id('inputsubmit')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->class(BackedString::VALUE)
                ->id('inputsubmit')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" data-value="value">
            HTML,
            InputSubmit::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputsubmit')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag(['class' => 'value'])
                ->id('inputsubmit')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsubmit" type="submit" title="default-title">
            HTML,
            InputSubmit::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputsubmit')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" dir="ltr">
            HTML,
            InputSubmit::tag()
                ->dir('ltr')
                ->id('inputsubmit')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" dir="ltr">
            HTML,
            InputSubmit::tag()
                ->dir(Direction::LTR)
                ->id('inputsubmit')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" disabled>
            HTML,
            InputSubmit::tag()
                ->disabled(true)
                ->id('inputsubmit')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputSubmit::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputsubmit')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" form="value">
            HTML,
            InputSubmit::tag()
                ->form('value')
                ->id('inputsubmit')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formaction="/submit-handler">
            HTML,
            InputSubmit::tag()
                ->formaction('/submit-handler')
                ->id('inputsubmit')
                ->render(),
            "'formaction' must be serialized.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formenctype="multipart/form-data">
            HTML,
            InputSubmit::tag()
                ->formenctype('multipart/form-data')
                ->id('inputsubmit')
                ->render(),
            "'formenctype' must be serialized.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formmethod="post">
            HTML,
            InputSubmit::tag()
                ->formmethod('post')
                ->id('inputsubmit')
                ->render(),
            "'formmethod' must be serialized.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formnovalidate>
            HTML,
            InputSubmit::tag()
                ->formnovalidate(true)
                ->id('inputsubmit')
                ->render(),
            "'formnovalidate' must be serialized.",
        );
    }

    public function testRenderWithFormnovalidateValueFalse(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->formnovalidate(false)
                ->id('inputsubmit')
                ->render(),
            'formnovalidate must be omitted when `false`.',
        );
    }

    public function testRenderWithFormnovalidateValueNull(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->formnovalidate(null)
                ->id('inputsubmit')
                ->render(),
            'formnovalidate must be omitted when `null`.',
        );
    }

    public function testRenderWithFormtarget(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formtarget="_blank">
            HTML,
            InputSubmit::tag()
                ->formtarget('_blank')
                ->id('inputsubmit')
                ->render(),
            "'formtarget' must be serialized.",
        );
    }

    public function testRenderWithFormtargetUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formtarget="_blank">
            HTML,
            InputSubmit::tag()
                ->formtarget(Target::BLANK)
                ->id('inputsubmit')
                ->render(),
            "'formtarget' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputSubmit::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputSubmit::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" hidden>
            HTML,
            InputSubmit::tag()
                ->hidden(true)
                ->id('inputsubmit')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" lang="en">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" lang="en">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" name="value" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputsubmit')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->addAttribute('class', 'value')
                ->id('inputsubmit')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputsubmit')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputsubmit')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" role="button">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->role('button')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" role="button">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->role(Role::BUTTON)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" title="value">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" style='value'>
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" tabindex="1">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
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
            <input id="inputsubmit" type="submit">
            </div>
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputsubmit')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" title="value">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="submit">
            HTML,
            (string) InputSubmit::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" translate="no">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" translate="no">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputSubmit::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="submit">
            HTML,
            InputSubmit::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputSubmit::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" value="value">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
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

        InputSubmit::tag()->dir('invalid-value');
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

        InputSubmit::tag()->lang('invalid-value');
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

        InputSubmit::tag()->role('invalid-value');
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

        InputSubmit::tag()->tabIndex(-2);
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

        InputSubmit::tag()->translate('invalid-value');
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

        InputSubmit::tag()->type('invalid-value');
    }
}
