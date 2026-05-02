<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
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
use UIAwesome\Html\Embedded\Source;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Source} rendering and source attribute behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*` and enum-backed values.
 * - Applies source specific attributes (`height`, `media`, `sizes`, `src`, `srcset`, `type`, `width`) and renders
 *   expected output.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Ensures fluent attribute setters return new instances (immutability).
 * - Renders string casting with expected output for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('embedded')]
final class SourceTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Source::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Source::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <source accesskey="value">
            HTML,
            Source::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <source aria-label="value">
            HTML,
            Source::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <source aria-label="value">
            HTML,
            Source::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <source data-value="value">
            HTML,
            Source::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <source data-value="value">
            HTML,
            Source::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <source onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            Source::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <source aria-controls="value" aria-label="value">
            HTML,
            Source::tag()
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
            <source class="value">
            HTML,
            Source::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <source class="value">
            HTML,
            Source::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <source class="value">
            HTML,
            Source::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <source data-value="value">
            HTML,
            Source::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <source class="default-class">
            HTML,
            Source::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <source class="default-class" title="default-title">
            HTML,
            Source::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <source>
            HTML,
            Source::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <source dir="ltr">
            HTML,
            Source::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <source dir="ltr">
            HTML,
            Source::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Source::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <source class="default-class">
            HTML,
            Source::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Source::class,
            [],
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <source height="400">
            HTML,
            Source::tag()
                ->height(400)
                ->render(),
            "'height' must be serialized.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <source hidden>
            HTML,
            Source::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <source id="value">
            HTML,
            Source::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <source lang="en">
            HTML,
            Source::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <source lang="en">
            HTML,
            Source::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMedia(): void
    {
        self::assertSame(
            <<<HTML
            <source media="(width &gt;= 800px)">
            HTML,
            Source::tag()
                ->media('(width >= 800px)')
                ->render(),
            "'media' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <source>
            HTML,
            Source::tag()
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
            <source>
            HTML,
            Source::tag()
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
            <source>
            HTML,
            Source::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <source role="banner">
            HTML,
            Source::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <source role="banner">
            HTML,
            Source::tag()
                ->role(Role::BANNER)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <source class="value">
            HTML,
            Source::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <source title="value">
            HTML,
            Source::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSizes(): void
    {
        self::assertSame(
            <<<HTML
            <source sizes="(max-width: 600px) 100vw, 50vw">
            HTML,
            Source::tag()
                ->sizes('(max-width: 600px) 100vw, 50vw')
                ->render(),
            "'sizes' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <source src="/media/intro.webm">
            HTML,
            Source::tag()
                ->src('/media/intro.webm')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithSrcset(): void
    {
        self::assertSame(
            <<<HTML
            <source srcset="image-320w.jpg 320w, image-640w.jpg 640w">
            HTML,
            Source::tag()
                ->srcset('image-320w.jpg 320w, image-640w.jpg 640w')
                ->render(),
            "'srcset' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <source style='value'>
            HTML,
            Source::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <source class="text-muted">
            HTML,
            Source::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <source title="value">
            HTML,
            Source::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <source>
            HTML,
            (string) Source::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <source translate="no">
            HTML,
            Source::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <source translate="no">
            HTML,
            Source::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithType(): void
    {
        self::assertSame(
            <<<HTML
            <source type="video/webm">
            HTML,
            Source::tag()
                ->type('video/webm')
                ->render(),
            "'type' must be serialized.",
        );
    }

    public function testRenderWithTypeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <source type="value">
            HTML,
            Source::tag()
                ->type(BackedString::VALUE)
                ->render(),
            "'type' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Source::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <source class="from-global" id="value">
            HTML,
            Source::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Source::class,
            [],
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <source width="640">
            HTML,
            Source::tag()
                ->width(640)
                ->render(),
            "'width' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $source = Source::tag();

        self::assertNotSame(
            $source,
            $source->height(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->media(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->sizes(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->srcset(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->type(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->width(null),
            'New instance must be returned (immutability).',
        );
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

        Source::tag()->dir('invalid-value');
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

        Source::tag()->lang('invalid-value');
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

        Source::tag()->role('invalid-value');
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

        Source::tag()->translate('invalid-value');
    }
}
