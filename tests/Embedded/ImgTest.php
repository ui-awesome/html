<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use InvalidArgumentException;
use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Crossorigin,
    Data,
    Decoding,
    Direction,
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
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Img} `<img>` behavior.
 *
 * Verifies rendered output, attribute handling, and configuration precedence for {@see Img::tag()}.
 *
 * Test coverage.
 * - Applies global `aria-*` and `data-*` attributes via helper methods.
 * - Applies global defaults and theme providers via {@see SimpleFactory} and provider stubs.
 * - Applies image-specific attributes: `alt`, `src`, `srcset`, `sizes`, `width`, `height`, `loading`, `decoding`,
 *   `crossorigin`, `fetchpriority`, `referrerpolicy`, `ismap`, `usemap`, and `elementtiming`.
 * - Renders attributes and string casting for a void element.
 * - Validates enum-based attributes with proper exception handling.
 *
 * @link Img
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('embedded')]
final class ImgTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Img::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Img::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <img accesskey="k">
            HTML,
            Img::tag()->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <img aria-pressed="true">
            HTML,
            Img::tag()->addAriaAttribute('pressed', true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img aria-pressed="true">
            HTML,
            Img::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <img data-test="value">
            HTML,
            Img::tag()->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img title="value">
            HTML,
            Img::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <img data-value="value">
            HTML,
            Img::tag()->addDataAttribute('value', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img data-value="value">
            HTML,
            Img::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAlt(): void
    {
        self::assertSame(
            <<<HTML
            <img alt="A beautiful landscape">
            HTML,
            Img::tag()->alt('A beautiful landscape')->render(),
            "Failed asserting that element renders correctly with 'alt' attribute.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <img aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            HTML,
            Img::tag()->ariaAttributes(
                [
                    'controls' => static fn(): string => 'modal-1',
                    'hidden' => false,
                    'label' => 'Close',
                ],
            )
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <img class="value">
            HTML,
            Img::tag()->attributes(['class' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <img class="value">
            HTML,
            Img::tag()->class('value')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithCrossorigin(): void
    {
        self::assertSame(
            <<<HTML
            <img crossorigin="anonymous">
            HTML,
            Img::tag()->crossorigin('anonymous')->render(),
            "Failed asserting that element renders correctly with 'crossorigin' attribute.",
        );
    }

    public function testRenderWithCrossoriginUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img crossorigin="use-credentials">
            HTML,
            Img::tag()->crossorigin(Crossorigin::USE_CREDENTIALS)->render(),
            "Failed asserting that element renders correctly with 'crossorigin' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <img data-value="value">
            HTML,
            Img::tag()->dataAttributes(['value' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDecoding(): void
    {
        self::assertSame(
            <<<HTML
            <img decoding="async">
            HTML,
            Img::tag()->decoding('async')->render(),
            "Failed asserting that element renders correctly with 'decoding' attribute.",
        );
    }

    public function testRenderWithDecodingUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img decoding="sync">
            HTML,
            Img::tag()->decoding(Decoding::SYNC)->render(),
            "Failed asserting that element renders correctly with 'decoding' attribute using enum.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <img class="default-class">
            HTML,
            Img::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <img class="default-class" title="default-title">
            HTML,
            Img::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <img>
            HTML,
            Img::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <img dir="ltr">
            HTML,
            Img::tag()->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img dir="ltr">
            HTML,
            Img::tag()->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithElementtiming(): void
    {
        self::assertSame(
            <<<HTML
            <img elementtiming="hero-image">
            HTML,
            Img::tag()->elementtiming('hero-image')->render(),
            "Failed asserting that element renders correctly with 'elementtiming' attribute.",
        );
    }

    public function testRenderWithFetchpriority(): void
    {
        self::assertSame(
            <<<HTML
            <img fetchpriority="high">
            HTML,
            Img::tag()->fetchpriority('high')->render(),
            "Failed asserting that element renders correctly with 'fetchpriority' attribute.",
        );
    }

    public function testRenderWithFetchpriorityUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img fetchpriority="low">
            HTML,
            Img::tag()->fetchpriority(Fetchpriority::LOW)->render(),
            "Failed asserting that element renders correctly with 'fetchpriority' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Img::class, ['class' => 'default-class']);

        self::assertSame(
            '<img class="default-class">',
            Img::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Img::class, []);
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <img height="600">
            HTML,
            Img::tag()->height(600)->render(),
            "Failed asserting that element renders correctly with 'height' attribute.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <img hidden>
            HTML,
            Img::tag()->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <img id="test-id">
            HTML,
            Img::tag()->id('test-id')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithIsmap(): void
    {
        self::assertSame(
            <<<HTML
            <img ismap>
            HTML,
            Img::tag()->ismap(true)->render(),
            "Failed asserting that element renders correctly with 'ismap' attribute.",
        );
    }

    public function testRenderWithIsmapFalse(): void
    {
        self::assertSame(
            <<<HTML
            <img>
            HTML,
            Img::tag()->ismap(false)->render(),
            "Failed asserting that element renders correctly with 'ismap' attribute set to false.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <img lang="es">
            HTML,
            Img::tag()->lang('es')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img lang="es">
            HTML,
            Img::tag()->lang(Language::SPANISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithLoading(): void
    {
        self::assertSame(
            <<<HTML
            <img loading="lazy">
            HTML,
            Img::tag()->loading('lazy')->render(),
            "Failed asserting that element renders correctly with 'loading' attribute.",
        );
    }

    public function testRenderWithLoadingUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img loading="eager">
            HTML,
            Img::tag()->loading(Loading::EAGER)->render(),
            "Failed asserting that element renders correctly with 'loading' attribute using enum.",
        );
    }

    public function testRenderWithReferrerpolicy(): void
    {
        self::assertSame(
            <<<HTML
            <img referrerpolicy="no-referrer">
            HTML,
            Img::tag()->referrerpolicy('no-referrer')->render(),
            "Failed asserting that element renders correctly with 'referrerpolicy' attribute.",
        );
    }

    public function testRenderWithReferrerpolicyUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img referrerpolicy="origin">
            HTML,
            Img::tag()->referrerpolicy(Referrerpolicy::ORIGIN)->render(),
            "Failed asserting that element renders correctly with 'referrerpolicy' attribute using enum.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <img>
            HTML,
            Img::tag()
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
            <img>
            HTML,
            Img::tag()
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
            <img>
            HTML,
            Img::tag()
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
            <img role="banner">
            HTML,
            Img::tag()->role('banner')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img role="banner">
            HTML,
            Img::tag()->role(Role::BANNER)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSizes(): void
    {
        self::assertSame(
            <<<HTML
            <img sizes="(max-width: 600px) 100vw, 50vw">
            HTML,
            Img::tag()->sizes('(max-width: 600px) 100vw, 50vw')->render(),
            "Failed asserting that element renders correctly with 'sizes' attribute.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <img src="image.jpg">
            HTML,
            Img::tag()->src('image.jpg')->render(),
            "Failed asserting that element renders correctly with 'src' attribute.",
        );
    }

    public function testRenderWithSrcset(): void
    {
        self::assertSame(
            <<<HTML
            <img srcset="image-320w.jpg 320w, image-480w.jpg 480w">
            HTML,
            Img::tag()->srcset('image-320w.jpg 320w, image-480w.jpg 480w')->render(),
            "Failed asserting that element renders correctly with 'srcset' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <img style='value'>
            HTML,
            Img::tag()->style('value')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <img class="text-muted">
            HTML,
            Img::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <img title="value">
            HTML,
            Img::tag()->title('value')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<img>',
            LineEndingNormalizer::normalize(
                (string) Img::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <img translate="no">
            HTML,
            Img::tag()->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <img translate="no">
            HTML,
            Img::tag()->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUsemap(): void
    {
        self::assertSame(
            <<<HTML
            <img usemap="#map">
            HTML,
            Img::tag()->usemap('#map')->render(),
            "Failed asserting that element renders correctly with 'usemap' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Img::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <img class="from-global" id="id-user">
            HTML,
            Img::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Img::class, []);
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <img width="800">
            HTML,
            Img::tag()->width(800)->render(),
            "Failed asserting that element renders correctly with 'width' attribute.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $img = Img::tag();

        self::assertNotSame(
            $img,
            $img->alt(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->crossorigin(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->decoding(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->elementtiming(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->fetchpriority(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->height(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->ismap(true),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->loading(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->referrerpolicy(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->sizes(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->src(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->srcset(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->usemap(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $img,
            $img->width(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenInvalidCrossorigin(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Value 'invalid' is not in the list of valid values for 'crossorigin': 'anonymous', 'use-credentials'.",
        );

        Img::tag()->crossorigin('invalid')->render();
    }

    public function testThrowInvalidArgumentExceptionWhenInvalidDecoding(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Value 'invalid' is not in the list of valid values for 'decoding': 'async', 'auto', 'sync'.",
        );

        Img::tag()->decoding('invalid')->render();
    }

    public function testThrowInvalidArgumentExceptionWhenInvalidFetchpriority(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Value 'invalid' is not in the list of valid values for 'fetchpriority': 'auto', 'high', 'low'.",
        );

        Img::tag()->fetchpriority('invalid')->render();
    }

    public function testThrowInvalidArgumentExceptionWhenInvalidLoading(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Value 'invalid' is not in the list of valid values for 'loading': 'eager', 'lazy'.",
        );

        Img::tag()->loading('invalid')->render();
    }

    public function testThrowInvalidArgumentExceptionWhenInvalidReferrerpolicy(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Value 'invalid' is not in the list of valid values for 'referrerpolicy': "
            . "'no-referrer', 'no-referrer-when-downgrade', 'origin', 'origin-when-cross-origin', "
            . "'same-origin', 'strict-origin', 'strict-origin-when-cross-origin', 'unsafe-url'.",
        );

        Img::tag()->referrerpolicy('invalid')->render();
    }
}
