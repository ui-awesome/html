<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, MetadataBlock};

/**
 * Renders the HTML `<title>` element for the document title.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\Title::tag()
 *     ->content('My page')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/title
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Title extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<title>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<title>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return MetadataBlock::TITLE;
    }
}
