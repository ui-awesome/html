<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\MetadataBlock;

/**
 * Renders the HTML `<noscript>` element for fallback content when scripting is unavailable.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\NoScript::tag()
 *     ->content('Please enable JavaScript to use this application.')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/noscript
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class NoScript extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<noscript>` element.
     *
     * @return MetadataBlock Tag enumeration instance for `<noscript>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): MetadataBlock
    {
        return MetadataBlock::NOSCRIPT;
    }
}
