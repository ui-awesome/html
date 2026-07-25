<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

/**
 * Renders a list of `<input type="radio">` controls sharing one name.
 *
 * Every item input keeps the plain list name so the browser submits a single value.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\RadioList::tag()
 *     ->checked('yes')
 *     ->id('answer')
 *     ->items(
 *         \UIAwesome\Html\Form\ChoiceItem::tag()->value('yes')->label('Yes'),
 *         \UIAwesome\Html\Form\ChoiceItem::tag()->value('no')->label('No'),
 *     )
 *     ->name('answer')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/radio
 * {@see AbstractChoiceList} for the base implementation.
 */
final class RadioList extends AbstractChoiceList
{
    /**
     * Creates the atomic input used for each item.
     *
     * @return InputRadio Radio input element instance.
     */
    protected function createInput(): InputRadio
    {
        return InputRadio::tag();
    }

    /**
     * Returns whether item names use array notation.
     *
     * @return false Always `false`, so every item input keeps the plain list name.
     */
    protected function usesArrayName(): false
    {
        return false;
    }
}
