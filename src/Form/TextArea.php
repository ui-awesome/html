<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\{CanBeDisabled, HasName};
use UIAwesome\Html\Attribute\Form\{
    CanBeReadonly,
    CanBeRequired,
    HasAutocomplete,
    HasDirname,
    HasForm,
    HasMaxlength,
    HasMinlength,
    HasPlaceholder,
};
use UIAwesome\Html\Attribute\Global\{HasAutocapitalize, HasAutocorrect};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Attribute\{HasCols, HasRows, HasWrap};
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Renders the HTML `<textarea>` element for multiline plain-text input.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\TextArea::tag()
 *     ->name('comment')
 *     ->rows(5)
 *     ->cols(33)
 *     ->placeholder('Enter your comment here')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/textarea
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class TextArea extends BaseBlock
{
    use CanBeDisabled;
    use CanBeReadonly;
    use CanBeRequired;
    use HasAutocapitalize;
    use HasAutocomplete;
    use HasAutocorrect;
    use HasCols;
    use HasDirname;
    use HasForm;
    use HasMaxlength;
    use HasMinlength;
    use HasName;
    use HasPlaceholder;
    use HasRows;
    use HasWrap;

    /**
     * Suffix appended to the element `id` when `aria-describedby` is set to `true`.
     *
     * An empty string falls back to `'-help'` during rendering.
     */
    protected string $ariaDescribedBySuffix = '';

    /**
     * Sets the suffix appended to the element `id` when `aria-describedby` is set to `true`.
     *
     * @param string $value Suffix to append to the element `id` for `aria-describedby`. Defaults to `'-help'`.
     *
     * @return static New instance with the updated `ariaDescribedBySuffix` value.
     */
    public function ariaDescribedBySuffix(string $value): static
    {
        $new = clone $this;
        $new->ariaDescribedBySuffix = $value;

        return $new;
    }

    /**
     * Returns the array of HTML attributes for the element.
     *
     * @return array Attributes array assigned to the element.
     *
     * @phpstan-return mixed[]
     */
    public function getAttributes(): array
    {
        $attributes = parent::getAttributes();

        /** @phpstan-var string|null $id */
        $id = $this->getAttribute('id', null);
        $ariaDescribedBy = $this->getAttribute('aria-describedby', null);

        $ariaDescribedBySuffix = $this->ariaDescribedBySuffix === '' ? '-help' : "-{$this->ariaDescribedBySuffix}";

        if ($ariaDescribedBy === true || $ariaDescribedBy === 'true') {
            $attributes['aria-describedby'] = $id !== null ? "{$id}{$ariaDescribedBySuffix}" : null;
        }

        return $attributes;
    }

    /**
     * Returns the tag enumeration for the `<textarea>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<textarea>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::TEXT_AREA;
    }
}
