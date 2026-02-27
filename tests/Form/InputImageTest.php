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
use UIAwesome\Html\Form\InputImage;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for the {@see InputImage} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input image specific attributes (`alt`, `formaction`, `formenctype`, `formmethod`, `formnovalidate`,
 *   `formtarget`, `height`, `src`, `width`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
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
            'value',
            InputImage::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::IMAGE,
                'class' => 'value',
            ],
            InputImage::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" accesskey="value">
            HTML,
            InputImage::tag()
                ->accesskey('value')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" aria-label="value">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" aria-label="value">
            HTML,
            InputImage::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" aria-describedby="value">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('describedby', 'value')
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
            . " is 'null'.",
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

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" data-value="value">
            HTML,
            InputImage::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" data-value="value">
            HTML,
            InputImage::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputImage::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAlt(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" alt="value">
            HTML,
            InputImage::tag()
                ->alt('value')
                ->render(),
            "Failed asserting that element renders correctly with 'alt' attribute.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" aria-controls="value" aria-label="value">
            HTML,
            InputImage::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
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

    public function testRenderWithAriaDescribedByCustomSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-describedby="inputimage-value">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('describedby', true)
                ->ariaDescribedBySuffix('value')
                ->id('inputimage')
                ->render(),
            "Failed asserting that 'ariaDescribedBySuffix()' correctly applies the custom suffix.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="image">
            HTML,
            InputImage::tag()
                ->attributes(['class' => 'value'])
                ->render(),
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
            <input type="image" autofocus>
            HTML,
            InputImage::tag()
                ->autofocus(true)
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="image">
            HTML,
            InputImage::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="image">
            HTML,
            InputImage::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" data-value="value">
            HTML,
            InputImage::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" type="image">
            HTML,
            InputImage::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" type="image" title="default-title">
            HTML,
            InputImage::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            InputImage::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" dir="ltr">
            HTML,
            InputImage::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" dir="ltr">
            HTML,
            InputImage::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" disabled>
            HTML,
            InputImage::tag()
                ->disabled(true)
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputImage::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" formaction="/submit">
            HTML,
            InputImage::tag()
                ->formaction('/submit')
                ->render(),
            "Failed asserting that element renders correctly with 'formaction' attribute.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" formenctype="multipart/form-data">
            HTML,
            InputImage::tag()
                ->formenctype('multipart/form-data')
                ->render(),
            "Failed asserting that element renders correctly with 'formenctype' attribute.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" formmethod="post">
            HTML,
            InputImage::tag()
                ->formmethod('post')
                ->render(),
            "Failed asserting that element renders correctly with 'formmethod' attribute.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" formnovalidate>
            HTML,
            InputImage::tag()
                ->formnovalidate(true)
                ->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' attribute.",
        );
    }

    public function testRenderWithFormtarget(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" formtarget="_blank">
            HTML,
            InputImage::tag()
                ->formtarget('_blank')
                ->render(),
            "Failed asserting that element renders correctly with 'formtarget' attribute.",
        );
    }

    public function testRenderWithFormtargetUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" formtarget="_blank">
            HTML,
            InputImage::tag()
                ->formtarget(Target::BLANK)
                ->render(),
            "Failed asserting that element renders correctly with 'formtarget' attribute.",
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
            <input class="default-class" type="image">
            HTML,
            InputImage::tag()->render(),
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
            <input type="image" height="100">
            HTML,
            InputImage::tag()
                ->height(100)
                ->render(),
            "Failed asserting that element renders correctly with 'height' attribute.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" hidden>
            HTML,
            InputImage::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="value" type="image">
            HTML,
            InputImage::tag()
                ->id('value')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" lang="en">
            HTML,
            InputImage::tag()
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" lang="en">
            HTML,
            InputImage::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input name="value" type="image">
            HTML,
            InputImage::tag()
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('label', 'value')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            InputImage::tag()
                ->setAttribute('class', 'value')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            InputImage::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            InputImage::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" role="button">
            HTML,
            InputImage::tag()
                ->role('button')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" role="button">
            HTML,
            InputImage::tag()
                ->role(Role::BUTTON)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="image">
            HTML,
            InputImage::tag()
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" title="value">
            HTML,
            InputImage::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" src="value">
            HTML,
            InputImage::tag()
                ->src('value')
                ->render(),
            "Failed asserting that element renders correctly with 'src' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" style='value'>
            HTML,
            InputImage::tag()
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" tabindex="1">
            HTML,
            InputImage::tag()
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
            <input type="image">
            </div>
            HTML,
            InputImage::tag()
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with a custom template wrapper.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" type="image">
            HTML,
            InputImage::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" title="value">
            HTML,
            InputImage::tag()
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            (string) InputImage::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" translate="no">
            HTML,
            InputImage::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" translate="no">
            HTML,
            InputImage::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputImage::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="image">
            HTML,
            InputImage::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputImage::class,
            [],
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image" width="100">
            HTML,
            InputImage::tag()
                ->width(100)
                ->render(),
            "Failed asserting that element renders correctly with 'width' attribute.",
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDir(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DIR->value,
                implode("', '", Enum::normalizeArray(Direction::cases())),
            ),
        );

        InputImage::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLang(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::LANG->value,
                implode("', '", Enum::normalizeArray(Language::cases())),
            ),
        );

        InputImage::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::ROLE->value,
                implode("', '", Enum::normalizeArray(Role::cases())),
            ),
        );

        InputImage::tag()->role('invalid-value');
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

        InputImage::tag()->tabIndex(-2);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTranslate(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::TRANSLATE->value,
                implode("', '", Enum::normalizeArray(Translate::cases())),
            ),
        );

        InputImage::tag()->translate('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TYPE->value,
                implode("', '", Enum::normalizeArray(Type::cases())),
            ),
        );

        InputImage::tag()->type('invalid-value');
    }
}
