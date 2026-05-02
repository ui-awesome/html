<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    ContentEditable,
    Crossorigin,
    Data,
    Direction,
    Draggable,
    GlobalAttribute,
    Language,
    Role,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Embedded\Audio;
use UIAwesome\Html\Embedded\Values\{Controlslist, Preload};
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Audio} rendering and audio attribute behavior.
 *
 * Test coverage.
 * - Applies audio specific attributes (`autoplay`, `controls`, `controlslist`, `crossorigin`, `disableremoteplayback`,
 *   `loop`, `muted`, `preload`, `src`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*` and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Ensures fluent attribute setters return new instances (immutability).
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('embedded')]
final class AudioTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Audio::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Audio::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Audio::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <audio>
            <value>
            </audio>
            HTML,
            Audio::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <audio accesskey="value">
            </audio>
            HTML,
            Audio::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <audio aria-label="value">
            </audio>
            HTML,
            Audio::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio aria-label="value">
            </audio>
            HTML,
            Audio::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <audio data-value="value">
            </audio>
            HTML,
            Audio::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio data-value="value">
            </audio>
            HTML,
            Audio::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <audio onclick="alert(&apos;Clicked!&apos;)">
            </audio>
            HTML,
            Audio::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <audio aria-controls="value" aria-label="value">
            </audio>
            HTML,
            Audio::tag()
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
            <audio class="value">
            </audio>
            HTML,
            Audio::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <audio autofocus>
            </audio>
            HTML,
            Audio::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithAutoplay(): void
    {
        self::assertSame(
            <<<HTML
            <audio autoplay>
            </audio>
            HTML,
            Audio::tag()
                ->autoplay(true)
                ->render(),
            "'autoplay' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <audio>
            Content
            </audio>
            HTML,
            Audio::tag()->begin() . 'Content' . Audio::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <audio class="value">
            </audio>
            HTML,
            Audio::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio class="value">
            </audio>
            HTML,
            Audio::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <audio>
            value
            </audio>
            HTML,
            Audio::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <audio contenteditable="true">
            </audio>
            HTML,
            Audio::tag()
                ->contentEditable(true)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio contenteditable="true">
            </audio>
            HTML,
            Audio::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithControls(): void
    {
        self::assertSame(
            <<<HTML
            <audio controls>
            </audio>
            HTML,
            Audio::tag()
                ->controls(true)
                ->render(),
            "'controls' must be serialized.",
        );
    }

    public function testRenderWithControlslist(): void
    {
        self::assertSame(
            <<<HTML
            <audio controlslist="nodownload">
            </audio>
            HTML,
            Audio::tag()
                ->controlslist('nodownload')
                ->render(),
            "'controlslist' must be serialized.",
        );
    }

    public function testRenderWithControlslistUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio controlslist="noremoteplayback">
            </audio>
            HTML,
            Audio::tag()
                ->controlslist(Controlslist::NOREMOTEPLAYBACK)
                ->render(),
            "'controlslist' must be serialized.",
        );
    }

    public function testRenderWithControlslistUsingMultipleTokens(): void
    {
        self::assertSame(
            <<<HTML
            <audio controlslist="nodownload noremoteplayback">
            </audio>
            HTML,
            Audio::tag()
                ->controlslist('nodownload noremoteplayback')
                ->render(),
            'controlslist must accept space-separated tokens.',
        );
    }

    public function testRenderWithCrossorigin(): void
    {
        self::assertSame(
            <<<HTML
            <audio crossorigin="anonymous">
            </audio>
            HTML,
            Audio::tag()
                ->crossorigin('anonymous')
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithCrossoriginUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio crossorigin="use-credentials">
            </audio>
            HTML,
            Audio::tag()
                ->crossorigin(Crossorigin::USE_CREDENTIALS)
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <audio data-value="value">
            </audio>
            HTML,
            Audio::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <audio class="default-class">
            </audio>
            HTML,
            Audio::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <audio class="default-class">
            </audio>
            HTML,
            Audio::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <audio>
            </audio>
            HTML,
            Audio::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <audio dir="ltr">
            </audio>
            HTML,
            Audio::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio dir="ltr">
            </audio>
            HTML,
            Audio::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisableremoteplayback(): void
    {
        self::assertSame(
            <<<HTML
            <audio disableremoteplayback>
            </audio>
            HTML,
            Audio::tag()
                ->disableremoteplayback(true)
                ->render(),
            "'disableremoteplayback' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <audio draggable="true">
            </audio>
            HTML,
            Audio::tag()
                ->draggable(true)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio draggable="true">
            </audio>
            HTML,
            Audio::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Audio::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <audio class="default-class">
            </audio>
            HTML,
            Audio::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Audio::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <audio hidden>
            </audio>
            HTML,
            Audio::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <audio id="value">
            </audio>
            HTML,
            Audio::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <audio lang="en">
            </audio>
            HTML,
            Audio::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio lang="en">
            </audio>
            HTML,
            Audio::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLoop(): void
    {
        self::assertSame(
            <<<HTML
            <audio loop>
            </audio>
            HTML,
            Audio::tag()
                ->loop(true)
                ->render(),
            "'loop' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <audio itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </audio>
            HTML,
            Audio::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
            'Microdata attributes must be serialized.',
        );
    }

    public function testRenderWithMuted(): void
    {
        self::assertSame(
            <<<HTML
            <audio muted>
            </audio>
            HTML,
            Audio::tag()
                ->muted(true)
                ->render(),
            "'muted' must be serialized.",
        );
    }

    public function testRenderWithPreload(): void
    {
        self::assertSame(
            <<<HTML
            <audio preload="metadata">
            </audio>
            HTML,
            Audio::tag()
                ->preload('metadata')
                ->render(),
            "'preload' must be serialized.",
        );
    }

    public function testRenderWithPreloadUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio preload="auto">
            </audio>
            HTML,
            Audio::tag()
                ->preload(Preload::AUTO)
                ->render(),
            "'preload' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <audio>
            </audio>
            HTML,
            Audio::tag()
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
            <audio>
            </audio>
            HTML,
            Audio::tag()
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
            <audio>
            </audio>
            HTML,
            Audio::tag()
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
            <audio role="banner">
            </audio>
            HTML,
            Audio::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio role="banner">
            </audio>
            HTML,
            Audio::tag()
                ->role(Role::BANNER)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <audio class="value">
            </audio>
            HTML,
            Audio::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio title="value">
            </audio>
            HTML,
            Audio::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <audio spellcheck="true">
            </audio>
            HTML,
            Audio::tag()
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <audio src="value">
            </audio>
            HTML,
            Audio::tag()
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <audio style='value'>
            </audio>
            HTML,
            Audio::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <audio tabindex="3">
            </audio>
            HTML,
            Audio::tag()
                ->tabIndex(3)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <audio class="text-muted">
            </audio>
            HTML,
            Audio::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <audio title="value">
            </audio>
            HTML,
            Audio::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <audio>
            </audio>
            HTML,
            (string) Audio::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <audio translate="no">
            </audio>
            HTML,
            Audio::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <audio translate="no">
            </audio>
            HTML,
            Audio::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Audio::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <audio class="from-global" id="value">
            </audio>
            HTML,
            Audio::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Audio::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $audio = Audio::tag();

        self::assertNotSame(
            $audio,
            $audio->autoplay(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->controls(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->controlslist(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->crossorigin(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->disableremoteplayback(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->loop(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->muted(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->preload(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->src(''),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingContentEditable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::CONTENTEDITABLE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, ContentEditable::cases())),
            ),
        );

        Audio::tag()->contentEditable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingControlslist(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'controlslist',
                self::validControlslistValues(),
            ),
        );

        Audio::tag()->controlslist('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingControlslistWithInvalidTokenList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'controlslist',
                self::validControlslistValues(),
            ),
        );

        Audio::tag()->controlslist('nodownload invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingControlslistWithPaddedSingleToken(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                ' nodownload',
                'controlslist',
                self::validControlslistValues(),
            ),
        );

        Audio::tag()->controlslist(' nodownload');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingCrossorigin(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                \UIAwesome\Html\Attribute\Values\Attribute::CROSSORIGIN->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Crossorigin::cases())),
            ),
        );

        Audio::tag()->crossorigin('invalid-value');
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

        Audio::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDraggable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DRAGGABLE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Draggable::cases())),
            ),
        );

        Audio::tag()->draggable('invalid-value');
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

        Audio::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingPreload(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'preload',
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Preload::cases())),
            ),
        );

        Audio::tag()->preload('invalid-value');
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

        Audio::tag()->role('invalid-value');
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

        Audio::tag()->tabIndex(-2);
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

        Audio::tag()->translate('invalid-value');
    }

    private static function validControlslistValues(): string
    {
        return implode(
            "', '",
            array_map(static fn(\BackedEnum $case): string => $case->value, Controlslist::cases()),
        );
    }
}
