<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
    Data,
    Direction,
    ElementAttribute,
    GlobalAttribute,
    Language,
    PopoverTargetAction,
    Role,
    Target,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\Button;
use UIAwesome\Html\Form\Values\{ButtonCommand, ButtonType};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Button} inline form behavior.
 *
 * Test coverage.
 * - Applies button specific attributes (`autofocus`, `command`, `commandfor`, `disabled`, `form`, `formaction`,
 *   `formenctype`, `formmethod`, `formnovalidate`, `formtarget`, `name`, `popovertarget`, `popovertargetaction`,
 *   `tabindex`, `type`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class ButtonTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Button::tag()
                ->content('<value>')
                ->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Button::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Button::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <button><value></button>
            HTML,
            Button::tag()
                ->html('<value>')
                ->render(),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <button accesskey="value"></button>
            HTML,
            Button::tag()
                ->accesskey('value')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <button aria-label="value"></button>
            HTML,
            Button::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button aria-label="value"></button>
            HTML,
            Button::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <button aria-describedby="value"></button>
            HTML,
            Button::tag()
                ->addAriaAttribute('describedby', 'value')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <button id="button" aria-describedby="button-help"></button>
            HTML,
            Button::tag()
                ->addAriaAttribute('describedby', true)
                ->id('button')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()
                ->addAriaAttribute('describedby', true)
                ->id(null)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and 'id'"
            . " is 'null'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <button id="button" aria-describedby="button-help"></button>
            <span>Suffix</span>
            HTML,
            Button::tag()
                ->addAriaAttribute('describedby', true)
                ->id('button')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueString(): void
    {
        self::assertSame(
            <<<HTML
            <button id="button" aria-describedby="button-help"></button>
            HTML,
            Button::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('button')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <button id="button" aria-describedby="button-help"></button>
            <span>Suffix</span>
            HTML,
            Button::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('button')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <button data-value="value"></button>
            HTML,
            Button::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button data-value="value"></button>
            HTML,
            Button::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <button aria-controls="value" aria-label="value"></button>
            HTML,
            Button::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <button id="button" aria-describedby="button-help"></button>
            HTML,
            Button::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('button')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <button id="button" aria-describedby="button-help"></button>
            HTML,
            Button::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('button')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaDescribedByCustomSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <button id="button" aria-describedby="button-value"></button>
            HTML,
            Button::tag()
                ->addAriaAttribute('describedby', true)
                ->ariaDescribedBySuffix('value')
                ->id('button')
                ->render(),
            "Failed asserting that 'ariaDescribedBySuffix()' correctly applies the custom suffix.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <button class="value"></button>
            HTML,
            Button::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <button id="button" aria-describedby="button-help"></button>
            HTML,
            Button::tag()
                ->attributes(['aria-describedby' => true])
                ->id('button')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <button id="button" aria-describedby="button-help"></button>
            HTML,
            Button::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('button')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <button autofocus></button>
            HTML,
            Button::tag()
                ->autofocus(true)
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <button class="value"></button>
            HTML,
            Button::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithCommand(): void
    {
        self::assertSame(
            <<<HTML
            <button command="show-modal"></button>
            HTML,
            Button::tag()
                ->command('show-modal')
                ->render(),
            "Failed asserting that element renders correctly with 'command' attribute.",
        );
    }

    public function testRenderWithCommandfor(): void
    {
        self::assertSame(
            <<<HTML
            <button commandfor="my-dialog"></button>
            HTML,
            Button::tag()
                ->commandfor('my-dialog')
                ->render(),
            "Failed asserting that element renders correctly with 'commandfor' attribute.",
        );
    }

    public function testRenderWithCommandUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button command="show-modal"></button>
            HTML,
            Button::tag()
                ->command(ButtonCommand::SHOW_MODAL)
                ->render(),
            "Failed asserting that element renders correctly with 'command' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <button>&lt;value&gt;</button>
            HTML,
            Button::tag()
                ->content('<value>')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <button data-value="value"></button>
            HTML,
            Button::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <button class="default-class"></button>
            HTML,
            Button::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <button class="default-class" title="default-title"></button>
            HTML,
            Button::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <button dir="ltr"></button>
            HTML,
            Button::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button dir="ltr"></button>
            HTML,
            Button::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <button disabled></button>
            HTML,
            Button::tag()
                ->disabled(true)
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <button form="value"></button>
            HTML,
            Button::tag()
                ->form('value')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <button formaction="/submit-handler"></button>
            HTML,
            Button::tag()
                ->formaction('/submit-handler')
                ->render(),
            "Failed asserting that element renders correctly with 'formaction' attribute.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <button formenctype="multipart/form-data"></button>
            HTML,
            Button::tag()
                ->formenctype('multipart/form-data')
                ->render(),
            "Failed asserting that element renders correctly with 'formenctype' attribute.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <button formmethod="post"></button>
            HTML,
            Button::tag()
                ->formmethod('post')
                ->render(),
            "Failed asserting that element renders correctly with 'formmethod' attribute.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <button formnovalidate></button>
            HTML,
            Button::tag()
                ->formnovalidate(true)
                ->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' attribute.",
        );
    }

    public function testRenderWithFormnovalidateValueFalse(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()
                ->formnovalidate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' set to 'false'.",
        );
    }

    public function testRenderWithFormnovalidateValueNull(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()
                ->formnovalidate(null)
                ->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' set to 'null'.",
        );
    }

    public function testRenderWithFormtarget(): void
    {
        self::assertSame(
            <<<HTML
            <button formtarget="_blank"></button>
            HTML,
            Button::tag()
                ->formtarget('_blank')
                ->render(),
            "Failed asserting that element renders correctly with 'formtarget' attribute.",
        );
    }

    public function testRenderWithFormtargetUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button formtarget="_blank"></button>
            HTML,
            Button::tag()
                ->formtarget(Target::BLANK)
                ->render(),
            "Failed asserting that element renders correctly with 'formtarget' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Button::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <button class="default-class"></button>
            HTML,
            Button::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            Button::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <button hidden></button>
            HTML,
            Button::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <button id="value"></button>
            HTML,
            Button::tag()
                ->id('value')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <button lang="en"></button>
            HTML,
            Button::tag()
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button lang="en"></button>
            HTML,
            Button::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <button name="value"></button>
            HTML,
            Button::tag()
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPopoverTarget(): void
    {
        self::assertSame(
            <<<HTML
            <button popovertarget="my-popover"></button>
            HTML,
            Button::tag()
                ->popoverTarget('my-popover')
                ->render(),
            "Failed asserting that element renders correctly with 'popovertarget' attribute.",
        );
    }

    public function testRenderWithPopoverTargetAction(): void
    {
        self::assertSame(
            <<<HTML
            <button popovertargetaction="toggle"></button>
            HTML,
            Button::tag()
                ->popoverTargetAction('toggle')
                ->render(),
            "Failed asserting that element renders correctly with 'popovertargetaction' attribute.",
        );
    }

    public function testRenderWithPopoverTargetActionUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button popovertargetaction="toggle"></button>
            HTML,
            Button::tag()
                ->popoverTargetAction(PopoverTargetAction::TOGGLE)
                ->render(),
            "Failed asserting that element renders correctly with 'popovertargetaction' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()
                ->addAriaAttribute('label', 'value')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()
                ->setAttribute('class', 'value')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <button role="button"></button>
            HTML,
            Button::tag()
                ->role('button')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button role="button"></button>
            HTML,
            Button::tag()
                ->role(Role::BUTTON)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <button class="value"></button>
            HTML,
            Button::tag()
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button title="value"></button>
            HTML,
            Button::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <button style='value'></button>
            HTML,
            Button::tag()
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <button tabindex="1"></button>
            HTML,
            Button::tag()
                ->tabIndex(1)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <button class="text-muted"></button>
            HTML,
            Button::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <button title="value"></button>
            HTML,
            Button::tag()
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            (string) Button::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <button translate="no"></button>
            HTML,
            Button::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button translate="no"></button>
            HTML,
            Button::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithType(): void
    {
        self::assertSame(
            <<<HTML
            <button type="submit"></button>
            HTML,
            Button::tag()
                ->type('submit')
                ->render(),
            "Failed asserting that element renders correctly with 'type' attribute.",
        );
    }

    public function testRenderWithTypeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button type="submit"></button>
            HTML,
            Button::tag()
                ->type(ButtonType::SUBMIT)
                ->render(),
            "Failed asserting that element renders correctly with 'type' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Button::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <button class="from-global" id="value"></button>
            HTML,
            Button::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            Button::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <button value="value"></button>
            HTML,
            Button::tag()
                ->value('value')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
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

        Button::tag()->dir('invalid-value');
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

        Button::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingPopoverTargetAction(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                ElementAttribute::POPOVERTARGETACTION->value,
                implode("', '", Enum::normalizeArray(PopoverTargetAction::cases())),
            ),
        );

        Button::tag()->popoverTargetAction('invalid-value');
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

        Button::tag()->role('invalid-value');
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

        Button::tag()->tabIndex(-2);
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

        Button::tag()->translate('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TYPE->value,
                implode("', '", Enum::normalizeArray(ButtonType::cases())),
            ),
        );

        Button::tag()->type('invalid-value');
    }
}
