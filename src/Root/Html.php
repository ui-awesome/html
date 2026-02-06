<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Root};

/**
 * Renders the HTML `<html>` element as the document root.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Root\Html::tag()
 *     ->lang('en')
 *     ->content('value')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/html
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Html extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<html>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<html>`.
     *
     * {@see Root} for valid root-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Root::HTML;
    }
}
