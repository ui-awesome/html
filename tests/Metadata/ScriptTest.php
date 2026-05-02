<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
    Blocking,
    ContentEditable,
    Crossorigin,
    Data,
    Direction,
    Draggable,
    ElementAttribute,
    Fetchpriority,
    GlobalAttribute,
    Language,
    Referrerpolicy,
    Role,
    Translate,
    Type,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Script;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Script} rendering and script attribute behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies script specific attributes (`async`, `blocking`, `crossorigin`, `defer`, `fetchpriority`, `integrity`,
 *   `nomodule`, `referrerpolicy`, `src`, `type`) and renders expected output.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('metadata')]
final class ScriptTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Script::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Script::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Script::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            <value>
            </script>
            HTML,
            Script::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <script accesskey="value">
            </script>
            HTML,
            Script::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script aria-label="value">
            </script>
            HTML,
            Script::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script aria-label="value">
            </script>
            HTML,
            Script::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script data-value="value">
            </script>
            HTML,
            Script::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script data-value="value">
            </script>
            HTML,
            Script::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <script onclick="alert(&apos;Clicked!&apos;)">
            </script>
            HTML,
            Script::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <script aria-controls="value" aria-label="value">
            </script>
            HTML,
            Script::tag()
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

    public function testRenderWithAsync(): void
    {
        self::assertSame(
            <<<HTML
            <script async>
            </script>
            HTML,
            Script::tag()
                ->async(true)
                ->render(),
            "'async' must be serialized.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <script class="value">
            </script>
            HTML,
            Script::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <script autofocus>
            </script>
            HTML,
            Script::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            Content
            </script>
            HTML,
            Script::tag()->begin() . 'Content' . Script::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithBlocking(): void
    {
        self::assertSame(
            <<<HTML
            <script blocking="render">
            </script>
            HTML,
            Script::tag()
                ->blocking('render')
                ->render(),
            "'blocking' must be serialized.",
        );
    }

    public function testRenderWithBlockingUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script blocking="render">
            </script>
            HTML,
            Script::tag()
                ->blocking(Blocking::RENDER)
                ->render(),
            "'blocking' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <script class="value">
            </script>
            HTML,
            Script::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            &lt;value&gt;
            </script>
            HTML,
            Script::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <script contenteditable="true">
            </script>
            HTML,
            Script::tag()
                ->contentEditable(true)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script contenteditable="true">
            </script>
            HTML,
            Script::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithCrossorigin(): void
    {
        self::assertSame(
            <<<HTML
            <script crossorigin="anonymous">
            </script>
            HTML,
            Script::tag()
                ->crossorigin('anonymous')
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithCrossoriginUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script crossorigin="anonymous">
            </script>
            HTML,
            Script::tag()
                ->crossorigin(Crossorigin::ANONYMOUS)
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <script data-value="value">
            </script>
            HTML,
            Script::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <script class="default-class">
            </script>
            HTML,
            Script::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <script class="default-class">
            </script>
            HTML,
            Script::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            Script::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefer(): void
    {
        self::assertSame(
            <<<HTML
            <script defer>
            </script>
            HTML,
            Script::tag()
                ->defer(true)
                ->render(),
            "'defer' must be serialized.",
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <script dir="ltr">
            </script>
            HTML,
            Script::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script dir="ltr">
            </script>
            HTML,
            Script::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <script draggable="true">
            </script>
            HTML,
            Script::tag()
                ->draggable(true)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script draggable="true">
            </script>
            HTML,
            Script::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <script onfocus="handleFocus()" onblur="handleBlur()">
            </script>
            HTML,
            Script::tag()
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

    public function testRenderWithFetchpriority(): void
    {
        self::assertSame(
            <<<HTML
            <script fetchpriority="high">
            </script>
            HTML,
            Script::tag()
                ->fetchpriority('high')
                ->render(),
            "'fetchpriority' must be serialized.",
        );
    }

    public function testRenderWithFetchpriorityUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script fetchpriority="high">
            </script>
            HTML,
            Script::tag()
                ->fetchpriority(Fetchpriority::HIGH)
                ->render(),
            "'fetchpriority' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Script::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <script class="default-class">
            </script>
            HTML,
            Script::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Script::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <script hidden>
            </script>
            HTML,
            Script::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <script id="value">
            </script>
            HTML,
            Script::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithIntegrity(): void
    {
        self::assertSame(
            <<<HTML
            <script integrity="value">
            </script>
            HTML,
            Script::tag()
                ->integrity('value')
                ->render(),
            "'integrity' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <script lang="en">
            </script>
            HTML,
            Script::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script lang="en">
            </script>
            HTML,
            Script::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <script itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </script>
            HTML,
            Script::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
            'Microdata attributes must be serialized.',
        );
    }

    public function testRenderWithNomodule(): void
    {
        self::assertSame(
            <<<HTML
            <script nomodule>
            </script>
            HTML,
            Script::tag()
                ->nomodule(true)
                ->render(),
            "'nomodule' must be serialized.",
        );
    }

    public function testRenderWithReferrerpolicy(): void
    {
        self::assertSame(
            <<<HTML
            <script referrerpolicy="no-referrer">
            </script>
            HTML,
            Script::tag()
                ->referrerpolicy('no-referrer')
                ->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    public function testRenderWithReferrerpolicyUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script referrerpolicy="no-referrer">
            </script>
            HTML,
            Script::tag()
                ->referrerpolicy(Referrerpolicy::NO_REFERRER)
                ->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            Script::tag()
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
            <script>
            </script>
            HTML,
            Script::tag()
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
            <script>
            </script>
            HTML,
            Script::tag()
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
            <script>
            </script>
            HTML,
            Script::tag()
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
            <script role="banner">
            </script>
            HTML,
            Script::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script role="banner">
            </script>
            HTML,
            Script::tag()
                ->role(Role::BANNER)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script class="value">
            </script>
            HTML,
            Script::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script title="value">
            </script>
            HTML,
            Script::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <script spellcheck="true">
            </script>
            HTML,
            Script::tag()
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <script src="value">
            </script>
            HTML,
            Script::tag()
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <script style='value'>
            </script>
            HTML,
            Script::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <script tabindex="3">
            </script>
            HTML,
            Script::tag()
                ->tabIndex(3)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <script class="text-muted">
            </script>
            HTML,
            Script::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <script title="value">
            </script>
            HTML,
            Script::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            (string) Script::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <script translate="no">
            </script>
            HTML,
            Script::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script translate="no">
            </script>
            HTML,
            Script::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithType(): void
    {
        self::assertSame(
            <<<HTML
            <script type="module">
            </script>
            HTML,
            Script::tag()
                ->type('module')
                ->render(),
            "'type' must be serialized.",
        );
    }

    public function testRenderWithTypeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script type="module">
            </script>
            HTML,
            Script::tag()
                ->type(Type::MODULE)
                ->render(),
            "'type' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Script::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <script class="from-global" id="value">
            </script>
            HTML,
            Script::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Script::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $script = Script::tag();

        self::assertNotSame(
            $script,
            $script->async(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->blocking(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->crossorigin(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->defer(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->fetchpriority(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->integrity(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->nomodule(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->referrerpolicy(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->type(''),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingBlocking(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                ElementAttribute::BLOCKING->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Blocking::cases())),
            ),
        );

        Script::tag()->blocking('invalid-value');
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

        Script::tag()->contentEditable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingCrossorigin(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::CROSSORIGIN->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Crossorigin::cases())),
            ),
        );

        Script::tag()->crossorigin('invalid-value');
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

        Script::tag()->dir('invalid-value');
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

        Script::tag()->draggable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingFetchpriority(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::FETCHPRIORITY->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Fetchpriority::cases())),
            ),
        );

        Script::tag()->fetchpriority('invalid-value');
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

        Script::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingReferrerpolicy(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::REFERRERPOLICY->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Referrerpolicy::cases())),
            ),
        );

        Script::tag()->referrerpolicy('invalid-value');
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

        Script::tag()->role('invalid-value');
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

        Script::tag()->tabIndex(-2);
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

        Script::tag()->translate('invalid-value');
    }
}
