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
    ElementAttribute,
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
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Link::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
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
            "'accesskey' must be serialized.",
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
            'ARIA attribute must be added.',
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
            'ARIA attribute must be added.',
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
            'Data attribute must be added.',
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
            'Data attribute must be added.',
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
            'Event handler must be added.',
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
            'ARIA attribute map must be applied.',
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
            "'as' must be serialized.",
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
            "'as' must be serialized.",
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
            'Attribute map must be applied.',
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
            "'blocking' must be serialized.",
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
            "'blocking' must be serialized.",
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
            "'class' must be serialized.",
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
            "'crossorigin' must be serialized.",
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
            "'crossorigin' must be serialized.",
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
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <link class="default-class">
            HTML,
            Link::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
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
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <link>
            HTML,
            Link::tag()->render(),
            'Bare element must render with no attributes.',
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
            "'dir' must be serialized.",
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
            "'dir' must be serialized.",
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
            "'disabled' must be serialized.",
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
            'Event handler map must be applied.',
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
            "'fetchpriority' must be serialized.",
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
            "'fetchpriority' must be serialized.",
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
            'Factory defaults must be applied.',
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
            "'hidden' must be serialized.",
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
            "'href' must be serialized.",
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
            "'hreflang' must be serialized.",
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
            "'id' must be serialized.",
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
            "'imagesizes' must be serialized.",
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
            "'imagesrcset' must be serialized.",
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
            "'integrity' must be serialized.",
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
            "'lang' must be serialized.",
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
            "'lang' must be serialized.",
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
            "'media' must be serialized.",
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
            "'referrerpolicy' must be serialized.",
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
            "'referrerpolicy' must be serialized.",
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
            "'rel' must be serialized.",
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
            "'rel' must be serialized.",
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
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <link>
            HTML,
            Link::tag()
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
            <link>
            HTML,
            Link::tag()
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
            <link>
            HTML,
            Link::tag()
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
            <link role="banner">
            HTML,
            Link::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
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
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <link class="value">
            HTML,
            Link::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <link title="value">
            HTML,
            Link::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
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
            "'sizes' must be serialized.",
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
            "'style' must be serialized.",
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
            'Theme provider must contribute classes.',
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
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<link>',
            (string) Link::tag(),
            'Casting to string must produce HTML.',
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
            "'translate' must be serialized.",
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
            "'translate' must be serialized.",
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
            "'type' must be serialized.",
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
            "'type' must be serialized.",
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
            'User attributes must take precedence over factory defaults.',
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
                ElementAttribute::BLOCKING->value,
                implode("', '", Enum::normalizeStringArray(Blocking::cases())),
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
                implode("', '", Enum::normalizeStringArray(Crossorigin::cases())),
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
                implode("', '", Enum::normalizeStringArray(Direction::cases())),
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
                implode("', '", Enum::normalizeStringArray(Fetchpriority::cases())),
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
                implode("', '", Enum::normalizeStringArray(Language::cases())),
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
                implode("', '", Enum::normalizeStringArray(Referrerpolicy::cases())),
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
                implode("', '", Enum::normalizeStringArray(Role::cases())),
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
                implode("', '", Enum::normalizeStringArray(Translate::cases())),
            ),
        );

        Link::tag()->translate('invalid-value');
    }
}
