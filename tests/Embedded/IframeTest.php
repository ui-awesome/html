<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
    ContentEditable,
    Data,
    Direction,
    Draggable,
    ElementAttribute,
    GlobalAttribute,
    Language,
    Loading,
    Referrerpolicy,
    Role,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Embedded\Iframe;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Iframe} rendering and iframe attribute behavior.
 */
#[Group('embedded')]
final class IframeTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Iframe::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Iframe::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Iframe::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <iframe>
            <value>
            </iframe>
            HTML,
            Iframe::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <iframe accesskey="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <iframe aria-label="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe aria-label="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <iframe data-value="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe data-value="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <iframe onclick="alert(&apos;Clicked!&apos;)">
            </iframe>
            HTML,
            Iframe::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAllow(): void
    {
        self::assertSame(
            <<<HTML
            <iframe allow="fullscreen">
            </iframe>
            HTML,
            Iframe::tag()
                ->allow('fullscreen')
                ->render(),
            "'allow' must be serialized.",
        );
    }

    public function testRenderWithAllowfullscreen(): void
    {
        self::assertSame(
            <<<HTML
            <iframe allowfullscreen>
            </iframe>
            HTML,
            Iframe::tag()
                ->allowfullscreen(true)
                ->render(),
            "'allowfullscreen' must be serialized.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <iframe aria-controls="value" aria-label="value">
            </iframe>
            HTML,
            Iframe::tag()
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
            <iframe class="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <iframe autofocus>
            </iframe>
            HTML,
            Iframe::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <iframe>
            Content
            </iframe>
            HTML,
            Iframe::tag()->begin() . 'Content' . Iframe::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <iframe class="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe class="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <iframe>
            value
            </iframe>
            HTML,
            Iframe::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <iframe contenteditable="true">
            </iframe>
            HTML,
            Iframe::tag()
                ->contentEditable(true)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe contenteditable="true">
            </iframe>
            HTML,
            Iframe::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <iframe data-value="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <iframe class="default-class">
            </iframe>
            HTML,
            Iframe::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <iframe class="default-class">
            </iframe>
            HTML,
            Iframe::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <iframe>
            </iframe>
            HTML,
            Iframe::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <iframe dir="ltr">
            </iframe>
            HTML,
            Iframe::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe dir="ltr">
            </iframe>
            HTML,
            Iframe::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <iframe draggable="true">
            </iframe>
            HTML,
            Iframe::tag()
                ->draggable(true)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe draggable="true">
            </iframe>
            HTML,
            Iframe::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Iframe::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <iframe class="default-class">
            </iframe>
            HTML,
            Iframe::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Iframe::class,
            [],
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <iframe height="150">
            </iframe>
            HTML,
            Iframe::tag()
                ->height(150)
                ->render(),
            "'height' must be serialized.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <iframe hidden>
            </iframe>
            HTML,
            Iframe::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <iframe id="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <iframe lang="en">
            </iframe>
            HTML,
            Iframe::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe lang="en">
            </iframe>
            HTML,
            Iframe::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLoading(): void
    {
        self::assertSame(
            <<<HTML
            <iframe loading="eager">
            </iframe>
            HTML,
            Iframe::tag()
                ->loading('eager')
                ->render(),
            "'loading' must be serialized.",
        );
    }

    public function testRenderWithLoadingUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe loading="lazy">
            </iframe>
            HTML,
            Iframe::tag()
                ->loading(Loading::LAZY)
                ->render(),
            "'loading' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <iframe itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </iframe>
            HTML,
            Iframe::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
            'Microdata attributes must be serialized.',
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <iframe name="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithReferrerpolicy(): void
    {
        self::assertSame(
            <<<HTML
            <iframe referrerpolicy="no-referrer">
            </iframe>
            HTML,
            Iframe::tag()
                ->referrerpolicy('no-referrer')
                ->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    public function testRenderWithReferrerpolicyUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe referrerpolicy="origin">
            </iframe>
            HTML,
            Iframe::tag()
                ->referrerpolicy(Referrerpolicy::ORIGIN)
                ->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <iframe>
            </iframe>
            HTML,
            Iframe::tag()
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
            <iframe>
            </iframe>
            HTML,
            Iframe::tag()
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
            <iframe>
            </iframe>
            HTML,
            Iframe::tag()
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
            <iframe role="banner">
            </iframe>
            HTML,
            Iframe::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe role="banner">
            </iframe>
            HTML,
            Iframe::tag()
                ->role(Role::BANNER)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSandbox(): void
    {
        self::assertSame(
            <<<HTML
            <iframe sandbox="allow-scripts">
            </iframe>
            HTML,
            Iframe::tag()
                ->sandbox('allow-scripts')
                ->render(),
            "'sandbox' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <iframe class="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe title="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <iframe spellcheck="true">
            </iframe>
            HTML,
            Iframe::tag()
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <iframe src="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithSrcdoc(): void
    {
        self::assertSame(
            <<<HTML
            <iframe srcdoc="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->srcdoc('value')
                ->render(),
            "'srcdoc' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <iframe style='value'>
            </iframe>
            HTML,
            Iframe::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <iframe tabindex="3">
            </iframe>
            HTML,
            Iframe::tag()
                ->tabIndex(3)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <iframe class="text-muted">
            </iframe>
            HTML,
            Iframe::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <iframe title="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <iframe>
            </iframe>
            HTML,
            (string) Iframe::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <iframe translate="no">
            </iframe>
            HTML,
            Iframe::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <iframe translate="no">
            </iframe>
            HTML,
            Iframe::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Iframe::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <iframe class="from-global" id="value">
            </iframe>
            HTML,
            Iframe::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Iframe::class,
            [],
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <iframe width="300">
            </iframe>
            HTML,
            Iframe::tag()
                ->width(300)
                ->render(),
            "'width' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $iframe = Iframe::tag();

        self::assertNotSame(
            $iframe,
            $iframe->allow(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->allowfullscreen(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->height(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->loading(Loading::LAZY),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->name(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->referrerpolicy(Referrerpolicy::ORIGIN),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->sandbox(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->srcdoc(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->width(''),
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
                implode("', '", Enum::normalizeStringArray(ContentEditable::cases())),
            ),
        );

        Iframe::tag()->contentEditable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDir(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DIR->value,
                implode("', '", Enum::normalizeStringArray(Direction::cases())),
            ),
        );

        Iframe::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDraggable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DRAGGABLE->value,
                implode("', '", Enum::normalizeStringArray(Draggable::cases())),
            ),
        );

        Iframe::tag()->draggable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLang(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::LANG->value,
                implode("', '", Enum::normalizeStringArray(Language::cases())),
            ),
        );

        Iframe::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLoading(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                ElementAttribute::LOADING->value,
                implode("', '", Enum::normalizeStringArray(Loading::cases())),
            ),
        );

        Iframe::tag()->loading('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingReferrerpolicy(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::REFERRERPOLICY->value,
                implode("', '", Enum::normalizeStringArray(Referrerpolicy::cases())),
            ),
        );

        Iframe::tag()->referrerpolicy('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::ROLE->value,
                implode("', '", Enum::normalizeStringArray(Role::cases())),
            ),
        );

        Iframe::tag()->role('invalid-value');
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

        Iframe::tag()->tabIndex(-2);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTranslate(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::TRANSLATE->value,
                implode("', '", Enum::normalizeStringArray(Translate::cases())),
            ),
        );

        Iframe::tag()->translate('invalid-value');
    }
}
