<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

/**
 * Renders a list of `<input type="checkbox">` controls sharing one name.
 *
 * Every item input is named `name[]` so the browser submits the checked values as an array.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\CheckboxList::tag()
 *     ->checked(['email'])
 *     ->id('channels')
 *     ->items(
 *         \UIAwesome\Html\Form\ChoiceItem::tag()->value('email')->label('Email'),
 *         \UIAwesome\Html\Form\ChoiceItem::tag()->value('sms')->label('SMS'),
 *     )
 *     ->name('channels')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/checkbox
 * {@see AbstractChoiceList} for the base implementation.
 */
final class CheckboxList extends AbstractChoiceList
{
    /**
     * Creates the atomic input used for each item.
     *
     * @return InputCheckbox Checkbox input element instance.
     */
    protected function createInput(): InputCheckbox
    {
        return InputCheckbox::tag();
    }

    /**
     * Returns whether item names use array notation.
     *
     * @return true Always `true`, so every item input is named `name[]`.
     */
    protected function usesArrayName(): true
    {
        return true;
    }
}
