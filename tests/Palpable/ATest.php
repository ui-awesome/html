<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Palpable;

use InvalidArgumentException;
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
    Type,
};
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Palpable\A;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see A} rendering and anchor attribute behavior.
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
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            A::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            A::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
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
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <a accesskey="value"></a>
            HTML,
            A::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <a aria-label="value"></a>
            HTML,
            A::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a aria-label="value"></a>
            HTML,
            A::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
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
            'Data attribute must be added.',
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
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <a onclick="alert(&apos;Clicked!&apos;)"></a>
            HTML,
            A::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <a aria-controls="value" aria-label="value"></a>
            HTML,
            A::tag()
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
            <a class="value"></a>
            HTML,
            A::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
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
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <a>&lt;value&gt;</a>
            HTML,
            A::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
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
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <a class="default-class"></a>
            HTML,
            A::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
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
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            A::tag()->render(),
            'Bare element must render with no attributes.',
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
            "'dir' must be serialized.",
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
            "'dir' must be serialized.",
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
            "'download' must be serialized.",
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
            'download must accept a filename value.',
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <a onfocus="handleFocus()" onblur="handleBlur()"></a>
            HTML,
            A::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            A::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <a class="default-class"></a>
            HTML,
            A::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            A::class,
            [],
        );
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
            "'hidden' must be serialized.",
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
            "'href' must be serialized.",
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
            "'hreflang' must be serialized.",
        );
    }

    public function testRenderWithHreflangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a hreflang="en"></a>
            HTML,
            A::tag()
                ->hreflang(Language::ENGLISH)
                ->render(),
            "'hreflang' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <a id="value"></a>
            HTML,
            A::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <a lang="en"></a>
            HTML,
            A::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a lang="en"></a>
            HTML,
            A::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
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
            "'ping' must be serialized.",
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
            "'referrerpolicy' must be serialized.",
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
            "'referrerpolicy' must be serialized.",
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
            "'rel' must be serialized.",
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
            "'rel' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            A::tag()
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
            <a></a>
            HTML,
            A::tag()
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
            <a></a>
            HTML,
            A::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            A::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
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
            "'role' must be serialized.",
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
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <a class="value"></a>
            HTML,
            A::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a title="value"></a>
            HTML,
            A::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <a style='value'></a>
            HTML,
            A::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
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
            "'target' must be serialized.",
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
            "'target' must be serialized.",
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
            'Theme provider must contribute classes.',
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
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            (string) A::tag(),
            'Casting to string must produce HTML.',
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
            "'translate' must be serialized.",
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
            "'translate' must be serialized.",
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
            "'type' must be serialized.",
        );
    }

    public function testRenderWithTypeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <a type="text/html"></a>
            HTML,
            A::tag()
                ->type(Type::TEXT_HTML)
                ->render(),
            "'type' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            A::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <a class="from-global" id="value"></a>
            HTML,
            A::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            A::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $a = A::tag();

        self::assertNotSame(
            $a,
            $a->download(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->href(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->hreflang(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->ping(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->referrerpolicy(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->rel(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->target(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->type(''),
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
                implode("', '", Enum::normalizeStringArray(Direction::cases())),
            ),
        );

        A::tag()->dir('invalid-value');
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

        A::tag()->lang('invalid-value');
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

        A::tag()->referrerpolicy('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::REL->value,
                implode("', '", Enum::normalizeStringArray(Rel::cases())),
            ),
        );

        A::tag()->rel('invalid-value');
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

        A::tag()->role('invalid-value');
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

        A::tag()->translate('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TYPE->value,
                implode("', '", Enum::normalizeStringArray(Type::cases())),
            ),
        );

        A::tag()->type('invalid-value');
    }
}
