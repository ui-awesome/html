<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Blocking,
    ContentEditable,
    Crossorigin,
    Data,
    Direction,
    Draggable,
    Fetchpriority,
    GlobalAttribute,
    Language,
    Referrerpolicy,
    Role,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Script;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Script} `<script>` behavior.
 *
 * Test coverage.
 * - Applies `script`-specific attributes (`async`, `blocking`, `crossorigin`, `defer`, `fetchpriority`, `integrity`,
 *   `nomodule`, `referrerpolicy`, `src`, `type`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('metadata')]
final class ScriptTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $script = Script::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $script->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Script::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Script::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
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
            LineEndingNormalizer::normalize(
                Script::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <script accesskey="k">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script aria-pressed="true">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script aria-pressed="true">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script data-test="value">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script title="value">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script data-value="value">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script data-value="value">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <script aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()
                    ->ariaAttributes(
                        [
                            'controls' => static fn(): string => 'modal-1',
                            'hidden' => false,
                            'label' => 'Close',
                        ],
                    )
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAsync(): void
    {
        self::assertSame(
            <<<HTML
            <script async>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->async(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'async' attribute.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <script class="value">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <script autofocus>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            console.log('test');
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->begin() . "console.log('test');" . Script::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithBlocking(): void
    {
        self::assertSame(
            <<<HTML
            <script blocking="render">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->blocking('render')->render(),
            ),
            "Failed asserting that element renders correctly with 'blocking' attribute.",
        );
    }

    public function testRenderWithBlockingUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script blocking="render">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->blocking(Blocking::RENDER)->render(),
            ),
            "Failed asserting that element renders correctly with 'blocking' attribute using enum.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <script class="value">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            console.log('Hello');
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->content("console.log('Hello');")->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <script contenteditable="true">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script contenteditable="true">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithCrossorigin(): void
    {
        self::assertSame(
            <<<HTML
            <script crossorigin="anonymous">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->crossorigin('anonymous')->render(),
            ),
            "Failed asserting that element renders correctly with 'crossorigin' attribute.",
        );
    }

    public function testRenderWithCrossoriginUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script crossorigin="anonymous">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->crossorigin(Crossorigin::ANONYMOUS)->render(),
            ),
            "Failed asserting that element renders correctly with 'crossorigin' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <script data-value="value">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <script class="default-class">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <script class="default-class" title="default-title">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDefer(): void
    {
        self::assertSame(
            <<<HTML
            <script defer>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->defer(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'defer' attribute.",
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <script dir="ltr">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script dir="ltr">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <script draggable="true">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script draggable="true">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithFetchpriority(): void
    {
        self::assertSame(
            <<<HTML
            <script fetchpriority="high">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->fetchpriority('high')->render(),
            ),
            "Failed asserting that element renders correctly with 'fetchpriority' attribute.",
        );
    }

    public function testRenderWithFetchpriorityUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script fetchpriority="high">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->fetchpriority(Fetchpriority::HIGH)->render(),
            ),
            "Failed asserting that element renders correctly with 'fetchpriority' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Script::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <script class="default-class">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Script::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <script hidden>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <script id="test-id">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithIntegrity(): void
    {
        self::assertSame(
            <<<HTML
            <script integrity="sha384-abc123">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->integrity('sha384-abc123')->render(),
            ),
            "Failed asserting that element renders correctly with 'integrity' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <script lang="es">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script lang="es">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <script itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()
                    ->itemId('https://example.com/item')
                    ->itemProp('name')
                    ->itemRef('info')
                    ->itemScope(true)
                    ->itemType('https://schema.org/Thing')
                    ->render(),
            ),
            'Failed asserting that element renders correctly with microdata attributes.',
        );
    }

    public function testRenderWithNomodule(): void
    {
        self::assertSame(
            <<<HTML
            <script nomodule>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->nomodule(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'nomodule' attribute.",
        );
    }

    public function testRenderWithReferrerpolicy(): void
    {
        self::assertSame(
            <<<HTML
            <script referrerpolicy="no-referrer">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->referrerpolicy('no-referrer')->render(),
            ),
            "Failed asserting that element renders correctly with 'referrerpolicy' attribute.",
        );
    }

    public function testRenderWithReferrerpolicyUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script referrerpolicy="no-referrer">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->referrerpolicy(Referrerpolicy::NO_REFERRER)->render(),
            ),
            "Failed asserting that element renders correctly with 'referrerpolicy' attribute using enum.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()
                    ->addAriaAttribute('label', 'Close')
                    ->removeAriaAttribute('label')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()
                    ->addAttribute('data-test', 'value')
                    ->removeAttribute('data-test')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()
                    ->addDataAttribute('value', 'test')
                    ->removeDataAttribute('value')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <script role="banner">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->role('banner')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script role="banner">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->role(Role::BANNER)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <script spellcheck="true">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <script src="https://example.com/script.js">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->src('https://example.com/script.js')->render(),
            ),
            "Failed asserting that element renders correctly with 'src' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <script style='value'>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <script tabindex="3">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <script class="text-muted">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <script title="value">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->title('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Script::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <script translate="no">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <script translate="no">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithType(): void
    {
        self::assertSame(
            <<<HTML
            <script type="module">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag()->type('module')->render(),
            ),
            "Failed asserting that element renders correctly with 'type' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Script::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <script class="from-global" id="id-user">
            </script>
            HTML,
            LineEndingNormalizer::normalize(
                Script::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Script::class, []);
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $script = Script::tag();

        self::assertNotSame(
            $script,
            $script->async(true),
            'Should return a new instance when setting the async attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $script,
            $script->blocking(''),
            'Should return a new instance when setting the blocking attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $script,
            $script->crossorigin(''),
            'Should return a new instance when setting the crossorigin attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $script,
            $script->defer(true),
            'Should return a new instance when setting the defer attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $script,
            $script->fetchpriority(''),
            'Should return a new instance when setting the fetchpriority attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $script,
            $script->integrity(''),
            'Should return a new instance when setting the integrity attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $script,
            $script->nomodule(true),
            'Should return a new instance when setting the nomodule attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $script,
            $script->referrerpolicy(''),
            'Should return a new instance when setting the referrerpolicy attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $script,
            $script->src(''),
            'Should return a new instance when setting the src attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $script,
            $script->type(''),
            'Should return a new instance when setting the type attribute, ensuring immutability.',
        );
    }

    public function testThrowInvalidArgumentExceptionForSettingBlocking(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'blocking',
                implode("', '", Enum::normalizeArray(Blocking::cases())),
            ),
        );

        Script::tag()->blocking('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionForSettingCrossorigin(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'crossorigin',
                implode("', '", Enum::normalizeArray(Crossorigin::cases())),
            ),
        );

        Script::tag()->crossorigin('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionForSettingFetchpriority(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'fetchpriority',
                implode("', '", Enum::normalizeArray(Fetchpriority::cases())),
            ),
        );

        Script::tag()->fetchpriority('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionForSettingReferrerpolicy(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'referrerpolicy',
                implode("', '", Enum::normalizeArray(Referrerpolicy::cases())),
            ),
        );

        Script::tag()->referrerpolicy('invalid-value');
    }
}
