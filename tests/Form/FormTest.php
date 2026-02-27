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
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Form::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Form::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
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
            "Failed asserting that element renders correctly with 'html()' method.",
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
            "Failed asserting that element renders correctly with 'accept-charset' attribute.",
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
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
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
            "Failed asserting that element renders correctly with 'action' attribute.",
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
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <form aria-describedby="value">
            </form>
            HTML,
            Form::tag()
                ->addAriaAttribute('describedby', 'value')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <form id="form" aria-describedby="form-help">
            </form>
            HTML,
            Form::tag()
                ->addAriaAttribute('describedby', true)
                ->id('form')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <form>
            </form>
            HTML,
            Form::tag()
                ->addAriaAttribute('describedby', true)
                ->id(null)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and 'id'"
            . " is 'null'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueString(): void
    {
        self::assertSame(
            <<<HTML
            <form id="form" aria-describedby="form-help">
            </form>
            HTML,
            Form::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('form')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <form id="form" aria-describedby="form-help">
            </form>
            HTML,
            Form::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('form')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <form id="form" aria-describedby="form-help">
            </form>
            HTML,
            Form::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('form')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaDescribedByCustomSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <form id="form" aria-describedby="form-value">
            </form>
            HTML,
            Form::tag()
                ->addAriaAttribute('describedby', true)
                ->ariaDescribedBySuffix('value')
                ->id('form')
                ->render(),
            "Failed asserting that 'ariaDescribedBySuffix()' correctly applies the custom suffix.",
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
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <form id="form" aria-describedby="form-help">
            </form>
            HTML,
            Form::tag()
                ->attributes(['aria-describedby' => true])
                ->id('form')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <form id="form" aria-describedby="form-help">
            </form>
            HTML,
            Form::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('form')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'autocapitalize' attribute.",
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
            "Failed asserting that element renders correctly with 'autocapitalize' attribute.",
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
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
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
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
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
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
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
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
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
            "Failed asserting that element renders correctly with 'class' attribute.",
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
            "Failed asserting that element renders correctly with 'class' attribute.",
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
            'Failed asserting that element renders correctly with default values.',
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
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
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
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
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
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
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
            'Failed asserting that default configuration values are applied correctly.',
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
            'Failed asserting that default provider is applied correctly.',
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
            "Failed asserting that element renders correctly with 'dir' attribute.",
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
            "Failed asserting that element renders correctly with 'dir' attribute.",
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
            "Failed asserting that element renders correctly with 'draggable' attribute.",
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
            "Failed asserting that element renders correctly with 'draggable' attribute.",
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
            "Failed asserting that element renders correctly with 'enctype' attribute.",
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
            "Failed asserting that element renders correctly with 'enctype' attribute.",
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
            'Failed asserting that global defaults are applied correctly.',
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
            "Failed asserting that element renders correctly with 'hidden' attribute.",
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
            "Failed asserting that element renders correctly with 'id' attribute.",
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
            "Failed asserting that element renders correctly with 'lang' attribute.",
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
            "Failed asserting that element renders correctly with 'lang' attribute.",
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
            "Failed asserting that element renders correctly with 'method' attribute.",
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
            "Failed asserting that element renders correctly with 'method' attribute.",
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
            'Failed asserting that element renders correctly with microdata attributes.',
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
            "Failed asserting that element renders correctly with 'name' attribute.",
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
            "Failed asserting that element renders correctly with 'novalidate' attribute.",
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
            "Failed asserting that element renders correctly with 'rel' attribute.",
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
            "Failed asserting that element renders correctly with 'rel' attribute.",
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
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
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
            <form>
            </form>
            HTML,
            Form::tag()
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
            <form role="form">
            </form>
            HTML,
            Form::tag()
                ->role('form')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
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
            "Failed asserting that element renders correctly with 'role' attribute.",
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
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
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
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
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
            "Failed asserting that element renders correctly with 'style' attribute.",
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
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
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
            "Failed asserting that element renders correctly with 'target' attribute.",
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
            "Failed asserting that element renders correctly with 'target' attribute.",
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
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
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
            "Failed asserting that element renders correctly with 'title' attribute.",
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
            "Failed asserting that '__toString()' method renders correctly.",
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
            "Failed asserting that element renders correctly with 'translate' attribute.",
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
            "Failed asserting that element renders correctly with 'translate' attribute.",
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
            'Failed asserting that user-defined attributes override global defaults correctly.',
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
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $form,
            $form->action(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $form,
            $form->enctype(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $form,
            $form->method(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $form,
            $form->novalidate(true),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingAutocapitalize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'autocapitalize',
                implode("', '", Enum::normalizeArray(Autocapitalize::cases())),
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
                implode("', '", Enum::normalizeArray(ContentEditable::cases())),
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
                implode("', '", Enum::normalizeArray(Direction::cases())),
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
                implode("', '", Enum::normalizeArray(Draggable::cases())),
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
                implode("', '", Enum::normalizeArray(Enctype::cases())),
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
                implode("', '", Enum::normalizeArray(Language::cases())),
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
                implode("', '", Enum::normalizeArray(Method::cases())),
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
                implode("', '", Enum::normalizeArray(Rel::cases())),
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
                implode("', '", Enum::normalizeArray(Role::cases())),
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
                implode("', '", Enum::normalizeArray(Target::cases())),
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
                implode("', '", Enum::normalizeArray(Translate::cases())),
            ),
        );

        Form::tag()->translate('invalid-value');
    }
}
