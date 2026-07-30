<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\{CheckboxList, ChoiceItem, InputRadio};
use UIAwesome\Html\Interop\Block;

/**
 * Unit tests for shared checkbox and radio list item presentation.
 */
#[Group('form')]
final class ChoiceListPresentationTest extends TestCase
{
    public function testMergesDefaultAndItemLabelAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="choice" name="choice" type="radio" value="yes">
            <label class="theme-label item-label" for="choice" data-source="item" data-theme="dark">Yes</label>
            HTML,
            ChoiceItem::tag()
                ->label('Yes')
                ->labelAttributes(['data-source' => 'item'])
                ->labelClass('item-label')
                ->value('yes')
                ->render(
                    InputRadio::tag(),
                    [],
                    'choice',
                    'choice',
                    null,
                    false,
                    [
                        'class' => 'theme-label',
                        'data-source' => 'theme',
                        'data-theme' => 'dark',
                    ],
                ),
            'Item label attributes must override defaults while appending their CSS classes.',
        );
    }

    public function testReturnsNewInstanceForItemPresentation(): void
    {
        $list = CheckboxList::tag();

        self::assertNotSame(
            $list,
            $list->itemContainerAttributes([]),
            'Item container attributes must preserve immutability.',
        );
        self::assertNotSame(
            $list,
            $list->itemContainerClass(''),
            'Item container classes must preserve immutability.',
        );
        self::assertNotSame(
            $list,
            $list->itemContainerTag(false),
            'Item container tags must preserve immutability.',
        );
        self::assertNotSame(
            $list,
            $list->itemLabelAttributes([]),
            'Item label attributes must preserve immutability.',
        );
        self::assertNotSame(
            $list,
            $list->itemLabelClass(''),
            'Item label classes must preserve immutability.',
        );
    }

    public function testWrapsEachItemWithSharedPresentation(): void
    {
        self::assertSame(
            <<<HTML
            <div id="choices">
            <div class="form-check mb-2" data-role="choice">
            <input class="form-check-input" id="choices-0" name="choice[]" type="checkbox" value="1">
            <label class="form-check-label text-body custom-label" for="choices-0" data-role="label">One</label>
            </div>
            <div class="form-check mb-2" data-role="choice">
            <input class="form-check-input" id="choices-1" name="choice[]" type="checkbox" value="2">
            <label class="form-check-label text-body" for="choices-1" data-role="label">Two</label>
            </div>
            </div>
            HTML,
            CheckboxList::tag()
                ->id('choices')
                ->itemAttributes(['class' => 'form-check-input'])
                ->itemContainerAttributes(['data-role' => 'choice'])
                ->itemContainerClass('form-check')
                ->itemContainerClass('mb-2')
                ->itemContainerTag(Block::DIV)
                ->itemLabelAttributes(['data-role' => 'label'])
                ->itemLabelClass('form-check-label')
                ->itemLabelClass('text-body')
                ->items(
                    ChoiceItem::tag()->label('One')->labelClass('custom-label')->value(1),
                    ChoiceItem::tag()->label('Two')->value(2),
                )
                ->name('choice')
                ->render(),
            'Every choice must receive the shared input, wrapper, and label presentation.',
        );
    }
}
