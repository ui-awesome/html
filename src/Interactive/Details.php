<?php

declare(strict_types=1);

namespace UIAwesome\Html\Interactive;

use Stringable;
use UIAwesome\Html\Attribute\HasName;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interactive\Attribute\CanBeOpen;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<details>` element for disclosure widgets.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Interactive\Details::tag()
 *     ->name('requirements')
 *     ->open(true)
 *     ->summary('System requirements')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/details
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Details extends BaseBlock
{
    use CanBeOpen;
    use HasName;

    /**
     * Appends a `<summary>` element to the details widget.
     *
     * Accepts a `Summary` instance for full control, or text content that is automatically wrapped in a `Summary`
     * element.
     *
     * Usage examples:
     * ```php
     * $details = Details::tag()->summary('System requirements');
     * $details = Details::tag()->summary(Summary::tag()->content('System requirements'));
     * $details = Details::tag()->summary(null);
     * ```
     *
     * @param Summary|string|Stringable|null $summary Summary instance, content text, or `null` to skip.
     *
     * @return static New instance with the appended summary element.
     */
    public function summary(Summary|string|Stringable|null $summary): static
    {
        if ($summary === null) {
            return $this;
        }

        if (!$summary instanceof Summary) {
            $summary = Summary::tag()->content($summary);
        }

        return $this->html($summary, "\n");
    }

    /**
     * Returns the tag enumeration for the `<details>` element.
     *
     * @return Block Tag enumeration instance for `<details>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::DETAILS;
    }
}
