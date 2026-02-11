<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Data,
    Direction,
    GlobalAttribute,
    Language,
    Role,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Meta;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Meta} rendering and meta attribute behavior.
 *
 * Test coverage.
 * - Applies `meta`-specific attributes (`charset`, `content`, `http-equiv`, `media`, `name`) and renders expected
 *   output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('metadata')]
final class MetaTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Meta::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Meta::tag()
                ->addAttribute('data-test', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <meta accesskey="k">
            HTML,
            Meta::tag()
                ->accesskey('k')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <meta aria-label="Meta tag">
            HTML,
            Meta::tag()
                ->addAriaAttribute('label', 'Meta tag')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <meta aria-hidden="true">
            HTML,
            Meta::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <meta data-test="value">
            HTML,
            Meta::tag()
                ->addAttribute('data-test', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <meta title="Meta tag">
            HTML,
            Meta::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'Meta tag')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <meta data-value="value">
            HTML,
            Meta::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <meta data-value="value">
            HTML,
            Meta::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <meta aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            HTML,
            Meta::tag()
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
            <meta class="value">
            HTML,
            Meta::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithCharset(): void
    {
        self::assertSame(
            <<<HTML
            <meta charset="utf-8">
            HTML,
            Meta::tag()
                ->charset('utf-8')
                ->render(),
            "Failed asserting that element renders correctly with 'charset' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <meta class="value">
            HTML,
            Meta::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <meta content="width=device-width, initial-scale=1">
            HTML,
            Meta::tag()
                ->content('width=device-width, initial-scale=1')
                ->render(),
            "Failed asserting that element renders correctly with 'content' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <meta data-value="value">
            HTML,
            Meta::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <meta class="default-class">
            HTML,
            Meta::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <meta class="default-class" title="default-title">
            HTML,
            Meta::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <meta>
            HTML,
            Meta::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDescription(): void
    {
        self::assertSame(
            <<<HTML
            <meta name="description" content="A description of the page">
            HTML,
            Meta::tag()
                ->name('description')
                ->content('A description of the page')
                ->render(),
            'Failed asserting that element renders correctly with description metadata.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <meta dir="ltr">
            HTML,
            Meta::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <meta dir="ltr">
            HTML,
            Meta::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Meta::class, ['class' => 'default-class']);

        self::assertSame(
            '<meta class="default-class">',
            Meta::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Meta::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <meta hidden>
            HTML,
            Meta::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithHttpEquiv(): void
    {
        self::assertSame(
            <<<HTML
            <meta http-equiv="refresh" content="3;url=https://example.com">
            HTML,
            Meta::tag()
                ->content('3;url=https://example.com')
                ->httpEquiv('refresh')
                ->render(),
            "Failed asserting that element renders correctly with 'http-equiv' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <meta id="test-id">
            HTML,
            Meta::tag()
                ->id('test-id')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <meta lang="es">
            HTML,
            Meta::tag()
                ->lang('es')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <meta lang="es">
            HTML,
            Meta::tag()
                ->lang(Language::SPANISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMedia(): void
    {
        self::assertSame(
            <<<HTML
            <meta media="screen">
            HTML,
            Meta::tag()
                ->media('screen')
                ->render(),
            "Failed asserting that element renders correctly with 'media' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <meta name="viewport">
            HTML,
            Meta::tag()
                ->name('viewport')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithNameAndContent(): void
    {
        self::assertSame(
            <<<HTML
            <meta name="viewport" content="width=device-width, initial-scale=1">
            HTML,
            Meta::tag()
                ->content('width=device-width, initial-scale=1')
                ->name('viewport')
                ->render(),
            "Failed asserting that element renders correctly with 'name' and 'content' attributes.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <meta>
            HTML,
            Meta::tag()
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
            <meta>
            HTML,
            Meta::tag()
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
            <meta>
            HTML,
            Meta::tag()
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
            <meta role="banner">
            HTML,
            Meta::tag()->role('banner')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <meta role="banner">
            HTML,
            Meta::tag()
                ->role(Role::BANNER)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <meta style='value'>
            HTML,
            Meta::tag()
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <meta class="text-muted">
            HTML,
            Meta::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <meta title="value">
            HTML,
            Meta::tag()
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<meta>',
            (string) Meta::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <meta translate="no">
            HTML,
            Meta::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <meta translate="no">
            HTML,
            Meta::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Meta::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <meta class="from-global" id="id-user">
            HTML,
            Meta::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Meta::class, []);
    }

    public function testRenderWithViewport(): void
    {
        self::assertSame(
            <<<HTML
            <meta name="viewport" content="width=device-width, initial-scale=1">
            HTML,
            Meta::tag()
                ->content('width=device-width, initial-scale=1')
                ->name('viewport')
                ->render(),
            'Failed asserting that element renders correctly with viewport metadata.',
        );
    }

    public function testThrowInvalidArgumentExceptionForSettingHttpEquiv(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'http-equiv',
                implode("', '", Enum::normalizeArray(\UIAwesome\Html\Attribute\Values\HttpEquiv::cases())),
            ),
        );

        Meta::tag()->httpEquiv('invalid-value');
    }
}
