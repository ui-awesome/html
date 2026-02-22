<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    AsValue,
    Attribute,
    Blocking,
    Crossorigin,
    Data,
    Direction,
    Fetchpriority,
    GlobalAttribute,
    Language,
    Referrerpolicy,
    Rel,
    Role,
    Translate,
    Type,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Link;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Link} rendering and link attribute behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies link specific attributes (`as`, `crossorigin`, `disabled`, `fetchpriority`, `href`, `hreflang`,
 *   `imagesizes`, `imagesrcset`, `integrity`, `media`, `referrerpolicy`, `rel`, `sizes`, `title`, `type`) and renders
 *   expected output.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('metadata')]
final class LinkTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Link::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Link::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <link accesskey="value">
            HTML,
            Link::tag()
                ->accesskey('value')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <link aria-label="value">
            HTML,
            Link::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link aria-label="value">
            HTML,
            Link::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <link data-value="value">
            HTML,
            Link::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link data-value="value">
            HTML,
            Link::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <link onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            Link::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <link aria-controls="value" aria-label="value">
            HTML,
            Link::tag()
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

    public function testRenderWithAs(): void
    {
        self::assertSame(
            <<<HTML
            <link as="style">
            HTML,
            Link::tag()
                ->as('style')
                ->render(),
            "Failed asserting that element renders correctly with 'as' attribute.",
        );
    }

    public function testRenderWithAsUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link as="style">
            HTML,
            Link::tag()
                ->as(AsValue::STYLE)
                ->render(),
            "Failed asserting that element renders correctly with 'as' attribute.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <link class="value">
            HTML,
            Link::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithBlocking(): void
    {
        self::assertSame(
            <<<HTML
            <link blocking="render">
            HTML,
            Link::tag()
                ->blocking('render')
                ->render(),
            "Failed asserting that element renders correctly with 'blocking' attribute.",
        );
    }

    public function testRenderWithBlockingUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link blocking="render">
            HTML,
            Link::tag()
                ->blocking(Blocking::RENDER)
                ->render(),
            "Failed asserting that element renders correctly with 'blocking' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <link class="value">
            HTML,
            Link::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithCrossorigin(): void
    {
        self::assertSame(
            <<<HTML
            <link crossorigin="anonymous">
            HTML,
            Link::tag()
                ->crossorigin('anonymous')
                ->render(),
            "Failed asserting that element renders correctly with 'crossorigin' attribute.",
        );
    }

    public function testRenderWithCrossoriginUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link crossorigin="anonymous">
            HTML,
            Link::tag()
                ->crossorigin(Crossorigin::ANONYMOUS)
                ->render(),
            "Failed asserting that element renders correctly with 'crossorigin' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <link data-value="value">
            HTML,
            Link::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <link class="default-class">
            HTML,
            Link::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <link class="default-class" title="default-title">
            HTML,
            Link::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <link>
            HTML,
            Link::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <link dir="ltr">
            HTML,
            Link::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link dir="ltr">
            HTML,
            Link::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <link disabled>
            HTML,
            Link::tag()
                ->disabled(true)
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <link onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            Link::tag()
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

    public function testRenderWithFetchpriority(): void
    {
        self::assertSame(
            <<<HTML
            <link fetchpriority="high">
            HTML,
            Link::tag()
                ->fetchpriority('high')
                ->render(),
            "Failed asserting that element renders correctly with 'fetchpriority' attribute.",
        );
    }

    public function testRenderWithFetchpriorityUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link fetchpriority="high">
            HTML,
            Link::tag()
                ->fetchpriority(Fetchpriority::HIGH)
                ->render(),
            "Failed asserting that element renders correctly with 'fetchpriority' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Link::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            '<link class="default-class">',
            Link::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            Link::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <link hidden>
            HTML,
            Link::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithHref(): void
    {
        self::assertSame(
            <<<HTML
            <link href="value">
            HTML,
            Link::tag()
                ->href('value')
                ->render(),
            "Failed asserting that element renders correctly with 'href' attribute.",
        );
    }

    public function testRenderWithHreflang(): void
    {
        self::assertSame(
            <<<HTML
            <link hreflang="en">
            HTML,
            Link::tag()
                ->hreflang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'hreflang' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <link id="value">
            HTML,
            Link::tag()
                ->id('value')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithImagesizes(): void
    {
        self::assertSame(
            <<<HTML
            <link imagesizes="100vw">
            HTML,
            Link::tag()
                ->imagesizes('100vw')
                ->render(),
            "Failed asserting that element renders correctly with 'imagesizes' attribute.",
        );
    }

    public function testRenderWithImagesrcset(): void
    {
        self::assertSame(
            <<<HTML
            <link imagesrcset="image-480.jpg 480w, image-800.jpg 800w">
            HTML,
            Link::tag()
                ->imagesrcset('image-480.jpg 480w, image-800.jpg 800w')
                ->render(),
            "Failed asserting that element renders correctly with 'imagesrcset' attribute.",
        );
    }

    public function testRenderWithIntegrity(): void
    {
        self::assertSame(
            <<<HTML
            <link integrity="value">
            HTML,
            Link::tag()
                ->integrity('value')
                ->render(),
            "Failed asserting that element renders correctly with 'integrity' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <link lang="en">
            HTML,
            Link::tag()
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link lang="en">
            HTML,
            Link::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithMedia(): void
    {
        self::assertSame(
            <<<HTML
            <link media="screen and (min-width: 768px)">
            HTML,
            Link::tag()
                ->media('screen and (min-width: 768px)')
                ->render(),
            "Failed asserting that element renders correctly with 'media' attribute.",
        );
    }

    public function testRenderWithReferrerpolicy(): void
    {
        self::assertSame(
            <<<HTML
            <link referrerpolicy="no-referrer">
            HTML,
            Link::tag()
                ->referrerpolicy('no-referrer')
                ->render(),
            "Failed asserting that element renders correctly with 'referrerpolicy' attribute.",
        );
    }

    public function testRenderWithReferrerpolicyUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link referrerpolicy="no-referrer">
            HTML,
            Link::tag()
                ->referrerpolicy(Referrerpolicy::NO_REFERRER)
                ->render(),
            "Failed asserting that element renders correctly with 'referrerpolicy' attribute.",
        );
    }

    public function testRenderWithRel(): void
    {
        self::assertSame(
            <<<HTML
            <link rel="stylesheet">
            HTML,
            Link::tag()
                ->rel('stylesheet')
                ->render(),
            "Failed asserting that element renders correctly with 'rel' attribute.",
        );
    }

    public function testRenderWithRelUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link rel="stylesheet">
            HTML,
            Link::tag()
                ->rel(Rel::STYLESHEET)
                ->render(),
            "Failed asserting that element renders correctly with 'rel' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <link>
            HTML,
            Link::tag()
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
            <link>
            HTML,
            Link::tag()
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
            <link>
            HTML,
            Link::tag()
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
            <link>
            HTML,
            Link::tag()
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
            <link role="banner">
            HTML,
            Link::tag()
                ->role('banner')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link role="banner">
            HTML,
            Link::tag()
                ->role(Role::BANNER)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <link class="value">
            HTML,
            Link::tag()
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link title="value">
            HTML,
            Link::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSizes(): void
    {
        self::assertSame(
            <<<HTML
            <link sizes="16x16">
            HTML,
            Link::tag()
                ->sizes('16x16')
                ->render(),
            "Failed asserting that element renders correctly with 'sizes' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <link style='value'>
            HTML,
            Link::tag()
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <link class="text-muted">
            HTML,
            Link::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <link title="value">
            HTML,
            Link::tag()
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<link>',
            (string) Link::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <link translate="no">
            HTML,
            Link::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link translate="no">
            HTML,
            Link::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithType(): void
    {
        self::assertSame(
            <<<HTML
            <link type="text/css">
            HTML,
            Link::tag()
                ->type('text/css')
                ->render(),
            "Failed asserting that element renders correctly with 'type' attribute.",
        );
    }

    public function testRenderWithTypeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link type="text/css">
            HTML,
            Link::tag()
                ->type(Type::TEXT_CSS)
                ->render(),
            "Failed asserting that element renders correctly with 'type' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Link::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <link class="from-global" id="value">
            HTML,
            Link::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            Link::class,
            [],
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingBlocking(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::BLOCKING->value,
                implode("', '", Enum::normalizeArray(Blocking::cases())),
            ),
        );

        Link::tag()->blocking('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingCrossorigin(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::CROSSORIGIN->value,
                implode("', '", Enum::normalizeArray(Crossorigin::cases())),
            ),
        );

        Link::tag()->crossorigin('invalid-value');
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

        Link::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingFetchpriority(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::FETCHPRIORITY->value,
                implode("', '", Enum::normalizeArray(Fetchpriority::cases())),
            ),
        );

        Link::tag()->fetchpriority('invalid-value');
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

        Link::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingReferrerpolicy(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::REFERRERPOLICY->value,
                implode("', '", Enum::normalizeArray(Referrerpolicy::cases())),
            ),
        );

        Link::tag()->referrerpolicy('invalid-value');
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

        Link::tag()->role('invalid-value');
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

        Link::tag()->translate('invalid-value');
    }
}
