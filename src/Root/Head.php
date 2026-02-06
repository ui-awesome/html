<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Root};

/**
 * Renders the HTML `<head>` element for document metadata.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Root\Head::tag()
 *     ->content('value')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/head
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Head extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<head>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<head>`.
     *
     * {@see Root} for valid root-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Root::HEAD;
    }
}
