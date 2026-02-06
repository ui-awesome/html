<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Data,
    Direction,
    GlobalAttribute,
    Language,
    Role,
    Target,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Base;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Base} `<base>` behavior.
 *
 * Test coverage.
 * - Applies `base`-specific attributes (`href`, `target`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('metadata')]
final class BaseTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Base::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Base::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <base accesskey="k">
            HTML,
            Base::tag()->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <base aria-label="Base URL">
            HTML,
            Base::tag()->addAriaAttribute('label', 'Base URL')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base aria-hidden="true">
            HTML,
            Base::tag()->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <base data-test="value">
            HTML,
            Base::tag()->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base title="Base URL">
            HTML,
            Base::tag()->addAttribute(GlobalAttribute::TITLE, 'Base URL')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <base data-value="value">
            HTML,
            Base::tag()->addDataAttribute('value', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base data-value="value">
            HTML,
            Base::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <base aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            HTML,
            Base::tag()->ariaAttributes(
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
            <base class="value">
            HTML,
            Base::tag()->attributes(['class' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <base class="value">
            HTML,
            Base::tag()->class('value')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <base data-value="value">
            HTML,
            Base::tag()->dataAttributes(['value' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <base class="default-class">
            HTML,
            Base::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <base class="default-class" title="default-title">
            HTML,
            Base::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <base>
            HTML,
            Base::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <base dir="ltr">
            HTML,
            Base::tag()->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base dir="ltr">
            HTML,
            Base::tag()->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Base::class, ['class' => 'default-class']);

        self::assertSame(
            '<base class="default-class">',
            Base::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Base::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <base hidden>
            HTML,
            Base::tag()->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithHref(): void
    {
        self::assertSame(
            <<<HTML
            <base href="https://example.com/">
            HTML,
            Base::tag()->href('https://example.com/')->render(),
            "Failed asserting that element renders correctly with 'href' attribute.",
        );
    }

    public function testRenderWithHrefAndTarget(): void
    {
        self::assertSame(
            <<<HTML
            <base href="https://example.com/" target="_blank">
            HTML,
            Base::tag()->href('https://example.com/')->target('_blank')->render(),
            "Failed asserting that element renders correctly with both 'href' and 'target' attributes.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <base id="test-id">
            HTML,
            Base::tag()->id('test-id')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <base lang="es">
            HTML,
            Base::tag()->lang('es')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base lang="es">
            HTML,
            Base::tag()->lang(Language::SPANISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <base>
            HTML,
            Base::tag()
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
            <base>
            HTML,
            Base::tag()
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
            <base>
            HTML,
            Base::tag()
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
            <base role="banner">
            HTML,
            Base::tag()->role('banner')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base role="banner">
            HTML,
            Base::tag()->role(Role::BANNER)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <base style='value'>
            HTML,
            Base::tag()->style('value')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTarget(): void
    {
        self::assertSame(
            <<<HTML
            <base target="_blank">
            HTML,
            Base::tag()->target('_blank')->render(),
            "Failed asserting that element renders correctly with 'target' attribute.",
        );
    }

    public function testRenderWithTargetBlankUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base target="_blank">
            HTML,
            Base::tag()->target(Target::BLANK)->render(),
            "Failed asserting that element renders correctly with 'target' attribute using Target::BLANK enum.",
        );
    }

    public function testRenderWithTargetParentUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base target="_parent">
            HTML,
            Base::tag()->target(Target::PARENT)->render(),
            "Failed asserting that element renders correctly with 'target' attribute using Target::PARENT enum.",
        );
    }

    public function testRenderWithTargetSelfUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base target="_self">
            HTML,
            Base::tag()->target(Target::SELF)->render(),
            "Failed asserting that element renders correctly with 'target' attribute using Target::SELF enum.",
        );
    }

    public function testRenderWithTargetTopUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base target="_top">
            HTML,
            Base::tag()->target(Target::TOP)->render(),
            "Failed asserting that element renders correctly with 'target' attribute using Target::TOP enum.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <base class="text-muted">
            HTML,
            Base::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <base title="value">
            HTML,
            Base::tag()->title('value')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<base>',
            LineEndingNormalizer::normalize(
                (string) Base::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <base translate="no">
            HTML,
            Base::tag()->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <base translate="no">
            HTML,
            Base::tag()->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Base::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <base class="from-global" id="id-user">
            HTML,
            Base::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Base::class, []);
    }

    public function testThrowInvalidArgumentExceptionForSettingTarget(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'target',
                implode("', '", Enum::normalizeArray(Target::cases())),
            ),
        );

        Base::tag()->target('invalid-value');
    }
}
