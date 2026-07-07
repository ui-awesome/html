<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<header>` element for section or page header content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Root\Header::tag()
 *     ->class('page-header')
 *     ->content('Welcome to the Site')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/header
 * {@see BaseBlock} for the base implementation.
 */
final class Header extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<header>` element.
     *
     * @return Block Tag enumeration instance for `<header>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::HEADER;
    }
}
