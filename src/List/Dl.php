<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Lists;

/**
 * Renders the HTML `<dl>` element for description lists.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\List\Dl::tag()
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
     * Appends a `<dd>` element to the description list.
     *
     * Usage example:
     * ```php
     * $list = \UIAwesome\Html\List\Dl::tag()
     *     ->dd('Description text');
     * ```
     *
     * @param Dd|string|Stringable $content A `Dd` instance or content for the `<dd>` element.
     *
     * @return static New instance with the appended description details element.
     */
    public function dd(Dd|string|Stringable $content): static
    {
        if (!$content instanceof Dd) {
            $content = Dd::tag()->content($content);
        }

        return $this->html($content, "\n");
    }

    /**
     * Appends a `<dt>` element to the description list.
     *
     * Usage example:
     * ```php
     * $list = \UIAwesome\Html\List\Dl::tag()
     *     ->dt('Term text');
     * ```
     *
     * @param Dt|string|Stringable $content A `Dt` instance or content for the `<dt>` element.
     *
     * @return static New instance with the appended description term element.
     */
    public function dt(Dt|string|Stringable $content): static
    {
        if (!$content instanceof Dt) {
            $content = Dt::tag()->content($content);
        }

        return $this->html($content, "\n");
    }

    /**
     * Appends multiple term-description pairs to the description list.
     *
     * Usage example:
     * ```php
     * $list = \UIAwesome\Html\List\Dl::tag()->terms(
     *     ['Term 1', 'Description 1'],
     *     ['Term 2', 'Description 2'],
     * );
     * ```
     *
     * @param array{0: Dt|string|Stringable, 1: Dd|string|Stringable} ...$pairs Arrays of `[term, description]` pairs.
     *
     * @return static New instance with the appended term-description pairs.
     */
    public function terms(array ...$pairs): static
    {
        $dl = $this;

        foreach ($pairs as $pair) {
            $dl = $dl->dt($pair[0])->dd($pair[1]);
        }

        return $dl;
    }

    /**
     * Returns the tag enumeration for the `<dl>` element.
     *
     * @return Lists Tag enumeration instance for `<dl>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): Lists
    {
        return Lists::DL;
    }
}
