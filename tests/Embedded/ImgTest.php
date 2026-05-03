<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
    Crossorigin,
    Data,
    Decoding,
    Direction,
    ElementAttribute,
    Fetchpriority,
    GlobalAttribute,
    Language,
    Loading,
    Referrerpolicy,
    Role,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Embedded\Img;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Img} rendering and image attribute behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies image specific attributes (`alt`, `crossorigin`, `decoding`, `elementtiming`, `fetchpriority`, `height`,
 *   `ismap`, `loading`, `referrerpolicy`, `sizes`, `src`, `srcset`, `usemap`, `width`) and renders expected output.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Ensures fluent attribute setters return new instances (immutability).
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * {@see Img} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('embedded')]
final class ImgTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Img::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Img::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <img accesskey="value">
            HTML,
            Img::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <img aria-label="value">
            HTML,
            Img::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img aria-label="value">
            HTML,
            Img::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <img data-value="value">
            HTML,
            Img::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img data-value="value">
            HTML,
            Img::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <img onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            Img::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAlt(): void
    {
        self::assertSame(
            <<<HTML
            <img alt="value">
            HTML,
            Img::tag()
                ->alt('value')
                ->render(),
            "'alt' must be serialized.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <img aria-controls="value" aria-label="value">
            HTML,
            Img::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <img class="value">
            HTML,
            Img::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <img class="value">
            HTML,
            Img::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img class="value">
            HTML,
            Img::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithCrossorigin(): void
    {
        self::assertSame(
            <<<HTML
            <img crossorigin="anonymous">
            HTML,
            Img::tag()
                ->crossorigin('anonymous')
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithCrossoriginUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img crossorigin="use-credentials">
            HTML,
            Img::tag()
                ->crossorigin(Crossorigin::USE_CREDENTIALS)
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <img data-value="value">
            HTML,
            Img::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDecoding(): void
    {
        self::assertSame(
            <<<HTML
            <img decoding="async">
            HTML,
            Img::tag()
                ->decoding('async')
                ->render(),
            "'decoding' must be serialized.",
        );
    }

    public function testRenderWithDecodingUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img decoding="sync">
            HTML,
            Img::tag()
                ->decoding(Decoding::SYNC)
                ->render(),
            "'decoding' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <img class="default-class">
            HTML,
            Img::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <img class="default-class" title="default-title">
            HTML,
            Img::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <img>
            HTML,
            Img::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <img dir="ltr">
            HTML,
            Img::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img dir="ltr">
            HTML,
            Img::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithElementtiming(): void
    {
        self::assertSame(
            <<<HTML
            <img elementtiming="value">
            HTML,
            Img::tag()
                ->elementtiming('value')
                ->render(),
            "'elementtiming' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <img onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            Img::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithFetchpriority(): void
    {
        self::assertSame(
            <<<HTML
            <img fetchpriority="high">
            HTML,
            Img::tag()
                ->fetchpriority('high')
                ->render(),
            "'fetchpriority' must be serialized.",
        );
    }

    public function testRenderWithFetchpriorityUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img fetchpriority="low">
            HTML,
            Img::tag()
                ->fetchpriority(Fetchpriority::LOW)
                ->render(),
            "'fetchpriority' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Img::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            '<img class="default-class">',
            Img::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Img::class,
            [],
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <img height="600">
            HTML,
            Img::tag()
                ->height(600)
                ->render(),
            "'height' must be serialized.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <img hidden>
            HTML,
            Img::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <img id="value">
            HTML,
            Img::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithIsmap(): void
    {
        self::assertSame(
            <<<HTML
            <img ismap>
            HTML,
            Img::tag()
                ->ismap(true)
                ->render(),
            "'ismap' must be serialized.",
        );
    }

    public function testRenderWithIsmapFalse(): void
    {
        self::assertSame(
            <<<HTML
            <img>
            HTML,
            Img::tag()
                ->ismap(false)
                ->render(),
            'ismap must be omitted when `false`.',
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <img lang="en">
            HTML,
            Img::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img lang="en">
            HTML,
            Img::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLoading(): void
    {
        self::assertSame(
            <<<HTML
            <img loading="eager">
            HTML,
            Img::tag()
                ->loading('eager')
                ->render(),
            "'loading' must be serialized.",
        );
    }

    public function testRenderWithLoadingUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img loading="eager">
            HTML,
            Img::tag()
                ->loading(Loading::EAGER)
                ->render(),
            "'loading' must be serialized.",
        );
    }

    public function testRenderWithReferrerpolicy(): void
    {
        self::assertSame(
            <<<HTML
            <img referrerpolicy="no-referrer">
            HTML,
            Img::tag()
                ->referrerpolicy('no-referrer')
                ->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    public function testRenderWithReferrerpolicyUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img referrerpolicy="origin">
            HTML,
            Img::tag()
                ->referrerpolicy(Referrerpolicy::ORIGIN)
                ->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <img>
            HTML,
            Img::tag()
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
            <img>
            HTML,
            Img::tag()
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
            <img>
            HTML,
            Img::tag()
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
            <img>
            HTML,
            Img::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <img role="banner">
            HTML,
            Img::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img role="banner">
            HTML,
            Img::tag()
                ->role(Role::BANNER)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <img data-value="value">
            HTML,
            Img::tag()
                ->addAttribute('data-value', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img title="value">
            HTML,
            Img::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSizes(): void
    {
        self::assertSame(
            <<<HTML
            <img sizes="(max-width: 600px) 100vw, 50vw">
            HTML,
            Img::tag()
                ->sizes('(max-width: 600px) 100vw, 50vw')
                ->render(),
            "'sizes' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <img src="value">
            HTML,
            Img::tag()
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithSrcset(): void
    {
        self::assertSame(
            <<<HTML
            <img srcset="image-320w.jpg 320w, image-480w.jpg 480w">
            HTML,
            Img::tag()
                ->srcset('image-320w.jpg 320w, image-480w.jpg 480w')
                ->render(),
            "'srcset' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <img style='value'>
            HTML,
            Img::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <img class="text-muted">
            HTML,
            Img::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <img title="value">
            HTML,
            Img::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<img>',
            (string) Img::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <img translate="no">
            HTML,
            Img::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img translate="no">
            HTML,
            Img::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUsemap(): void
    {
        self::assertSame(
            <<<HTML
            <img usemap="#map">
            HTML,
            Img::tag()
                ->usemap('#map')
                ->render(),
            "'usemap' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Img::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <img class="from-global" id="value">
            HTML,
            Img::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Img::class,
            [],
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <img width="800">
            HTML,
            Img::tag()
                ->width(800)
                ->render(),
            "'width' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $img = Img::tag();

        self::assertNotSame(
            $img,
            $img->alt(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->crossorigin(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->decoding(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->elementtiming(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->fetchpriority(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->height(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->ismap(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->loading(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->referrerpolicy(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->sizes(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->srcset(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->usemap(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->width(null),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingCrossorigin(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::CROSSORIGIN->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Crossorigin::cases())),
            ),
        );

        Img::tag()->crossorigin('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDecoding(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                ElementAttribute::DECODING->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Decoding::cases())),
            ),
        );

        Img::tag()->decoding('invalid-value');
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

        Img::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingFetchpriority(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::FETCHPRIORITY->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Fetchpriority::cases())),
            ),
        );

        Img::tag()->fetchpriority('invalid-value');
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

        Img::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLoading(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                ElementAttribute::LOADING->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Loading::cases())),
            ),
        );

        Img::tag()->loading('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingReferrerpolicy(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::REFERRERPOLICY->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Referrerpolicy::cases())),
            ),
        );

        Img::tag()->referrerpolicy('invalid-value');
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

        Img::tag()->role('invalid-value');
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

        Img::tag()->translate('invalid-value');
    }
}
