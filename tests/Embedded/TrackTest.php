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
use UIAwesome\Html\Embedded\Track;
use UIAwesome\Html\Embedded\Values\Kind;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Track} rendering and track attribute behavior.
 *
 * Test coverage.
 * - Applies track specific attributes (`default`, `kind`, `label`, `src`, `srclang`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*` and enum-backed values.
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
final class TrackTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Track::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Track::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <track accesskey="value">
            HTML,
            Track::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <track aria-label="value">
            HTML,
            Track::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track aria-label="value">
            HTML,
            Track::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must accept an enum key.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <track data-value="value">
            HTML,
            Track::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track data-value="value">
            HTML,
            Track::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must accept an enum key.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <track onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            Track::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <track aria-controls="value" aria-label="value">
            HTML,
            Track::tag()
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
            <track class="value">
            HTML,
            Track::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <track class="value">
            HTML,
            Track::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track class="value">
            HTML,
            Track::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must accept an enum value.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <track data-value="value">
            HTML,
            Track::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefault(): void
    {
        self::assertSame(
            <<<HTML
            <track default>
            HTML,
            Track::tag()
                ->default(true)
                ->render(),
            "'default' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <track class="default-class">
            HTML,
            Track::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <track class="default-class" title="default-title">
            HTML,
            Track::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <track>
            HTML,
            Track::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <track dir="ltr">
            HTML,
            Track::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track dir="ltr">
            HTML,
            Track::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must accept an enum value.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Track::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <track class="default-class">
            HTML,
            Track::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Track::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <track hidden>
            HTML,
            Track::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <track id="value">
            HTML,
            Track::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithKind(): void
    {
        self::assertSame(
            <<<HTML
            <track kind="captions">
            HTML,
            Track::tag()
                ->kind('captions')
                ->render(),
            "'kind' must be serialized.",
        );
    }

    public function testRenderWithKindUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track kind="subtitles">
            HTML,
            Track::tag()
                ->kind(Kind::SUBTITLES)
                ->render(),
            "'kind' must accept an enum value.",
        );
    }

    public function testRenderWithLabel(): void
    {
        self::assertSame(
            <<<HTML
            <track label="English">
            HTML,
            Track::tag()
                ->label('English')
                ->render(),
            "'label' must be serialized.",
        );
    }

    public function testRenderWithLabelUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track label="value">
            HTML,
            Track::tag()
                ->label(BackedString::VALUE)
                ->render(),
            "'label' must accept an enum value.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <track lang="en">
            HTML,
            Track::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track lang="en">
            HTML,
            Track::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must accept an enum value.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <track>
            HTML,
            Track::tag()
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
            <track>
            HTML,
            Track::tag()
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
            <track>
            HTML,
            Track::tag()
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
            <track role="banner">
            HTML,
            Track::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track role="banner">
            HTML,
            Track::tag()
                ->role(Role::BANNER)
                ->render(),
            "'role' must accept an enum value.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <track class="value">
            HTML,
            Track::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track title="value">
            HTML,
            Track::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must accept an enum key.',
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <track src="/media/subtitles.vtt">
            HTML,
            Track::tag()
                ->src('/media/subtitles.vtt')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithSrclang(): void
    {
        self::assertSame(
            <<<HTML
            <track srclang="en">
            HTML,
            Track::tag()
                ->srclang('en')
                ->render(),
            "'srclang' must be serialized.",
        );
    }

    public function testRenderWithSrclangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track srclang="value">
            HTML,
            Track::tag()
                ->srclang(BackedString::VALUE)
                ->render(),
            "'srclang' must accept an enum value.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <track style='value'>
            HTML,
            Track::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <track class="text-muted">
            HTML,
            Track::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <track title="value">
            HTML,
            Track::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <track>
            HTML,
            (string) Track::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <track translate="no">
            HTML,
            Track::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <track translate="no">
            HTML,
            Track::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must accept an enum value.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Track::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <track class="from-global" id="value">
            HTML,
            Track::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Track::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $track = Track::tag();

        self::assertNotSame(
            $track,
            $track->default(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $track,
            $track->kind('subtitles'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $track,
            $track->label(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $track,
            $track->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $track,
            $track->srclang(''),
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

        Track::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingKind(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'kind',
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Kind::cases())),
            ),
        );

        Track::tag()->kind('invalid-value');
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

        Track::tag()->lang('invalid-value');
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

        Track::tag()->role('invalid-value');
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

        Track::tag()->translate('invalid-value');
    }
}
