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
use UIAwesome\Html\Embedded\Values\{Controlslist, Preload};
use UIAwesome\Html\Embedded\Video;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Video} rendering and video attribute behavior.
 *
 * Test coverage.
 * - Applies video specific attributes (`autoplay`, `controls`, `controlslist`, `crossorigin`,
 *   `disablepictureinpicture`, `disableremoteplayback`, `height`, `loop`, `muted`, `playsinline`, `poster`,
 *   `preload`, `src`, `width`) and renders expected output.
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
final class VideoTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Video::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Video::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Video::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <video>
            <value>
            </video>
            HTML,
            Video::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <video accesskey="value">
            </video>
            HTML,
            Video::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <video aria-label="value">
            </video>
            HTML,
            Video::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video aria-label="value">
            </video>
            HTML,
            Video::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <video data-value="value">
            </video>
            HTML,
            Video::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video data-value="value">
            </video>
            HTML,
            Video::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <video onclick="alert(&apos;Clicked!&apos;)">
            </video>
            HTML,
            Video::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <video aria-controls="value" aria-label="value">
            </video>
            HTML,
            Video::tag()
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
            <video class="value">
            </video>
            HTML,
            Video::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <video autofocus>
            </video>
            HTML,
            Video::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithAutoplay(): void
    {
        self::assertSame(
            <<<HTML
            <video autoplay>
            </video>
            HTML,
            Video::tag()
                ->autoplay(true)
                ->render(),
            "'autoplay' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <video>
            Content
            </video>
            HTML,
            Video::tag()->begin() . 'Content' . Video::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <video class="value">
            </video>
            HTML,
            Video::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video class="value">
            </video>
            HTML,
            Video::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <video>
            value
            </video>
            HTML,
            Video::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <video contenteditable="true">
            </video>
            HTML,
            Video::tag()
                ->contentEditable(true)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video contenteditable="true">
            </video>
            HTML,
            Video::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithControls(): void
    {
        self::assertSame(
            <<<HTML
            <video controls>
            </video>
            HTML,
            Video::tag()
                ->controls(true)
                ->render(),
            "'controls' must be serialized.",
        );
    }

    public function testRenderWithControlslist(): void
    {
        self::assertSame(
            <<<HTML
            <video controlslist="nodownload">
            </video>
            HTML,
            Video::tag()
                ->controlslist('nodownload')
                ->render(),
            "'controlslist' must be serialized.",
        );
    }

    public function testRenderWithControlslistUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video controlslist="nofullscreen">
            </video>
            HTML,
            Video::tag()
                ->controlslist(Controlslist::NOFULLSCREEN)
                ->render(),
            "'controlslist' must be serialized.",
        );
    }

    public function testRenderWithControlslistUsingMultipleTokens(): void
    {
        self::assertSame(
            <<<HTML
            <video controlslist="nodownload noremoteplayback">
            </video>
            HTML,
            Video::tag()
                ->controlslist('nodownload noremoteplayback')
                ->render(),
            'controlslist must accept space-separated tokens.',
        );
    }

    public function testRenderWithCrossorigin(): void
    {
        self::assertSame(
            <<<HTML
            <video crossorigin="anonymous">
            </video>
            HTML,
            Video::tag()
                ->crossorigin('anonymous')
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithCrossoriginUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video crossorigin="use-credentials">
            </video>
            HTML,
            Video::tag()
                ->crossorigin(Crossorigin::USE_CREDENTIALS)
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <video data-value="value">
            </video>
            HTML,
            Video::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <video class="default-class">
            </video>
            HTML,
            Video::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <video class="default-class">
            </video>
            HTML,
            Video::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <video>
            </video>
            HTML,
            Video::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <video dir="ltr">
            </video>
            HTML,
            Video::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video dir="ltr">
            </video>
            HTML,
            Video::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisablepictureinpicture(): void
    {
        self::assertSame(
            <<<HTML
            <video disablepictureinpicture>
            </video>
            HTML,
            Video::tag()
                ->disablepictureinpicture(true)
                ->render(),
            "'disablepictureinpicture' must be serialized.",
        );
    }

    public function testRenderWithDisableremoteplayback(): void
    {
        self::assertSame(
            <<<HTML
            <video disableremoteplayback>
            </video>
            HTML,
            Video::tag()
                ->disableremoteplayback(true)
                ->render(),
            "'disableremoteplayback' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <video draggable="true">
            </video>
            HTML,
            Video::tag()
                ->draggable(true)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video draggable="true">
            </video>
            HTML,
            Video::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Video::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <video class="default-class">
            </video>
            HTML,
            Video::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Video::class,
            [],
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <video height="600">
            </video>
            HTML,
            Video::tag()
                ->height(600)
                ->render(),
            "'height' must be serialized.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <video hidden>
            </video>
            HTML,
            Video::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <video id="value">
            </video>
            HTML,
            Video::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <video lang="en">
            </video>
            HTML,
            Video::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video lang="en">
            </video>
            HTML,
            Video::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLoop(): void
    {
        self::assertSame(
            <<<HTML
            <video loop>
            </video>
            HTML,
            Video::tag()
                ->loop(true)
                ->render(),
            "'loop' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <video itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </video>
            HTML,
            Video::tag()
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
            <video muted>
            </video>
            HTML,
            Video::tag()
                ->muted(true)
                ->render(),
            "'muted' must be serialized.",
        );
    }

    public function testRenderWithPlaysinline(): void
    {
        self::assertSame(
            <<<HTML
            <video playsinline>
            </video>
            HTML,
            Video::tag()
                ->playsinline(true)
                ->render(),
            "'playsinline' must be serialized.",
        );
    }

    public function testRenderWithPoster(): void
    {
        self::assertSame(
            <<<HTML
            <video poster="https://example.com/poster.jpg">
            </video>
            HTML,
            Video::tag()
                ->poster('https://example.com/poster.jpg')
                ->render(),
            "'poster' must be serialized.",
        );
    }

    public function testRenderWithPreload(): void
    {
        self::assertSame(
            <<<HTML
            <video preload="metadata">
            </video>
            HTML,
            Video::tag()
                ->preload('metadata')
                ->render(),
            "'preload' must be serialized.",
        );
    }

    public function testRenderWithPreloadUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video preload="auto">
            </video>
            HTML,
            Video::tag()
                ->preload(Preload::AUTO)
                ->render(),
            "'preload' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <video>
            </video>
            HTML,
            Video::tag()
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
            <video>
            </video>
            HTML,
            Video::tag()
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
            <video>
            </video>
            HTML,
            Video::tag()
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
            <video role="banner">
            </video>
            HTML,
            Video::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video role="banner">
            </video>
            HTML,
            Video::tag()
                ->role(Role::BANNER)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <video class="value">
            </video>
            HTML,
            Video::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video title="value">
            </video>
            HTML,
            Video::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <video spellcheck="true">
            </video>
            HTML,
            Video::tag()
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <video src="value">
            </video>
            HTML,
            Video::tag()
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <video style='value'>
            </video>
            HTML,
            Video::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <video tabindex="3">
            </video>
            HTML,
            Video::tag()
                ->tabIndex(3)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <video class="text-muted">
            </video>
            HTML,
            Video::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <video title="value">
            </video>
            HTML,
            Video::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <video>
            </video>
            HTML,
            (string) Video::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <video translate="no">
            </video>
            HTML,
            Video::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <video translate="no">
            </video>
            HTML,
            Video::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Video::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <video class="from-global" id="value">
            </video>
            HTML,
            Video::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Video::class,
            [],
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <video width="800">
            </video>
            HTML,
            Video::tag()
                ->width(800)
                ->render(),
            "'width' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $video = Video::tag();

        self::assertNotSame(
            $video,
            $video->autoplay(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->controls(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->controlslist(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->crossorigin(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->disablepictureinpicture(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->disableremoteplayback(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->height(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->loop(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->muted(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->playsinline(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->poster(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->preload(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->width(null),
            'New instance must be returned (immutability).',
        );
    }

    public function testSetControlslistWithWhitespaceSeparatedTokens(): void
    {
        self::assertSame(
            ['controlslist' => "nodownload\tnoremoteplayback"],
            Video::tag()
                ->controlslist("nodownload\tnoremoteplayback")
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
        self::assertSame(
            ['controlslist' => "nodownload\nnoremoteplayback"],
            Video::tag()
                ->controlslist("nodownload\nnoremoteplayback")
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
        self::assertSame(
            ['controlslist' => "nodownload\rnoremoteplayback"],
            Video::tag()
                ->controlslist("nodownload\rnoremoteplayback")
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
        self::assertSame(
            ['controlslist' => "nodownload\fnoremoteplayback"],
            Video::tag()
                ->controlslist("nodownload\fnoremoteplayback")
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
        self::assertSame(
            ['controlslist' => "nodownload\t\nnoremoteplayback"],
            Video::tag()
                ->controlslist("nodownload\t\nnoremoteplayback")
                ->getAttributes(),
            'Assigned attributes must be returned.',
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

        Video::tag()->contentEditable('invalid-value');
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

        Video::tag()->controlslist('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingControlslistWithEmptyTokenBeforeInvalidToken(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'controlslist',
                self::validControlslistValues(),
            ),
        );

        Video::tag()->controlslist("nodownload\t\ninvalid-value");
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

        Video::tag()->controlslist('nodownload invalid-value');
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

        Video::tag()->controlslist(' nodownload');
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

        Video::tag()->crossorigin('invalid-value');
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

        Video::tag()->dir('invalid-value');
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

        Video::tag()->draggable('invalid-value');
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

        Video::tag()->lang('invalid-value');
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

        Video::tag()->preload('invalid-value');
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

        Video::tag()->role('invalid-value');
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

        Video::tag()->tabIndex(-2);
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

        Video::tag()->translate('invalid-value');
    }

    private static function validControlslistValues(): string
    {
        return implode(
            "', '",
            array_map(static fn(\BackedEnum $case): string => $case->value, Controlslist::cases()),
        );
    }
}
