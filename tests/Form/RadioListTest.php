<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Stringable;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    ContentEditable,
    Data,
    Direction,
    Draggable,
    GlobalAttribute,
    Language,
    Role,
    Translate,
};
use UIAwesome\Html\Form\{ChoiceItem, RadioList};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see RadioList} rendering and attribute behavior.
 */
#[Group('form')]
final class RadioListTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            RadioList::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            RadioList::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            RadioList::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <value>
            </div>
            HTML,
            RadioList::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testItemsReplaceExistingItems(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <input type="radio" value="2">
            <label>Two</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->items(ChoiceItem::tag()->label('Two')->value(2))
                ->render(),
            'Items must replace existing items when set.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <div accesskey="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->accesskey('value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div aria-label="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addAriaAttribute('label', 'value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div aria-label="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div data-value="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addDataAttribute('value', 'value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div data-value="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <div onclick="alert(&apos;Clicked!&apos;)">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div aria-controls="value" aria-label="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->attributes(['class' => 'value'])
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <div autofocus>
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->autofocus(true)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            Content
            </div>
            HTML,
            RadioList::tag()->begin() . 'Content' . RadioList::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithChecked(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="value" checked>
            <label for="choices-0">Value</label>
            </div>
            HTML,
            RadioList::tag()
                ->checked('value')
                ->id('choices')
                ->items(ChoiceItem::tag()->label('Value')->value('value'))
                ->name('choice')
                ->render(),
            'Matching item must be checked.',
        );
    }

    public function testRenderWithCheckedFalse(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="1">
            <label for="choices-0">One</label>
            <input id="choices-1" name="choice" type="radio" value="2">
            <label for="choices-1">Two</label>
            </div>
            HTML,
            RadioList::tag()
                ->checked(false)
                ->id('choices')
                ->items(
                    ChoiceItem::tag()->label('One')->value(1),
                    ChoiceItem::tag()->label('Two')->value(2),
                )
                ->name('choice')
                ->render(),
            'No item must be checked.',
        );
    }

    public function testRenderWithCheckedNull(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="1">
            <label for="choices-0">One</label>
            <input id="choices-1" name="choice" type="radio" value="2">
            <label for="choices-1">Two</label>
            </div>
            HTML,
            RadioList::tag()
                ->checked(null)
                ->id('choices')
                ->items(
                    ChoiceItem::tag()->label('One')->value(1),
                    ChoiceItem::tag()->label('Two')->value(2),
                )
                ->name('choice')
                ->render(),
            'No item must be checked.',
        );
    }

    public function testRenderWithCheckedTrue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="1" checked>
            <label for="choices-0">One</label>
            <input id="choices-1" name="choice" type="radio" value="2" checked>
            <label for="choices-1">Two</label>
            </div>
            HTML,
            RadioList::tag()
                ->checked(true)
                ->id('choices')
                ->items(
                    ChoiceItem::tag()->label('One')->value(1),
                    ChoiceItem::tag()->label('Two')->value(2),
                )
                ->name('choice')
                ->render(),
            'Every item must be checked.',
        );
    }

    public function testRenderWithCheckedUsingArray(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="1" checked>
            <label for="choices-0">One</label>
            <input id="choices-1" name="choice" type="radio" value="2">
            <label for="choices-1">Two</label>
            </div>
            HTML,
            RadioList::tag()
                ->checked([1])
                ->id('choices')
                ->items(
                    ChoiceItem::tag()->label('One')->value(1),
                    ChoiceItem::tag()->label('Two')->value(2),
                )
                ->name('choice')
                ->render(),
            'Matching item must be checked.',
        );
    }

    public function testRenderWithCheckedUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="value" checked>
            <label for="choices-0">Value</label>
            </div>
            HTML,
            RadioList::tag()
                ->checked(BackedString::VALUE)
                ->id('choices')
                ->items(ChoiceItem::tag()->label('Value')->value('value'))
                ->name('choice')
                ->render(),
            'Matching item must be checked.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->class('value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->class(BackedString::VALUE)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            Pick one:<input id="choices-0" name="choice" type="radio" value="1">
            <label for="choices-0">One</label>
            </div>
            HTML,
            RadioList::tag()
                ->content('Pick one:')
                ->id('choices')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->name('choice')
                ->render(),
            'Container content must precede the rendered items.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <div contenteditable="true">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->contentEditable(true)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div contenteditable="true">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div data-value="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->dataAttributes(['value' => 'value'])
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <div class="default-class">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag(['class' => 'default-class'])
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <div class="default-class">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <div dir="ltr">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->dir('ltr')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div dir="ltr">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->dir(Direction::LTR)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <div draggable="true">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->draggable(true)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div draggable="true">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->draggable(Draggable::TRUE)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithEnclosedLabels(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <label for="choices-0"><input id="choices-0" name="choice" type="radio" value="1" checked>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->checked(1)
                ->enclosedByLabel()
                ->id('choices')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->name('choice')
                ->render(),
            'Item input and text must be enclosed by the label.',
        );
    }

    public function testRenderWithEnclosedLabelsDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="1" checked>
            <label for="choices-0">One</label>
            </div>
            HTML,
            RadioList::tag()
                ->checked(1)
                ->enclosedByLabel()
                ->enclosedByLabel(false)
                ->id('choices')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->name('choice')
                ->render(),
            'Disabling enclosure must restore sibling label rendering.',
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <div onfocus="handleFocus()" onblur="handleBlur()">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <div hidden>
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->hidden(true)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <div id="value">
            <input id="value-0" type="radio" value="1">
            <label for="value-0">One</label>
            </div>
            HTML,
            RadioList::tag()
                ->id('value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithIdentifiersUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div id="value">
            <input name="value" type="hidden" value="0">
            <input id="value-0" name="value" type="radio" value="1">
            <label for="value-0">One</label>
            </div>
            HTML,
            RadioList::tag()
                ->id(BackedString::VALUE)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->name(BackedString::VALUE)
                ->uncheckedValue('0')
                ->render(),
            'Enum identifiers must be transferred to the item inputs.',
        );
    }

    public function testRenderWithIdentifiersUsingStringable(): void
    {
        $identifier = new class implements Stringable {
            public function __toString(): string
            {
                return 'choice';
            }
        };

        self::assertSame(
            <<<HTML
            <div id="choice">
            <input name="choice" type="hidden" value="0">
            <input id="choice-0" name="choice" type="radio" value="1">
            <label for="choice-0">One</label>
            </div>
            HTML,
            RadioList::tag()
                ->id($identifier)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->name($identifier)
                ->uncheckedValue('0')
                ->render(),
            'Stringable identifiers must be transferred to the item inputs.',
        );
    }

    public function testRenderWithItemAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input class="choice" id="choices-0" name="choice" type="radio" value="1" data-state="ready">
            <label for="choices-0">One</label>
            </div>
            HTML,
            RadioList::tag()
                ->id('choices')
                ->itemAttributes(['class' => 'choice'])
                ->itemAttributes(['data-state' => 'ready'])
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->name('choice')
                ->render(),
            'Item attributes must merge and apply to every item input.',
        );
    }

    public function testRenderWithItems(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="1">
            <label for="choices-0">One</label>
            <input id="choices-1" name="choice" type="radio" value="2">
            <label for="choices-1">Two</label>
            </div>
            HTML,
            RadioList::tag()
                ->id('choices')
                ->items(
                    ChoiceItem::tag()->label('One')->value(1),
                    ChoiceItem::tag()->label('Two')->value(2),
                )
                ->name('choice')
                ->render(),
            'Items must be rendered in order with sequential identifiers.',
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <div lang="en">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div lang="en">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <div itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
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
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="1">
            <label for="choices-0">One</label>
            </div>
            HTML,
            RadioList::tag()
                ->id('choices')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->name('choice')
                ->render(),
            "'name' must be transferred to the item inputs as 'choice'.",
        );
    }

    public function testRenderWithNamedItems(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input id="choices-0" name="choice" type="radio" value="1">
            <label for="choices-0">One</label>
            </div>
            HTML,
            RadioList::tag()
                ->id('choices')
                ->items(first: ChoiceItem::tag()->label('One')->value(1))
                ->name('choice')
                ->render(),
            'Named variadic items must be normalized to sequential item indexes.',
        );
    }

    public function testRenderWithoutIdentifiers(): void
    {
        self::assertSame(
            <<<HTML
            <div id="1">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addAttribute('id', 1)
                ->addAttribute('name', 1)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->uncheckedValue('0')
                ->render(),
            'Unsupported identifier types must not be transferred to item inputs.',
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addAriaAttribute('label', 'value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addAttribute('class', 'value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addDataAttribute('value', 'value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <div role="banner">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div role="banner">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->role(Role::BANNER)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addAttribute('class', 'value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div title="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <div spellcheck="true">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <div style='value'>
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <div tabindex="3">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->tabIndex(3)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <div class="text-muted">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <div title="value">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            </div>
            HTML,
            (string) RadioList::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <div translate="no">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div translate="no">
            <input type="radio" value="1">
            <label>One</label>
            </div>
            HTML,
            RadioList::tag()
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUncheckedValue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <input name="choice" type="hidden" value="0">
            <input id="choices-0" name="choice" type="radio" value="1">
            <label for="choices-0">One</label>
            </div>
            HTML,
            RadioList::tag()
                ->id('choices')
                ->items(ChoiceItem::tag()->label('One')->value(1))
                ->name('choice')
                ->uncheckedValue('0')
                ->render(),
            'Unchecked value must render a hidden input before the items.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $radioList = RadioList::tag();

        self::assertNotSame(
            $radioList,
            $radioList->checked(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $radioList,
            $radioList->enclosedByLabel(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $radioList,
            $radioList->itemAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $radioList,
            $radioList->items(ChoiceItem::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $radioList,
            $radioList->uncheckedValue(null),
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

        RadioList::tag()->contentEditable('invalid-value');
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

        RadioList::tag()->dir('invalid-value');
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

        RadioList::tag()->draggable('invalid-value');
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

        RadioList::tag()->lang('invalid-value');
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

        RadioList::tag()->role('invalid-value');
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

        RadioList::tag()->tabIndex(-2);
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

        RadioList::tag()->translate('invalid-value');
    }
}
