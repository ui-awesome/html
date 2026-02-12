<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputImage;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for the {@see InputImage} class.
 *
 * Test coverage.
 *
 * - Applies input-image-specific attributes (`alt`, `formaction`, `formenctype`, `formmethod`, `formnovalidate`,
 *   `formtarget`, `height`, `src`, `width`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputImage} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputImageTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputImage::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" accesskey="k">
            HTML,
            InputImage::tag()->id('inputimage')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-label="Image button">
            HTML,
            InputImage::tag()->id('inputimage')->addAriaAttribute('label', 'Image button')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-hidden="true">
            HTML,
            InputImage::tag()->id('inputimage')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-describedby="custom-help">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputimage')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-describedby="inputimage-help">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputimage')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('describedby', true)
                ->id(null)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and 'id'"
            . "is 'null'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputimage" type="image" aria-describedby="inputimage-help">
            <span>Suffix</span>
            HTML,
            InputImage::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputimage')
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
            <input id="inputimage" type="image" aria-describedby="inputimage-help">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputimage')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputimage" type="image" aria-describedby="inputimage-help">
            <span>Suffix</span>
            HTML,
            InputImage::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputimage')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" data-test="value">
            HTML,
            InputImage::tag()->id('inputimage')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" title="Select image">
            HTML,
            InputImage::tag()->id('inputimage')->addAttribute(GlobalAttribute::TITLE, 'Select image')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" data-url="value">
            HTML,
            InputImage::tag()->id('inputimage')->addDataAttribute('url', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" data-value="test">
            HTML,
            InputImage::tag()->id('inputimage')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAlt(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" alt="Login">
            HTML,
            InputImage::tag()->id('inputimage')->alt('Login')->render(),
            "Failed asserting that element renders correctly with 'alt' attribute.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-controls="image-picker" aria-label="Select a image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->ariaAttributes([
                    'controls' => 'image-picker',
                    'label' => 'Select a image',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-describedby="inputimage-help">
            HTML,
            InputImage::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputimage')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-describedby="inputimage-help">
            HTML,
            InputImage::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputimage')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="image-input" id="inputimage" type="image">
            HTML,
            InputImage::tag()->id('inputimage')->attributes(['class' => 'image-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-describedby="inputimage-help">
            HTML,
            InputImage::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputimage')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-describedby="inputimage-help">
            HTML,
            InputImage::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputimage')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" autofocus>
            HTML,
            InputImage::tag()->autofocus(true)->id('inputimage')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="image-input" id="inputimage" type="image">
            HTML,
            InputImage::tag()->id('inputimage')->class('image-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" data-url="value">
            HTML,
            InputImage::tag()->id('inputimage')->dataAttributes(['url' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputimage" type="image">
            HTML,
            InputImage::tag(['class' => 'default-class'])->id('inputimage')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputimage" type="image" title="default-title">
            HTML,
            InputImage::tag()->id('inputimage')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()->id('inputimage')->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" dir="ltr">
            HTML,
            InputImage::tag()->id('inputimage')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" dir="ltr">
            HTML,
            InputImage::tag()->id('inputimage')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" disabled>
            HTML,
            InputImage::tag()->id('inputimage')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formaction="/submit">
            HTML,
            InputImage::tag()->id('inputimage')->formaction('/submit')->render(),
            "Failed asserting that element renders correctly with 'formaction' attribute.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formenctype="multipart/form-data">
            HTML,
            InputImage::tag()->id('inputimage')->formenctype('multipart/form-data')->render(),
            "Failed asserting that element renders correctly with 'formenctype' attribute.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formmethod="post">
            HTML,
            InputImage::tag()->id('inputimage')->formmethod('post')->render(),
            "Failed asserting that element renders correctly with 'formmethod' attribute.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formnovalidate>
            HTML,
            InputImage::tag()->id('inputimage')->formnovalidate(true)->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' attribute.",
        );
    }

    public function testRenderWithFormtarget(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formtarget="_blank">
            HTML,
            InputImage::tag()->id('inputimage')->formtarget('_blank')->render(),
            "Failed asserting that element renders correctly with 'formtarget' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputImage::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputimage-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputImage::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputImage::class,
            [],
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" height="100">
            HTML,
            InputImage::tag()->id('inputimage')->height(100)->render(),
            "Failed asserting that element renders correctly with 'height' attribute.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" hidden>
            HTML,
            InputImage::tag()->id('inputimage')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="image-input" type="image">
            HTML,
            InputImage::tag()->id('image-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" lang="en">
            HTML,
            InputImage::tag()->id('inputimage')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" lang="en">
            HTML,
            InputImage::tag()->id('inputimage')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" name="login" type="image">
            HTML,
            InputImage::tag()->id('inputimage')->name('login')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->addAriaAttribute('label', 'Close')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->addAttribute('data-test', 'value')
                ->removeAttribute('data-test')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->addDataAttribute('value', 'test')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" role="button">
            HTML,
            InputImage::tag()->id('inputimage')->role('button')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" role="button">
            HTML,
            InputImage::tag()->id('inputimage')->role(Role::BUTTON)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" src="/images/login.png">
            HTML,
            InputImage::tag()->id('inputimage')->src('/images/login.png')->render(),
            "Failed asserting that element renders correctly with 'src' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" style='width: 200px;'>
            HTML,
            InputImage::tag()->id('inputimage')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" tabindex="1">
            HTML,
            InputImage::tag()->id('inputimage')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputimage" type="image">
            HTML,
            InputImage::tag()->id('inputimage')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" title="Select a image">
            HTML,
            InputImage::tag()->id('inputimage')->title('Select a image')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            (string) InputImage::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" translate="no">
            HTML,
            InputImage::tag()->id('inputimage')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" translate="no">
            HTML,
            InputImage::tag()->id('inputimage')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputImage::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <input class="from-global" id="id-user" type="image">
            HTML,
            InputImage::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(InputImage::class, []);
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" width="100">
            HTML,
            InputImage::tag()->id('inputimage')->width(100)->render(),
            "Failed asserting that element renders correctly with 'width' attribute.",
        );
    }
}
