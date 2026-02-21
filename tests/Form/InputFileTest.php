<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate, Type};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputFile;
use UIAwesome\Html\Form\Values\Capture;
use UIAwesome\Html\Interop\Inline;
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
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::FILE,
                'id' => null,
                'class' => 'value',
                'name' => '',
            ],
            InputFile::tag()
                ->id(null)
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
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
            "Failed asserting that element renders correctly with 'accept' attribute.",
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
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
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
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-describedby="value">
            HTML,
            InputFile::tag()
                ->addAriaAttribute('describedby', 'value')
                ->id('inputfile')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-describedby="inputfile-help">
            HTML,
            InputFile::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="file">
            HTML,
            InputFile::tag()
                ->addAriaAttribute('describedby', true)
                ->id(null)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and 'id'"
            . " is 'null'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputfile" type="file" aria-describedby="inputfile-help">
            <span>Suffix</span>
            HTML,
            InputFile::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputfile')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-describedby="inputfile-help">
            HTML,
            InputFile::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputfile" type="file" aria-describedby="inputfile-help">
            <span>Suffix</span>
            HTML,
            InputFile::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputfile')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
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
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addEvent()' method.",
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
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-describedby="inputfile-help">
            HTML,
            InputFile::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-describedby="inputfile-help">
            HTML,
            InputFile::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-describedby="inputfile-help">
            HTML,
            InputFile::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-describedby="inputfile-help">
            HTML,
            InputFile::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
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
            "Failed asserting that element renders correctly with 'capture' attribute.",
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
            "Failed asserting that element renders correctly with 'capture' attribute.",
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
            "Failed asserting that element renders correctly with 'class' attribute.",
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
            "Failed asserting that element renders correctly with 'class' attribute.",
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
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
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
            'Failed asserting that default configuration values are applied correctly.',
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
            'Failed asserting that default provider is applied correctly.',
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
            'Failed asserting that element renders correctly with default values.',
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
            "Failed asserting that element renders correctly with 'dir' attribute.",
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
            "Failed asserting that element renders correctly with 'dir' attribute.",
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
            "Failed asserting that element renders correctly with 'disabled' attribute.",
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
            "Failed asserting that element renders correctly with 'events()' method.",
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
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputFile::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputfile-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
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
            'Failed asserting that global defaults are applied correctly.',
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
            "Failed asserting that element renders correctly with 'hidden' attribute.",
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
            "Failed asserting that element renders correctly with 'id' attribute.",
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
            "Failed asserting that element renders correctly with 'lang' attribute.",
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
            "Failed asserting that element renders correctly with 'lang' attribute.",
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
            "Failed asserting that element renders correctly with 'multiple' attribute.",
        );
    }

    public function testRenderWithMultipleAndUnchecked(): void
    {
        self::assertSame(
            <<<HTML
            <input name="value[]" type="hidden" value="0">
            <input id="inputfile" name="value[]" type="file" multiple>
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->multiple(true)
                ->name('value')
                ->uncheckedValue('0')
                ->render(),
            "Failed asserting that element renders correctly with 'multiple' attribute and unchecked value.",
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
            "Failed asserting that element renders correctly with 'name' attribute.",
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
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->setAttribute('class', 'value')
                ->id('inputfile')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
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
            "Failed asserting that element renders correctly with 'required' attribute.",
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
            "Failed asserting that element renders correctly with 'role' attribute.",
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
            "Failed asserting that element renders correctly with 'role' attribute.",
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
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
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
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
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
            'Failed asserting that element renders correctly with a custom template wrapper.',
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
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
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
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="file">
            HTML,
            (string) InputFile::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
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
            "Failed asserting that element renders correctly with 'translate' attribute.",
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
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUncheckedValue(): void
    {
        self::assertSame(
            <<<HTML
            <input name="value" type="hidden" value="0">
            <input id="inputfile" name="value" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->name('value')
                ->uncheckedValue('0')
                ->render(),
            'Failed asserting that element renders correctly with unchecked value.',
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
            'Failed asserting that user-defined attributes override global defaults correctly.',
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
                ->setAttribute('value', 'value')
                ->id('inputfile')
                ->render(),
            "Failed asserting that 'value' attribute is removed.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputFile = InputFile::tag();

        self::assertNotSame(
            $inputFile,
            $inputFile->capture(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputFile,
            $inputFile->uncheckedValue(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }
}
