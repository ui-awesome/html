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
use UIAwesome\Html\Helper\{Enum, Exception\Message};
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Source} rendering and source attribute behavior.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('embedded')]
final class SourceTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame('value', Source::tag()->getAttribute('class', 'value'));
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(['class' => 'value'], Source::tag()->setAttribute('class', 'value')->getAttributes());
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame('<source accesskey="value">', Source::tag()->accesskey('value')->render());
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame('<source aria-label="value">', Source::tag()->addAriaAttribute('label', 'value')->render());
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame('<source aria-label="value">', Source::tag()->addAriaAttribute(Aria::LABEL, 'value')->render());
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame('<source data-value="value">', Source::tag()->addDataAttribute('value', 'value')->render());
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame('<source data-value="value">', Source::tag()->addDataAttribute(Data::VALUE, 'value')->render());
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            '<source aria-controls="value" aria-label="value">',
            Source::tag()->ariaAttributes(['controls' => 'value', 'label' => 'value'])->render(),
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame('<source class="value">', Source::tag()->attributes(['class' => 'value'])->render());
    }

    public function testRenderWithClass(): void
    {
        self::assertSame('<source class="value">', Source::tag()->class('value')->render());
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame('<source class="value">', Source::tag()->class(BackedString::VALUE)->render());
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame('<source data-value="value">', Source::tag()->dataAttributes(['value' => 'value'])->render());
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame('<source class="default-class">', Source::tag(['class' => 'default-class'])->render());
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            '<source class="default-class" title="default-title">',
            Source::tag()->addDefaultProvider(DefaultProvider::class)->render(),
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame('<source>', Source::tag()->render());
    }

    public function testRenderWithDir(): void
    {
        self::assertSame('<source dir="ltr">', Source::tag()->dir('ltr')->render());
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame('<source dir="ltr">', Source::tag()->dir(Direction::LTR)->render());
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Source::class, ['class' => 'default-class']);

        self::assertSame('<source class="default-class">', Source::tag()->render());

        SimpleFactory::setDefaults(Source::class, []);
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame('<source height="400">', Source::tag()->height(400)->render());
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame('<source hidden>', Source::tag()->hidden(true)->render());
    }

    public function testRenderWithId(): void
    {
        self::assertSame('<source id="value">', Source::tag()->id('value')->render());
    }

    public function testRenderWithLang(): void
    {
        self::assertSame('<source lang="en">', Source::tag()->lang('en')->render());
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame('<source lang="en">', Source::tag()->lang(Language::ENGLISH)->render());
    }

    public function testRenderWithMedia(): void
    {
        self::assertSame('<source media="(width &gt;= 800px)">', Source::tag()->media('(width >= 800px)')->render());
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame('<source>', Source::tag()->addAriaAttribute('label', 'value')->removeAriaAttribute('label')->render());
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame('<source>', Source::tag()->setAttribute('class', 'value')->removeAttribute('class')->render());
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame('<source>', Source::tag()->addDataAttribute('value', 'value')->removeDataAttribute('value')->render());
    }

    public function testRenderWithRole(): void
    {
        self::assertSame('<source role="banner">', Source::tag()->role('banner')->render());
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame('<source role="banner">', Source::tag()->role(Role::BANNER)->render());
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame('<source class="value">', Source::tag()->setAttribute('class', 'value')->render());
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame('<source title="value">', Source::tag()->setAttribute(GlobalAttribute::TITLE, 'value')->render());
    }

    public function testRenderWithSizes(): void
    {
        self::assertSame('<source sizes="(max-width: 600px) 100vw, 50vw">', Source::tag()->sizes('(max-width: 600px) 100vw, 50vw')->render());
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame('<source src="/media/intro.webm">', Source::tag()->src('/media/intro.webm')->render());
    }

    public function testRenderWithSrcset(): void
    {
        self::assertSame(
            '<source srcset="image-320w.jpg 320w, image-640w.jpg 640w">',
            Source::tag()->srcset('image-320w.jpg 320w, image-640w.jpg 640w')->render(),
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame("<source style='value'>", Source::tag()->style('value')->render());
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame('<source class="text-muted">', Source::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render());
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame('<source title="value">', Source::tag()->title('value')->render());
    }

    public function testRenderWithToString(): void
    {
        self::assertSame('<source>', (string) Source::tag());
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame('<source translate="no">', Source::tag()->translate(false)->render());
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame('<source translate="no">', Source::tag()->translate(Translate::NO)->render());
    }

    public function testRenderWithType(): void
    {
        self::assertSame('<source type="video/webm">', Source::tag()->type('video/webm')->render());
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Source::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame('<source class="from-global" id="value">', Source::tag(['id' => 'value'])->render());

        SimpleFactory::setDefaults(Source::class, []);
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame('<source width="640">', Source::tag()->width(640)->render());
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $source = Source::tag();

        self::assertNotSame($source, $source->height(null));
        self::assertNotSame($source, $source->media(''));
        self::assertNotSame($source, $source->sizes(''));
        self::assertNotSame($source, $source->src(''));
        self::assertNotSame($source, $source->srcset(''));
        self::assertNotSame($source, $source->type(''));
        self::assertNotSame($source, $source->width(null));
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

        Source::tag()->dir('invalid-value');
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

        Source::tag()->lang('invalid-value');
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

        Source::tag()->role('invalid-value');
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

        Source::tag()->translate('invalid-value');
    }
}
