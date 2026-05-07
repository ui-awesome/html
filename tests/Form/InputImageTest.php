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
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputImage} class.
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
            'Default fallback must be returned.',
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
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" accesskey="value">
            HTML,
            InputImage::tag()
                ->accesskey('value')
                ->id('inputimage')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-label="value">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputimage')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-label="value">
            HTML,
            InputImage::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputimage')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" data-value="value">
            HTML,
            InputImage::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputimage')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" data-value="value">
            HTML,
            InputImage::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputimage')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputImage::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputimage')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAlt(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" alt="value">
            HTML,
            InputImage::tag()
                ->alt('value')
                ->id('inputimage')
                ->render(),
            "'alt' must be serialized.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" aria-controls="value" aria-label="value">
            HTML,
            InputImage::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputimage')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->attributes(['class' => 'value'])
                ->id('inputimage')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" autofocus>
            HTML,
            InputImage::tag()
                ->autofocus(true)
                ->id('inputimage')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->class('value')
                ->id('inputimage')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->class(BackedString::VALUE)
                ->id('inputimage')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" data-value="value">
            HTML,
            InputImage::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputimage')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputimage" type="image">
            HTML,
            InputImage::tag(['class' => 'default-class'])
                ->id('inputimage')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputimage" type="image" title="default-title">
            HTML,
            InputImage::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputimage')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" dir="ltr">
            HTML,
            InputImage::tag()
                ->dir('ltr')
                ->id('inputimage')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" dir="ltr">
            HTML,
            InputImage::tag()
                ->dir(Direction::LTR)
                ->id('inputimage')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" disabled>
            HTML,
            InputImage::tag()
                ->disabled(true)
                ->id('inputimage')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputImage::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputimage')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formaction="/submit">
            HTML,
            InputImage::tag()
                ->formaction('/submit')
                ->id('inputimage')
                ->render(),
            "'formaction' must be serialized.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formenctype="multipart/form-data">
            HTML,
            InputImage::tag()
                ->formenctype('multipart/form-data')
                ->id('inputimage')
                ->render(),
            "'formenctype' must be serialized.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formmethod="post">
            HTML,
            InputImage::tag()
                ->formmethod('post')
                ->id('inputimage')
                ->render(),
            "'formmethod' must be serialized.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formnovalidate>
            HTML,
            InputImage::tag()
                ->formnovalidate(true)
                ->id('inputimage')
                ->render(),
            "'formnovalidate' must be serialized.",
        );
    }

    public function testRenderWithFormtarget(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formtarget="_blank">
            HTML,
            InputImage::tag()
                ->formtarget('_blank')
                ->id('inputimage')
                ->render(),
            "'formtarget' must be serialized.",
        );
    }

    public function testRenderWithFormtargetUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formtarget="_blank">
            HTML,
            InputImage::tag()
                ->formtarget(Target::BLANK)
                ->id('inputimage')
                ->render(),
            "'formtarget' must be serialized.",
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
            'Factory defaults must be applied.',
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
            InputImage::tag()
                ->height(100)
                ->id('inputimage')
                ->render(),
            "'height' must be serialized.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" hidden>
            HTML,
            InputImage::tag()
                ->hidden(true)
                ->id('inputimage')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" lang="en">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" lang="en">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" name="value" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputimage')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->addAttribute('class', 'value')
                ->id('inputimage')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputimage')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputimage')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" role="button">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->role('button')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" role="button">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->role(Role::BUTTON)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" title="value">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" src="value">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" style='value'>
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" tabindex="1">
            HTML,
            InputImage::tag()
                ->id('inputimage')
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
            <input id="inputimage" type="image">
            </div>
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" title="value">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            (string) InputImage::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" translate="no">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" translate="no">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
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
            'User attributes must take precedence over factory defaults.',
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
            <input id="inputimage" type="image" width="100">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->width(100)->render(),
            "'width' must be serialized.",
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

        InputImage::tag()->dir('invalid-value');
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

        InputImage::tag()->lang('invalid-value');
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
                implode("', '", Enum::normalizeStringArray(Translate::cases())),
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
                implode("', '", Enum::normalizeStringArray(Type::cases())),
            ),
        );

        InputImage::tag()->type('invalid-value');
    }
}
