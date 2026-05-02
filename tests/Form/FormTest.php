<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
    Autocapitalize,
    Autocomplete,
    ContentEditable,
    Data,
    Direction,
    Draggable,
    GlobalAttribute,
    Language,
    Rel,
    Role,
    Target,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\Form;
use UIAwesome\Html\Form\Values\{Enctype, Method};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Form} rendering and attribute behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*` and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Covers all `<form>` element-specific attributes per MDN specification.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class FormTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Form::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Form::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Form::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <form>
            <value>
            </form>
            HTML,
            Form::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAcceptCharset(): void
    {
        self::assertSame(
            <<<HTML
            <form accept-charset="UTF-8">
            </form>
            HTML,
            Form::tag()
                ->acceptCharset('UTF-8')
                ->render(),
            "'accept-charset' must be serialized.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <form accesskey="value">
            </form>
            HTML,
            Form::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAction(): void
    {
        self::assertSame(
            <<<HTML
            <form action="/submit">
            </form>
            HTML,
            Form::tag()
                ->action('/submit')
                ->render(),
            "'action' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <form aria-label="value">
            </form>
            HTML,
            Form::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form aria-label="value">
            </form>
            HTML,
            Form::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <form data-value="value">
            </form>
            HTML,
            Form::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form data-value="value">
            </form>
            HTML,
            Form::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <form onclick="alert(&apos;Clicked!&apos;)">
            </form>
            HTML,
            Form::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <form aria-controls="value" aria-label="value">
            </form>
            HTML,
            Form::tag()
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
            <form class="value">
            </form>
            HTML,
            Form::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocapitalize(): void
    {
        self::assertSame(
            <<<HTML
            <form autocapitalize="sentences">
            </form>
            HTML,
            Form::tag()
                ->autocapitalize('sentences')
                ->render(),
            "'autocapitalize' must be serialized.",
        );
    }

    public function testRenderWithAutocapitalizeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form autocapitalize="sentences">
            </form>
            HTML,
            Form::tag()
                ->autocapitalize(Autocapitalize::SENTENCES)
                ->render(),
            "'autocapitalize' must be serialized.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <form autocomplete="on">
            </form>
            HTML,
            Form::tag()
                ->autocomplete('on')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form autocomplete="on">
            </form>
            HTML,
            Form::tag()
                ->autocomplete(Autocomplete::ON)
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <form autofocus>
            </form>
            HTML,
            Form::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <form>
            Content
            </form>
            HTML,
            Form::tag()->begin() . 'Content' . Form::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <form class="value">
            </form>
            HTML,
            Form::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form class="value">
            </form>
            HTML,
            Form::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <form>
            value
            </form>
            HTML,
            Form::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <form contenteditable="true">
            </form>
            HTML,
            Form::tag()
                ->contentEditable(true)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form contenteditable="true">
            </form>
            HTML,
            Form::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <form data-value="value">
            </form>
            HTML,
            Form::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <form class="default-class">
            </form>
            HTML,
            Form::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <form class="default-class">
            </form>
            HTML,
            Form::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <form dir="ltr">
            </form>
            HTML,
            Form::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form dir="ltr">
            </form>
            HTML,
            Form::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <form draggable="true">
            </form>
            HTML,
            Form::tag()
                ->draggable(true)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form draggable="true">
            </form>
            HTML,
            Form::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithEnctype(): void
    {
        self::assertSame(
            <<<HTML
            <form enctype="multipart/form-data">
            </form>
            HTML,
            Form::tag()
                ->enctype('multipart/form-data')
                ->render(),
            "'enctype' must be serialized.",
        );
    }

    public function testRenderWithEnctypeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form enctype="multipart/form-data">
            </form>
            HTML,
            Form::tag()
                ->enctype(Enctype::MULTIPART_FORM_DATA)
                ->render(),
            "'enctype' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Form::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <form class="default-class">
            </form>
            HTML,
            Form::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Form::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <form hidden>
            </form>
            HTML,
            Form::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <form id="value">
            </form>
            HTML,
            Form::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <form lang="en">
            </form>
            HTML,
            Form::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form lang="en">
            </form>
            HTML,
            Form::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMethod(): void
    {
        self::assertSame(
            <<<HTML
            <form method="post">
            </form>
            HTML,
            Form::tag()
                ->method('post')
                ->render(),
            "'method' must be serialized.",
        );
    }

    public function testRenderWithMethodUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form method="post">
            </form>
            HTML,
            Form::tag()
                ->method(Method::POST)
                ->render(),
            "'method' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <form itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </form>
            HTML,
            Form::tag()
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
            <form name="value">
            </form>
            HTML,
            Form::tag()
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithNovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <form novalidate>
            </form>
            HTML,
            Form::tag()
                ->novalidate(true)
                ->render(),
            "'novalidate' must be serialized.",
        );
    }

    public function testRenderWithRel(): void
    {
        self::assertSame(
            <<<HTML
            <form rel="noopener">
            </form>
            HTML,
            Form::tag()
                ->rel('noopener')
                ->render(),
            "'rel' must be serialized.",
        );
    }

    public function testRenderWithRelUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form rel="noopener">
            </form>
            HTML,
            Form::tag()
                ->rel(Rel::NOOPENER)
                ->render(),
            "'rel' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <form>
            </form>
            HTML,
            Form::tag()
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
            <form>
            </form>
            HTML,
            Form::tag()
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
            <form>
            </form>
            HTML,
            Form::tag()
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
            <form role="form">
            </form>
            HTML,
            Form::tag()
                ->role('form')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form role="form">
            </form>
            HTML,
            Form::tag()
                ->role(Role::FORM)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <form class="value">
            </form>
            HTML,
            Form::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form title="value">
            </form>
            HTML,
            Form::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <form spellcheck="true">
            </form>
            HTML,
            Form::tag()
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <form style='value'>
            </form>
            HTML,
            Form::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <form tabindex="3">
            </form>
            HTML,
            Form::tag()
                ->tabIndex(3)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithTarget(): void
    {
        self::assertSame(
            <<<HTML
            <form target="_blank">
            </form>
            HTML,
            Form::tag()
                ->target('_blank')
                ->render(),
            "'target' must be serialized.",
        );
    }

    public function testRenderWithTargetUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form target="_blank">
            </form>
            HTML,
            Form::tag()
                ->target(Target::BLANK)
                ->render(),
            "'target' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <form class="text-muted">
            </form>
            HTML,
            Form::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <form title="value">
            </form>
            HTML,
            Form::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <form>
            </form>
            HTML,
            (string) Form::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <form translate="no">
            </form>
            HTML,
            Form::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <form translate="no">
            </form>
            HTML,
            Form::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Form::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <form class="from-global" id="value">
            </form>
            HTML,
            Form::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Form::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $form = Form::tag();

        self::assertNotSame(
            $form,
            $form->acceptCharset(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $form,
            $form->action(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $form,
            $form->enctype(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $form,
            $form->method(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $form,
            $form->novalidate(true),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingAutocapitalize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'autocapitalize',
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Autocapitalize::cases())),
            ),
        );

        Form::tag()->autocapitalize('invalid-value');
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

        Form::tag()->contentEditable('invalid-value');
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

        Form::tag()->dir('invalid-value');
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

        Form::tag()->draggable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingEnctype(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'enctype',
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Enctype::cases())),
            ),
        );

        Form::tag()->enctype('invalid-value');
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

        Form::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'method',
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Method::cases())),
            ),
        );

        Form::tag()->method('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::REL->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Rel::cases())),
            ),
        );

        Form::tag()->rel('invalid-value');
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

        Form::tag()->role('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTarget(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TARGET->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Target::cases())),
            ),
        );

        Form::tag()->target('invalid-value');
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

        Form::tag()->translate('invalid-value');
    }
}
