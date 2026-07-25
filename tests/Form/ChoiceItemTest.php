<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\{ChoiceItem, InputCheckbox, InputRadio};

/**
 * Unit tests for {@see ChoiceItem} rendering and attribute behavior.
 */
#[Group('form')]
final class ChoiceItemTest extends TestCase
{
    public function testRenderWithEnclosedLabel(): void
    {
        self::assertSame(
            <<<HTML
            <label class="choice-label" for="choice"><input id="choice" name="choices[]" type="checkbox" value="1" checked>One</label>
            HTML,
            ChoiceItem::tag()
                ->label('One')
                ->labelClass('choice-label')
                ->value(1)
                ->render(InputCheckbox::tag(), [], 'choice', 'choices[]', [1], true),
            'Enclosed label must contain the input and encoded label text.',
        );
    }

    public function testRenderWithMergedLabelClasses(): void
    {
        self::assertSame(
            <<<HTML
            <input id="choice" name="choice" type="radio" value="yes">
            <label class="base additional" for="choice">Yes</label>
            HTML,
            ChoiceItem::tag()
                ->label('Yes')
                ->labelClass('base')
                ->labelClass('additional')
                ->value('yes')
                ->render(InputRadio::tag(), [], 'choice', 'choice', null, false),
            'Label classes must merge by default.',
        );
    }

    public function testRenderWithSeparateLabel(): void
    {
        self::assertSame(
            <<<HTML
            <input class="choice" id="choice" name="choice" type="radio" value="yes">
            <label class="replacement" for="choice">Yes &amp; continue</label>
            HTML,
            ChoiceItem::tag()
                ->label('Yes & continue')
                ->labelAttributes(['class' => 'base', 'data-item' => 'yes'])
                ->labelClass('ignored')
                ->labelClass('replacement', true)
                ->labelAttributes(['data-item' => null])
                ->value('yes')
                ->render(InputRadio::tag(), ['class' => 'choice'], 'choice', 'choice', 'no', false),
            'Separate label must preserve the item value and configured attributes.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $choiceItem = ChoiceItem::tag();

        self::assertNotSame(
            $choiceItem,
            $choiceItem->label(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $choiceItem,
            $choiceItem->labelAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $choiceItem,
            $choiceItem->labelClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $choiceItem,
            $choiceItem->value(null),
            'New instance must be returned (immutability).',
        );
    }
}
