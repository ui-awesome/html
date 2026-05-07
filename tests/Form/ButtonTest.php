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
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Button} inline form behavior.
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
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Button::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Button::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
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
            'Raw HTML content must be applied.',
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
            "'accesskey' must be serialized.",
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
            'ARIA attribute must be added.',
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
            'ARIA attribute must be added.',
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
            'Data attribute must be added.',
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
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <button onclick="alert(&apos;Clicked!&apos;)"></button>
            HTML,
            Button::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
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
            'ARIA attribute map must be applied.',
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
            'Attribute map must be applied.',
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
            "'autofocus' must be serialized.",
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
            "'class' must be serialized.",
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
            "'command' must be serialized.",
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
            "'commandfor' must be serialized.",
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
            "'command' must be serialized.",
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
            'Bare element must render with no attributes.',
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
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <button class="default-class"></button>
            HTML,
            Button::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
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
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()->render(),
            'Bare element must render with no attributes.',
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
            "'dir' must be serialized.",
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
            "'dir' must be serialized.",
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
            "'disabled' must be serialized.",
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
            "'form' must be serialized.",
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
            "'formaction' must be serialized.",
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
            "'formenctype' must be serialized.",
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
            "'formmethod' must be serialized.",
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
            "'formnovalidate' must be serialized.",
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
            'formnovalidate must be omitted when `false`.',
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
            'formnovalidate must be omitted when `null`.',
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
            "'formtarget' must be serialized.",
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
            "'formtarget' must be serialized.",
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
            'Factory defaults must be applied.',
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
            "'hidden' must be serialized.",
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
            "'id' must be serialized.",
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
            "'lang' must be serialized.",
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
            "'lang' must be serialized.",
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
            "'name' must be serialized.",
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
            "'popovertarget' must be serialized.",
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
            "'popovertargetaction' must be serialized.",
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
            "'popovertargetaction' must be serialized.",
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
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()
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
            <button></button>
            HTML,
            Button::tag()
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
            <button role="button"></button>
            HTML,
            Button::tag()
                ->role('button')
                ->render(),
            "'role' must be serialized.",
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
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <button class="value"></button>
            HTML,
            Button::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <button title="value"></button>
            HTML,
            Button::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
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
            "'style' must be serialized.",
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
            "'tabindex' must be serialized.",
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
            'Theme provider must contribute classes.',
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
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            (string) Button::tag(),
            'Casting to string must produce HTML.',
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
            "'translate' must be serialized.",
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
            "'translate' must be serialized.",
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
            "'type' must be serialized.",
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
            "'type' must be serialized.",
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
            'User attributes must take precedence over factory defaults.',
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
            "'value' must be serialized.",
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

        Button::tag()->dir('invalid-value');
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

        Button::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingPopoverTargetAction(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                ElementAttribute::POPOVERTARGETACTION->value,
                implode("', '", Enum::normalizeStringArray(PopoverTargetAction::cases())),
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
                implode("', '", Enum::normalizeStringArray(Role::cases())),
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
                implode("', '", Enum::normalizeStringArray(Translate::cases())),
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
                implode("', '", Enum::normalizeStringArray(ButtonType::cases())),
            ),
        );

        Button::tag()->type('invalid-value');
    }
}
