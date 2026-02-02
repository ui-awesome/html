<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Lists};

/**
 * Represents the HTML `<dl>` element for description lists.
 *
 * Provides a concrete `<dl>` element implementation that returns `Lists::DL` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<dl>` element represents a description list. The element encloses a list of groups of terms (specified using the
 * `<dt>` element) and descriptions (provided by `<dd>` elements).
 *
 * Key features.
 * - Container element accepts `<dt>` and `<dd>` child elements.
 * - Provides helper methods `dt()` and `dd()` for constructing valid description list markup.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\List\Dl;
 *
 * echo Dl::tag()
 *     ->class('my-list')
 *     ->dt('Term 1')
 *     ->dd('Description 1')
 *     ->dt('Term 2')
 *     ->dd('Description 2')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/dl
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Dl extends BaseBlock
{
    /**
     * Appends a `<dd>` element with the specified content to the description list.
     *
     * Creates a new instance with a `<dd>` element appended to the content.
     *
     * @param string|Stringable $content Content to place inside the `<dd>` element.
     *
     * @return static New instance with the appended description details element.
     *
     * Usage example:
     * ```php
     * $list = Dl::tag()
     *     ->dd('Description text');
     * ```
     */
    public function dd(string|Stringable $content): static
    {
        $dd = Dd::tag()->content($content);

        return $this->html($dd->render(), PHP_EOL);
    }

    /**
     * Appends a `<dt>` element with the specified content to the description list.
     *
     * Creates a new instance with a `<dt>` element appended to the content.
     *
     * @param string|Stringable $content Content to place inside the `<dt>` element.
     *
     * @return static New instance with the appended description term element.
     *
     * Usage example:
     * ```php
     * $list = Dl::tag()
     *     ->dt('Term text');
     * ```
     */
    public function dt(string|Stringable $content): static
    {
        $dt = Dt::tag()->content($content);

        return $this->html($dt->render(), PHP_EOL);
    }

    /**
     * Returns the tag enumeration for the `<dl>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<dl>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Lists::DL;
    }
}
