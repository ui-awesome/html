<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Root};

/**
 * Represents the HTML `<body>` (body) element for document body content.
 *
 * Provides a concrete `<body>` element implementation that returns `Root::BODY` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<body>` element represents the contents of an HTML document.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Root\Body;
 *
 * echo Body::tag()
 *     ->class('app')
 *     ->content('value')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/body
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Body extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<body>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<body>`.
     *
     * {@see Root} for valid root-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Root::BODY;
    }
}
