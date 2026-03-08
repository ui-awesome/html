<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\HasForm;
use UIAwesome\Html\Attribute\{HasFor, HasName};
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;

/**
 * Renders the HTML `<output>` element for calculation and action results.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Output::tag()
 *     ->content('0')
 *     ->for('price quantity')
 *     ->form('order-form')
 *     ->name('total')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/output
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Output extends BaseInline
{
    use HasFor;
    use HasForm;
    use HasName;

    /**
     * Returns the tag enumeration for the `<output>` element.
     *
     * @return Inline Tag enumeration instance for `<output>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::OUTPUT;
    }

    /**
     * Renders the `<output>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<output>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
