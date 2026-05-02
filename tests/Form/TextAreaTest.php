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
    Autocomplete,
    ContentEditable,
    Data,
    Direction,
    Draggable,
    GlobalAttribute,
    Language,
    Role,
    Translate,
};
use UIAwesome\Html\Attribute\Values\{Autocapitalize, Autocorrect};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\TextArea;
use UIAwesome\Html\Form\Values\Wrap;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see TextArea} rendering and attribute behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Covers all `<textarea>` element-specific attributes per MDN specification.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class TextAreaTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            TextArea::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            TextArea::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            TextArea::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <textarea>
            <value>
            </textarea>
            HTML,
            TextArea::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <textarea accesskey="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <textarea aria-label="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea aria-label="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <textarea data-value="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea data-value="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <textarea onclick="alert(&apos;Clicked!&apos;)">
            </textarea>
            HTML,
            TextArea::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <textarea aria-controls="value" aria-label="value">
            </textarea>
            HTML,
            TextArea::tag()
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
            <textarea class="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocapitalize(): void
    {
        self::assertSame(
            <<<HTML
            <textarea autocapitalize="sentences">
            </textarea>
            HTML,
            TextArea::tag()
                ->autocapitalize('sentences')
                ->render(),
            "'autocapitalize' must be serialized.",
        );
    }

    public function testRenderWithAutocapitalizeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea autocapitalize="sentences">
            </textarea>
            HTML,
            TextArea::tag()
                ->autocapitalize(Autocapitalize::SENTENCES)
                ->render(),
            "'autocapitalize' must be serialized.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <textarea autocomplete="on">
            </textarea>
            HTML,
            TextArea::tag()
                ->autocomplete('on')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea autocomplete="on">
            </textarea>
            HTML,
            TextArea::tag()
                ->autocomplete(Autocomplete::ON)
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocorrect(): void
    {
        self::assertSame(
            <<<HTML
            <textarea autocorrect="on">
            </textarea>
            HTML,
            TextArea::tag()
                ->autocorrect('on')
                ->render(),
            "'autocorrect' must be serialized.",
        );
    }

    public function testRenderWithAutocorrectUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea autocorrect="on">
            </textarea>
            HTML,
            TextArea::tag()
                ->autocorrect(Autocorrect::ON)
                ->render(),
            "'autocorrect' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <textarea autofocus>
            </textarea>
            HTML,
            TextArea::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <textarea>
            Content
            </textarea>
            HTML,
            TextArea::tag()->begin() . 'Content' . TextArea::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <textarea class="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea class="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithCols(): void
    {
        self::assertSame(
            <<<HTML
            <textarea cols="20">
            </textarea>
            HTML,
            TextArea::tag()
                ->cols(20)
                ->render(),
            "'cols' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <textarea>
            value
            </textarea>
            HTML,
            TextArea::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <textarea contenteditable="true">
            </textarea>
            HTML,
            TextArea::tag()
                ->contentEditable(true)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea contenteditable="true">
            </textarea>
            HTML,
            TextArea::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <textarea data-value="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <textarea class="default-class">
            </textarea>
            HTML,
            TextArea::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <textarea class="default-class">
            </textarea>
            HTML,
            TextArea::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <textarea dir="ltr">
            </textarea>
            HTML,
            TextArea::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <textarea dirname="comment.dir">
            </textarea>
            HTML,
            TextArea::tag()
                ->dirname('comment.dir')
                ->render(),
            "'dirname' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea dir="ltr">
            </textarea>
            HTML,
            TextArea::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <textarea disabled>
            </textarea>
            HTML,
            TextArea::tag()
                ->disabled(true)
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <textarea draggable="true">
            </textarea>
            HTML,
            TextArea::tag()
                ->draggable(true)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea draggable="true">
            </textarea>
            HTML,
            TextArea::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <textarea form="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->form('value')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            TextArea::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <textarea class="default-class">
            </textarea>
            HTML,
            TextArea::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            TextArea::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <textarea hidden>
            </textarea>
            HTML,
            TextArea::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <textarea id="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <textarea lang="en">
            </textarea>
            HTML,
            TextArea::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea lang="en">
            </textarea>
            HTML,
            TextArea::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <textarea maxlength="100">
            </textarea>
            HTML,
            TextArea::tag()
                ->maxlength(100)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <textarea itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </textarea>
            HTML,
            TextArea::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
            'Microdata attributes must be serialized.',
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <textarea minlength="10">
            </textarea>
            HTML,
            TextArea::tag()
                ->minlength(10)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <textarea name="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <textarea placeholder="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <textarea readonly>
            </textarea>
            HTML,
            TextArea::tag()
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <textarea>
            </textarea>
            HTML,
            TextArea::tag()
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
            <textarea>
            </textarea>
            HTML,
            TextArea::tag()
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
            <textarea>
            </textarea>
            HTML,
            TextArea::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <textarea required>
            </textarea>
            HTML,
            TextArea::tag()
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <textarea role="textbox">
            </textarea>
            HTML,
            TextArea::tag()
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea role="textbox">
            </textarea>
            HTML,
            TextArea::tag()
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRows(): void
    {
        self::assertSame(
            <<<HTML
            <textarea rows="5">
            </textarea>
            HTML,
            TextArea::tag()
                ->rows(5)
                ->render(),
            "'rows' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <textarea class="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea title="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <textarea spellcheck="true">
            </textarea>
            HTML,
            TextArea::tag()
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <textarea style='value'>
            </textarea>
            HTML,
            TextArea::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <textarea tabindex="3">
            </textarea>
            HTML,
            TextArea::tag()
                ->tabIndex(3)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <textarea class="text-muted">
            </textarea>
            HTML,
            TextArea::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <textarea title="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <textarea>
            </textarea>
            HTML,
            (string) TextArea::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <textarea translate="no">
            </textarea>
            HTML,
            TextArea::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea translate="no">
            </textarea>
            HTML,
            TextArea::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            TextArea::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <textarea class="from-global" id="value">
            </textarea>
            HTML,
            TextArea::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            TextArea::class,
            [],
        );
    }

    public function testRenderWithWrap(): void
    {
        self::assertSame(
            <<<HTML
            <textarea wrap="hard">
            </textarea>
            HTML,
            TextArea::tag()
                ->wrap('hard')
                ->render(),
            "'wrap' must be serialized.",
        );
    }

    public function testRenderWithWrapUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <textarea wrap="hard">
            </textarea>
            HTML,
            TextArea::tag()
                ->wrap(Wrap::HARD)
                ->render(),
            "'wrap' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $textArea = TextArea::tag();

        self::assertNotSame(
            $textArea,
            $textArea->cols(1),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $textArea,
            $textArea->rows(1),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $textArea,
            $textArea->wrap(''),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingAutocapitalize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::AUTOCAPITALIZE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Autocapitalize::cases())),
            ),
        );

        TextArea::tag()->autocapitalize('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingAutocorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::AUTOCORRECT->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Autocorrect::cases())),
            ),
        );

        TextArea::tag()->autocorrect('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingCols(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '0',
                'cols',
                'value > 0',
            ),
        );

        TextArea::tag()->cols(0);
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

        TextArea::tag()->contentEditable('invalid-value');
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

        TextArea::tag()->dir('invalid-value');
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

        TextArea::tag()->draggable('invalid-value');
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

        TextArea::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingMaxlength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-1',
                Attribute::MAXLENGTH->value,
                'value >= 0',
            ),
        );

        TextArea::tag()->maxlength(-1);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingMinlength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-1',
                Attribute::MINLENGTH->value,
                'value >= 0',
            ),
        );

        TextArea::tag()->minlength(-1);
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

        TextArea::tag()->role('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '0',
                'rows',
                'value > 0',
            ),
        );

        TextArea::tag()->rows(0);
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

        TextArea::tag()->tabIndex(-2);
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

        TextArea::tag()->translate('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingWrap(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'wrap',
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Wrap::cases())),
            ),
        );

        TextArea::tag()->wrap('invalid-value');
    }
}
