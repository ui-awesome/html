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
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('embedded')]
final class VideoTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame('&lt;value&gt;', Video::tag()->content('<value>')->getContent());
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame('value', Video::tag()->getAttribute('class', 'value'));
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(['class' => 'value'], Video::tag()->setAttribute('class', 'value')->getAttributes());
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame("<video>\n<value>\n</video>", Video::tag()->html('<value>')->render());
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame("<video accesskey=\"value\">\n</video>", Video::tag()->accesskey('value')->render());
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            "<video aria-label=\"value\">\n</video>",
            Video::tag()->addAriaAttribute('label', 'value')->render(),
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            "<video aria-label=\"value\">\n</video>",
            Video::tag()->addAriaAttribute(Aria::LABEL, 'value')->render(),
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            "<video data-value=\"value\">\n</video>",
            Video::tag()->addDataAttribute('value', 'value')->render(),
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            "<video data-value=\"value\">\n</video>",
            Video::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            "<video aria-controls=\"value\" aria-label=\"value\">\n</video>",
            Video::tag()->ariaAttributes(['controls' => 'value', 'label' => 'value'])->render(),
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame("<video class=\"value\">\n</video>", Video::tag()->attributes(['class' => 'value'])->render());
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame("<video autofocus>\n</video>", Video::tag()->autofocus(true)->render());
    }

    public function testRenderWithAutoplay(): void
    {
        self::assertSame("<video autoplay>\n</video>", Video::tag()->autoplay(true)->render());
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame("<video>\nContent\n</video>", Video::tag()->begin() . 'Content' . Video::end());
    }

    public function testRenderWithClass(): void
    {
        self::assertSame("<video class=\"value\">\n</video>", Video::tag()->class('value')->render());
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame("<video class=\"value\">\n</video>", Video::tag()->class(BackedString::VALUE)->render());
    }

    public function testRenderWithContent(): void
    {
        self::assertSame("<video>\nvalue\n</video>", Video::tag()->content('value')->render());
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            "<video contenteditable=\"true\">\n</video>",
            Video::tag()->contentEditable(true)->render(),
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            "<video contenteditable=\"true\">\n</video>",
            Video::tag()->contentEditable(ContentEditable::TRUE)->render(),
        );
    }

    public function testRenderWithControls(): void
    {
        self::assertSame("<video controls>\n</video>", Video::tag()->controls(true)->render());
    }

    public function testRenderWithControlslist(): void
    {
        self::assertSame(
            "<video controlslist=\"nodownload\">\n</video>",
            Video::tag()->controlslist('nodownload')->render(),
        );
    }

    public function testRenderWithControlslistUsingEnum(): void
    {
        self::assertSame(
            "<video controlslist=\"nofullscreen\">\n</video>",
            Video::tag()->controlslist(Controlslist::NOFULLSCREEN)->render(),
        );
    }

    public function testRenderWithControlslistUsingMultipleTokens(): void
    {
        self::assertSame(
            "<video controlslist=\"nodownload noremoteplayback\">\n</video>",
            Video::tag()->controlslist('nodownload noremoteplayback')->render(),
        );
    }

    public function testRenderWithCrossorigin(): void
    {
        self::assertSame(
            "<video crossorigin=\"anonymous\">\n</video>",
            Video::tag()->crossorigin('anonymous')->render(),
        );
    }

    public function testRenderWithCrossoriginUsingEnum(): void
    {
        self::assertSame(
            "<video crossorigin=\"use-credentials\">\n</video>",
            Video::tag()->crossorigin(Crossorigin::USE_CREDENTIALS)->render(),
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            "<video data-value=\"value\">\n</video>",
            Video::tag()->dataAttributes(['value' => 'value'])->render(),
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame("<video class=\"default-class\">\n</video>", Video::tag(['class' => 'default-class'])->render());
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            "<video class=\"default-class\">\n</video>",
            Video::tag()->addDefaultProvider(DefaultProvider::class)->render(),
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame("<video>\n</video>", Video::tag()->render());
    }

    public function testRenderWithDir(): void
    {
        self::assertSame("<video dir=\"ltr\">\n</video>", Video::tag()->dir('ltr')->render());
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame("<video dir=\"ltr\">\n</video>", Video::tag()->dir(Direction::LTR)->render());
    }

    public function testRenderWithDisablepictureinpicture(): void
    {
        self::assertSame(
            "<video disablepictureinpicture>\n</video>",
            Video::tag()->disablepictureinpicture(true)->render(),
        );
    }

    public function testRenderWithDisableremoteplayback(): void
    {
        self::assertSame(
            "<video disableremoteplayback>\n</video>",
            Video::tag()->disableremoteplayback(true)->render(),
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame("<video draggable=\"true\">\n</video>", Video::tag()->draggable(true)->render());
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            "<video draggable=\"true\">\n</video>",
            Video::tag()->draggable(Draggable::TRUE)->render(),
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Video::class, ['class' => 'default-class']);

        self::assertSame("<video class=\"default-class\">\n</video>", Video::tag()->render());

        SimpleFactory::setDefaults(Video::class, []);
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame("<video height=\"600\">\n</video>", Video::tag()->height(600)->render());
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame("<video hidden>\n</video>", Video::tag()->hidden(true)->render());
    }

    public function testRenderWithId(): void
    {
        self::assertSame("<video id=\"value\">\n</video>", Video::tag()->id('value')->render());
    }

    public function testRenderWithLang(): void
    {
        self::assertSame("<video lang=\"en\">\n</video>", Video::tag()->lang('en')->render());
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame("<video lang=\"en\">\n</video>", Video::tag()->lang(Language::ENGLISH)->render());
    }

    public function testRenderWithLoop(): void
    {
        self::assertSame("<video loop>\n</video>", Video::tag()->loop(true)->render());
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            '<video itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">'
            . "\n</video>",
            Video::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
        );
    }

    public function testRenderWithMuted(): void
    {
        self::assertSame("<video muted>\n</video>", Video::tag()->muted(true)->render());
    }

    public function testRenderWithPlaysinline(): void
    {
        self::assertSame("<video playsinline>\n</video>", Video::tag()->playsinline(true)->render());
    }

    public function testRenderWithPoster(): void
    {
        self::assertSame(
            "<video poster=\"https://example.com/poster.jpg\">\n</video>",
            Video::tag()->poster('https://example.com/poster.jpg')->render(),
        );
    }

    public function testRenderWithPreload(): void
    {
        self::assertSame("<video preload=\"metadata\">\n</video>", Video::tag()->preload('metadata')->render());
    }

    public function testRenderWithPreloadUsingEnum(): void
    {
        self::assertSame("<video preload=\"auto\">\n</video>", Video::tag()->preload(Preload::AUTO)->render());
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame("<video>\n</video>", Video::tag()->addAriaAttribute('label', 'value')->removeAriaAttribute('label')->render());
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame("<video>\n</video>", Video::tag()->setAttribute('class', 'value')->removeAttribute('class')->render());
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame("<video>\n</video>", Video::tag()->addDataAttribute('value', 'value')->removeDataAttribute('value')->render());
    }

    public function testRenderWithRole(): void
    {
        self::assertSame("<video role=\"banner\">\n</video>", Video::tag()->role('banner')->render());
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame("<video role=\"banner\">\n</video>", Video::tag()->role(Role::BANNER)->render());
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame("<video class=\"value\">\n</video>", Video::tag()->setAttribute('class', 'value')->render());
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            "<video title=\"value\">\n</video>",
            Video::tag()->setAttribute(GlobalAttribute::TITLE, 'value')->render(),
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame("<video spellcheck=\"true\">\n</video>", Video::tag()->spellcheck(true)->render());
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame("<video src=\"value\">\n</video>", Video::tag()->src('value')->render());
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame("<video style='value'>\n</video>", Video::tag()->style('value')->render());
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame("<video tabindex=\"3\">\n</video>", Video::tag()->tabIndex(3)->render());
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            "<video class=\"text-muted\">\n</video>",
            Video::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame("<video title=\"value\">\n</video>", Video::tag()->title('value')->render());
    }

    public function testRenderWithToString(): void
    {
        self::assertSame("<video>\n</video>", (string) Video::tag());
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame("<video translate=\"no\">\n</video>", Video::tag()->translate(false)->render());
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame("<video translate=\"no\">\n</video>", Video::tag()->translate(Translate::NO)->render());
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Video::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame("<video class=\"from-global\" id=\"value\">\n</video>", Video::tag(['id' => 'value'])->render());

        SimpleFactory::setDefaults(Video::class, []);
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame("<video width=\"800\">\n</video>", Video::tag()->width(800)->render());
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $video = Video::tag();

        self::assertNotSame($video, $video->autoplay(true));
        self::assertNotSame($video, $video->controls(true));
        self::assertNotSame($video, $video->controlslist(''));
        self::assertNotSame($video, $video->crossorigin(''));
        self::assertNotSame($video, $video->disablepictureinpicture(true));
        self::assertNotSame($video, $video->disableremoteplayback(true));
        self::assertNotSame($video, $video->height(null));
        self::assertNotSame($video, $video->loop(true));
        self::assertNotSame($video, $video->muted(true));
        self::assertNotSame($video, $video->playsinline(true));
        self::assertNotSame($video, $video->poster(''));
        self::assertNotSame($video, $video->preload(''));
        self::assertNotSame($video, $video->src(''));
        self::assertNotSame($video, $video->width(null));
    }

    public function testThrowInvalidArgumentExceptionWhenSettingContentEditable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::CONTENTEDITABLE->value,
                implode("', '", Enum::normalizeArray(ContentEditable::cases())),
            ),
        );

        Video::tag()->contentEditable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingCrossorigin(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                \UIAwesome\Html\Attribute\Values\Attribute::CROSSORIGIN->value,
                implode("', '", Enum::normalizeArray(Crossorigin::cases())),
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
                implode("', '", Enum::normalizeArray(Direction::cases())),
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
                implode("', '", Enum::normalizeArray(Draggable::cases())),
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
                implode("', '", Enum::normalizeArray(Language::cases())),
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
                implode("', '", Enum::normalizeArray(Preload::cases())),
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
                implode("', '", Enum::normalizeArray(Role::cases())),
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
                implode("', '", Enum::normalizeArray(Translate::cases())),
            ),
        );

        Video::tag()->translate('invalid-value');
    }
}
