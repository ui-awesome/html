<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Phrasing;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Phrasing\Span;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Span} inline phrasing behavior.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('phrasing')]
final class SpanTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Span::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Span::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Span::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <span><value></span>
            HTML,
            Span::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <span accesskey="value"></span>
            HTML,
            Span::tag()->accesskey('value')->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <span aria-label="value"></span>
            HTML,
            Span::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <span aria-label="value"></span>
            HTML,
            Span::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <span data-value="value"></span>
            HTML,
            Span::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <span data-value="value"></span>
            HTML,
            Span::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <span onclick="alert(&apos;Clicked!&apos;)"></span>
            HTML,
            Span::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <span aria-controls="value" aria-label="value"></span>
            HTML,
            Span::tag()
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
            <span class="value"></span>
            HTML,
            Span::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <span class="value"></span>
            HTML,
            Span::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <span>&lt;value&gt;</span>
            HTML,
            Span::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <span data-value="value"></span>
            HTML,
            Span::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <span class="default-class"></span>
            HTML,
            Span::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <span class="default-class" title="default-title"></span>
            HTML,
            Span::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <span></span>
            HTML,
            Span::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <span dir="ltr"></span>
            HTML,
            Span::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <span dir="ltr"></span>
            HTML,
            Span::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <span onfocus="handleFocus()" onblur="handleBlur()"></span>
            HTML,
            Span::tag()
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
            Span::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <span class="default-class"></span>
            HTML,
            Span::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Span::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <span hidden></span>
            HTML,
            Span::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <span id="value"></span>
            HTML,
            Span::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <span lang="en"></span>
            HTML,
            Span::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <span lang="en"></span>
            HTML,
            Span::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <span></span>
            HTML,
            Span::tag()
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
            <span></span>
            HTML,
            Span::tag()
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
            <span></span>
            HTML,
            Span::tag()
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
            <span></span>
            HTML,
            Span::tag()
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
            <span role="button"></span>
            HTML,
            Span::tag()
                ->role('button')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <span role="button"></span>
            HTML,
            Span::tag()
                ->role(Role::BUTTON)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <span class="value"></span>
            HTML,
            Span::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <span title="value"></span>
            HTML,
            Span::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <span style='value'></span>
            HTML,
            Span::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <span class="text-muted"></span>
            HTML,
            Span::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <span title="value"></span>
            HTML,
            Span::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <span></span>
            HTML,
            (string) Span::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <span translate="no"></span>
            HTML,
            Span::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <span translate="no"></span>
            HTML,
            Span::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Span::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <span class="from-global" id="value"></span>
            HTML,
            Span::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Span::class,
            [],
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

        Span::tag()->dir('invalid-value');
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

        Span::tag()->lang('invalid-value');
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

        Span::tag()->role('invalid-value');
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

        Span::tag()->translate('invalid-value');
    }
}
