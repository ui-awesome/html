<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Root};

/**
 * Represents the HTML `<html>` element (document root).
 *
 * Provides a concrete `<html>` element implementation that returns `Root::HTML` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<html>` element is the root element of an HTML document.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Root\Html;
 *
 * echo Html::tag()
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
