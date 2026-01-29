<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Root};

/**
 * Represents the HTML `<head>` element for document metadata.
 *
 * Provides a concrete `<head>` element implementation that returns `Root::HEAD` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<head>` element contains machine-readable information (metadata) about the document.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Root\Head;
 *
 * echo Head::tag()
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
