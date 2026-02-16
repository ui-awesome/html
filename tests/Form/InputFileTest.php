<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputFile;
use UIAwesome\Html\Form\Values\Capture;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for the {@see InputFile} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Applies input-file-specific attributes (`accept`, `capture`, `multiple`, `required`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputFile} for the base implementation.
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
            'default',
            InputFile::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccept(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" name="inputfile" type="file" accept="image/*">
            HTML,
            InputFile::tag()
                ->accept('image/*')
                ->id('inputfile')
                ->name('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'accept' attribute.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" accesskey="k">
            HTML,
            InputFile::tag()
                ->accesskey('k')
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-label="File selector">
            HTML,
            InputFile::tag()
                ->addAriaAttribute('label', 'File selector')
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-hidden="true">
            HTML,
            InputFile::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" aria-describedby="custom-help">
            HTML,
            InputFile::tag()
                ->addAriaAttribute('describedby', 'custom-help')
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
            <input id="inputfile" type="file" data-file="value">
            HTML,
            InputFile::tag()
                ->addDataAttribute('file', 'value')
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" data-value="test">
            HTML,
            InputFile::tag()
                ->addDataAttribute(Data::VALUE, 'test')
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
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
            <input id="inputfile" type="file" aria-controls="file-picker" aria-label="Select a file">
            HTML,
            InputFile::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'file-picker',
                        'label' => 'Select a file',
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
            <input class="file-input" id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->attributes(['class' => 'file-input'])
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
            <input id="inputfile" name="inputfile" type="file" autofocus>
            HTML,
            InputFile::tag()
                ->autofocus(true)
                ->id('inputfile')
                ->name('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithCapture(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" name="inputfile" type="file" capture="user">
            HTML,
            InputFile::tag()
                ->capture('user')
                ->id('inputfile')
                ->name('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'capture' attribute.",
        );
    }

    public function testRenderWithCaptureUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" name="inputfile" type="file" capture="environment">
            HTML,
            InputFile::tag()
                ->capture(Capture::ENVIRONMENT)
                ->id('inputfile')
                ->name('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'capture' attribute using enum.",
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

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" data-week="value">
            HTML,
            InputFile::tag()
                ->dataAttributes(['week' => 'value'])
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
            <input class="default-class" id="inputfile" name="inputfile" type="file" title="default-title">
            HTML,
            InputFile::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputfile')
                ->name('inputfile')
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
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
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
            <input id="inputfile" name="inputfile" type="file" form="form-id">
            HTML,
            InputFile::tag()
                ->form('form-id')
                ->id('inputfile')
                ->name('inputfile')
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
            <input class="default-class" id="inputfile" name="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->name('inputfile')
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
            <input id="file-input" type="file">
            HTML,
            InputFile::tag()
                ->id('file-input')
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
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMultiple(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" name="inputfile[]" type="file" multiple>
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->multiple(true)
                ->name('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'multiple' attribute.",
        );
    }

    public function testRenderWithMultipleAndUnchecked(): void
    {
        self::assertSame(
            <<<HTML
            <input name="inputfile[]" type="hidden" value="0">
            <input id="inputfile" name="inputfile[]" type="file" multiple>
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->multiple(true)
                ->name('inputfile')
                ->uncheckedValue('0')
                ->render(),
            "Failed asserting that element renders correctly with 'multiple' attribute and unchecked value.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" name="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->name('inputfile')
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
                ->addAriaAttribute('label', 'Close')
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
                ->setAttribute('data-test', 'value')
                ->id('inputfile')
                ->removeAttribute('data-test')
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
                ->addDataAttribute('value', 'test')
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
            <input id="inputfile" name="inputfile" type="file" required>
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->name('inputfile')
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
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" data-test="value">
            HTML,
            InputFile::tag()
                ->setAttribute('data-test', 'value')
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" title="Select week">
            HTML,
            InputFile::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'Select week')
                ->id('inputfile')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method using enum.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" name="inputfile" type="file" tabindex="1">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->name('inputfile')
                ->tabIndex(1)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
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
            <input id="inputfile" type="file" title="Select a week">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->title('Select a week')
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
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUncheckedValue(): void
    {
        self::assertSame(
            <<<HTML
            <input name="inputfile" type="hidden" value="0">
            <input id="inputfile" name="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->name('inputfile')
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
            <input class="from-global" id="id-user" type="file">
            HTML,
            InputFile::tag(['id' => 'id-user'])->render(),
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
            <input id="inputfile" name="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->setAttribute('value', 'something')
                ->id('inputfile')
                ->name('inputfile')
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
