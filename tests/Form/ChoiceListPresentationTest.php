<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use TypeError;
use UIAwesome\Html\Form\{CheckboxList, ChoiceItem, InputRadio};
use UIAwesome\Html\Interop\{Block, Voids};

/**
 * Unit tests for shared checkbox and radio list item presentation.
 */
#[Group('form')]
final class ChoiceListPresentationTest extends TestCase
{
    private const string ITEM_CONTAINER_TAG_TYPE_ERROR = 'UIAwesome\Html\Form\AbstractChoiceList::itemContainerTag(): '
        . 'Argument #1 ($value) must be of type UIAwesome\Html\Interop\Block|UIAwesome\Html\Interop\Inline|'
        . 'UIAwesome\Html\Interop\Lists|UIAwesome\Html\Interop\MetadataBlock|UIAwesome\Html\Interop\Root|'
        . 'UIAwesome\Html\Form\Values\SelectTag|UIAwesome\Html\Interop\Table|false, ';

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

    public function testRejectsNonTagItemContainerEnum(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage(self::ITEM_CONTAINER_TAG_TYPE_ERROR . BackedString::class . ' given');

        /** @phpstan-ignore argument.type */
        CheckboxList::tag()->itemContainerTag(BackedString::VALUE);
    }

    public function testRejectsVoidItemContainerTag(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage(self::ITEM_CONTAINER_TAG_TYPE_ERROR . Voids::class . ' given');

        /** @phpstan-ignore argument.type */
        CheckboxList::tag()->itemContainerTag(Voids::INPUT);
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
