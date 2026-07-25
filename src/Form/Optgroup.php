<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Override;
use UIAwesome\Html\Attribute\{CanBeDisabled, HasLabel};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Mixin\HasSelectableChildren;
use UIAwesome\Html\Form\Values\SelectTag;

/**
 * Renders the HTML `<optgroup>` element for grouping options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Optgroup::tag()
 *     ->content(\UIAwesome\Html\Form\Option::tag()->value('scl')->content('Santiago'))
 *     ->label('Cities')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/optgroup
 * {@see BaseBlock} for the base implementation.
 */
final class Optgroup extends BaseBlock
{
    use CanBeDisabled;
    use HasLabel;
    use HasSelectableChildren;

    /**
     * @var string[]|null Normalized values selected by the parent select.
     */
    private array|null $selectedValues = null;

    /**
     * Returns the content with every appended option rendered in place.
     *
     * Options are rendered on access, so the selection received from the parent select is applied to the current option
     * instances.
     *
     * Usage example:
     * ```php
     * $html = \UIAwesome\Html\Form\Optgroup::tag()
     *     ->option(\UIAwesome\Html\Form\Option::tag()->value('scl')->content('Santiago'))
     *     ->getContent();
     * ```
     *
     * @return string Content with the appended options rendered in place.
     */
    #[Override]
    public function getContent(): string
    {
        return $this->renderChildren($this->selectedValues);
    }

    /**
     * Appends an `<option>` element to the option group.
     *
     * Usage example:
     * ```php
     * $optgroup = \UIAwesome\Html\Form\Optgroup::tag()
     *     ->option(\UIAwesome\Html\Form\Option::tag()->value('scl')->content('Santiago'));
     * ```
     *
     * @param Option $option Option element instance.
     *
     * @return static New instance with the appended option.
     */
    public function option(Option $option): static
    {
        return $this->appendChildren($option);
    }

    /**
     * Appends multiple `<option>` elements to the option group.
     *
     * Usage example:
     * ```php
     * $optgroup = \UIAwesome\Html\Form\Optgroup::tag()->options(
     *     \UIAwesome\Html\Form\Option::tag()->value('scl')->content('Santiago'),
     *     \UIAwesome\Html\Form\Option::tag()->value('ccp')->content('Concepcion'),
     * );
     * ```
     *
     * @param Option ...$options Option element instances.
     *
     * @return static New instance with the appended options.
     */
    public function options(Option ...$options): static
    {
        return $this->appendChildren(...$options);
    }

    /**
     * Sets the normalized selected values received from the parent select.
     *
     * @param string[] $values Normalized selected values.
     *
     * @return static New instance with the updated selected values.
     *
     * @internal
     */
    public function selectedValues(array $values): static
    {
        $new = clone $this;
        $new->selectedValues = $values;

        return $new;
    }

    /**
     * Returns the tag enumeration for the `<optgroup>` element.
     *
     * @return SelectTag Tag enumeration instance for `<optgroup>`.
     */
    protected function getTag(): SelectTag
    {
        return SelectTag::OPTGROUP;
    }
}
