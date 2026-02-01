<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<footer>` element for section footer content.
 *
 * Provides a concrete `<footer>` element implementation that returns `Block::FOOTER` and inherits block-level rendering
 * and global attribute support from {@see BaseBlock}.
 *
 * The `<footer>` element represents a footer for its nearest ancestor sectioning content or sectioning root element.
 * A `<footer>` typically contains information about the author of the section, copyright data or links to related
 * documents.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Flow\Footer;
 *
 * echo Footer::tag()
 *     ->class('page-footer')
 *     ->content('© 2026 Company Name')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/footer
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Footer extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<footer>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<footer>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::FOOTER;
    }
}
