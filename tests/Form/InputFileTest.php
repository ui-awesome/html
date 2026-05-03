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
    Translate,
    Type,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputFile;
use UIAwesome\Html\Form\Values\Capture;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for the {@see InputFile} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input file specific attributes (`accept`, `capture`, `multiple`, `required`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputFileTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputFile::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::FILE,
                'class' => 'value',
                'name' => '',
            ],
            InputFile::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccept(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" accept="image/*">
            HTML,
            InputFile::tag()
                ->accept('image/*')
                ->id('inputfile')
                ->render(),
            "'accept' must be serialized.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" accesskey="value">
            HTML,
            InputFile::tag()
                ->accesskey('value')
                ->id('inputfile')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-label="value">
            HTML,
            InputFile::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputfile')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-label="value">
            HTML,
            InputFile::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputfile')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" data-value="value">
            HTML,
            InputFile::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputfile')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" data-value="value">
            HTML,
            InputFile::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputfile')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputFile::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputfile')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-controls="value" aria-label="value">
            HTML,
            InputFile::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputfile')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->attributes(['class' => 'value'])
                ->id('inputfile')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" autofocus>
            HTML,
            InputFile::tag()
                ->autofocus(true)
                ->id('inputfile')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithCapture(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" capture="user">
            HTML,
            InputFile::tag()
                ->capture('user')
                ->id('inputfile')
                ->render(),
            "'capture' must be serialized.",
        );
    }

    public function testRenderWithCaptureUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" capture="environment">
            HTML,
            InputFile::tag()
                ->capture(Capture::ENVIRONMENT)
                ->id('inputfile')
                ->render(),
            "'capture' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="file-input" id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->class('file-input')
                ->id('inputfile')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->class(BackedString::VALUE)
                ->id('inputfile')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" data-value="value">
            HTML,
            InputFile::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputfile')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputfile" type="file">
            HTML,
            InputFile::tag(['class' => 'default-class'])
                ->id('inputfile')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputfile" type="file" title="default-title">
            HTML,
            InputFile::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputfile')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" dir="ltr">
            HTML,
            InputFile::tag()
                ->dir('ltr')
                ->id('inputfile')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" dir="ltr">
            HTML,
            InputFile::tag()
                ->dir(Direction::LTR)
                ->id('inputfile')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" disabled>
            HTML,
            InputFile::tag()
                ->disabled(true)
                ->id('inputfile')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputFile::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputfile')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" form="value">
            HTML,
            InputFile::tag()
                ->form('value')
                ->id('inputfile')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputFile::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(InputFile::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" hidden>
            HTML,
            InputFile::tag()
                ->hidden(true)
                ->id('inputfile')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" lang="en">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" lang="en">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMultiple(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" name="value[]" type="file" multiple>
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->multiple(true)
                ->name('value')
                ->render(),
            "'multiple' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" name="value" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputfile')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->addAttribute('class', 'value')
                ->id('inputfile')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputfile')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputfile')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" required>
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" role="textbox">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" role="textbox">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" title="value">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" tabindex="1">
            HTML,
            InputFile::tag()
                ->id('inputfile')
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
            <input id="inputfile" type="file">
            </div>
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputfile')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" title="value">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="file">
            HTML,
            (string) InputFile::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" translate="no">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" translate="no">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputFile::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="file">
            HTML,
            InputFile::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputFile::class,
            [],
        );
    }

    public function testRenderWithValueIsRemoved(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->addAttribute('value', 'value')
                ->id('inputfile')
                ->render(),
            'value attribute must be removed.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputFile = InputFile::tag();

        self::assertNotSame(
            $inputFile,
            $inputFile->capture(''),
            'New instance must be returned (immutability).',
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

        InputFile::tag()->dir('invalid-value');
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

        InputFile::tag()->lang('invalid-value');
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

        InputFile::tag()->role('invalid-value');
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

        InputFile::tag()->tabIndex(-2);
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

        InputFile::tag()->translate('invalid-value');
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

        InputFile::tag()->type('invalid-value');
    }
}
