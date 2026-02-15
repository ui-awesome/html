<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Palpable;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Data,
    Direction,
    GlobalAttribute,
    Language,
    Referrerpolicy,
    Rel,
    Role,
    Target,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Palpable\A;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see A} rendering and anchor attribute behavior.
 *
 * Test coverage.
 * - Applies anchor-specific attributes (`download`, `href`, `hreflang`, `ping`, `referrerpolicy`, `rel`, `target`,
 *   `type`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Ensures fluent attribute setters return new instances (immutability).
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see A} for implementation details.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('palpable')]
final class ATest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            A::tag()
                ->content('<value>')
                ->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            A::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            A::tag()
                ->setAttribute('data-test', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <a><value></a>
            HTML,
            A::tag()
                ->html('<value>')
                ->render(),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <a accesskey="k"></a>
            HTML,
            A::tag()
                ->accesskey('k')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <a aria-label="Link content"></a>
            HTML,
            A::tag()
                ->addAriaAttribute('label', 'Link content')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a aria-hidden="true"></a>
            HTML,
            A::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <a data-test="value"></a>
            HTML,
            A::tag()
                ->setAttribute('data-test', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a title="Link content"></a>
            HTML,
            A::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'Link content')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <a data-value="value"></a>
            HTML,
            A::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a data-value="value"></a>
            HTML,
            A::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <a aria-controls="modal-1" aria-hidden="false" aria-label="Close"></a>
            HTML,
            A::tag()
                ->ariaAttributes(
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
            <a class="value"></a>
            HTML,
            A::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <a class="value"></a>
            HTML,
            A::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <a>value</a>
            HTML,
            A::tag()
                ->content('value')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <a data-value="value"></a>
            HTML,
            A::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <a class="default-class"></a>
            HTML,
            A::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <a class="default-class" title="default-title"></a>
            HTML,
            A::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            A::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <a dir="ltr"></a>
            HTML,
            A::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a dir="ltr"></a>
            HTML,
            A::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDownload(): void
    {
        self::assertSame(
            <<<HTML
            <a download></a>
            HTML,
            A::tag()
                ->download(true)
                ->render(),
            "Failed asserting that element renders correctly with 'download' attribute.",
        );
    }

    public function testRenderWithDownloadFilename(): void
    {
        self::assertSame(
            <<<HTML
            <a download="file.pdf"></a>
            HTML,
            A::tag()
                ->download('file.pdf')
                ->render(),
            "Failed asserting that element renders correctly with 'download' attribute and filename.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(A::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <a class="default-class"></a>
            HTML,
            A::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(A::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <a hidden></a>
            HTML,
            A::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithHref(): void
    {
        self::assertSame(
            <<<HTML
            <a href="https://example.com"></a>
            HTML,
            A::tag()
                ->href('https://example.com')
                ->render(),
            "Failed asserting that element renders correctly with 'href' attribute.",
        );
    }

    public function testRenderWithHreflang(): void
    {
        self::assertSame(
            <<<HTML
            <a hreflang="en"></a>
            HTML,
            A::tag()
                ->hreflang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'hreflang' attribute.",
        );
    }

    public function testRenderWithHreflangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a hreflang="es"></a>
            HTML,
            A::tag()
                ->hreflang(Language::SPANISH)
                ->render(),
            "Failed asserting that element renders correctly with 'hreflang' attribute using enum.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <a id="test-id"></a>
            HTML,
            A::tag()
                ->id('test-id')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <a lang="es"></a>
            HTML,
            A::tag()
                ->lang('es')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a lang="es"></a>
            HTML,
            A::tag()
                ->lang(Language::SPANISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithPing(): void
    {
        self::assertSame(
            <<<HTML
            <a ping="https://example.com/track"></a>
            HTML,
            A::tag()
                ->ping('https://example.com/track')
                ->render(),
            "Failed asserting that element renders correctly with 'ping' attribute.",
        );
    }

    public function testRenderWithReferrerpolicy(): void
    {
        self::assertSame(
            <<<HTML
            <a referrerpolicy="no-referrer"></a>
            HTML,
            A::tag()
                ->referrerpolicy('no-referrer')
                ->render(),
            "Failed asserting that element renders correctly with 'referrerpolicy' attribute.",
        );
    }

    public function testRenderWithReferrerpolicyUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a referrerpolicy="no-referrer"></a>
            HTML,
            A::tag()
                ->referrerpolicy(Referrerpolicy::NO_REFERRER)
                ->render(),
            "Failed asserting that element renders correctly with 'referrerpolicy' attribute using enum.",
        );
    }

    public function testRenderWithRel(): void
    {
        self::assertSame(
            <<<HTML
            <a rel="noopener"></a>
            HTML,
            A::tag()
                ->rel('noopener')
                ->render(),
            "Failed asserting that element renders correctly with 'rel' attribute.",
        );
    }

    public function testRenderWithRelUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a rel="noopener"></a>
            HTML,
            A::tag()
                ->rel(Rel::NOOPENER)
                ->render(),
            "Failed asserting that element renders correctly with 'rel' attribute using enum.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            A::tag()
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
            <a></a>
            HTML,
            A::tag()
                ->setAttribute('data-test', 'value')
                ->removeAttribute('data-test')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            A::tag()
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
            <a role="button"></a>
            HTML,
            A::tag()
                ->role('button')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a role="button"></a>
            HTML,
            A::tag()
                ->role(Role::BUTTON)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <a style='color: red;'></a>
            HTML,
            A::tag()
                ->style('color: red;')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTarget(): void
    {
        self::assertSame(
            <<<HTML
            <a target="_blank"></a>
            HTML,
            A::tag()
                ->target('_blank')
                ->render(),
            "Failed asserting that element renders correctly with 'target' attribute.",
        );
    }

    public function testRenderWithTargetUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a target="_blank"></a>
            HTML,
            A::tag()
                ->target(Target::BLANK)
                ->render(),
            "Failed asserting that element renders correctly with 'target' attribute using enum.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <a class="text-muted"></a>
            HTML,
            A::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <a title="value"></a>
            HTML,
            A::tag()
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            (string) A::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <a translate="no"></a>
            HTML,
            A::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a translate="no"></a>
            HTML,
            A::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithType(): void
    {
        self::assertSame(
            <<<HTML
            <a type="text/html"></a>
            HTML,
            A::tag()
                ->type('text/html')
                ->render(),
            "Failed asserting that element renders correctly with 'type' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(A::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <a class="from-global" id="id-user"></a>
            HTML,
            A::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(A::class, []);
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $a = A::tag();

        self::assertNotSame(
            $a,
            $a->download(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $a,
            $a->href(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $a,
            $a->hreflang(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $a,
            $a->ping(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $a,
            $a->referrerpolicy(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $a,
            $a->rel(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $a,
            $a->target(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $a,
            $a->type(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }
}
