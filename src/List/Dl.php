<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Helper\LineBreakNormalizer;
use UIAwesome\Html\Interop\{BlockInterface, Lists};

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
     * @param string|Stringable $content Content for the `<dd>` element.
     *
     * @return static New instance with the appended description details element.
     *
     * Usage example:
     * ```php
     * $list = \UIAwesome\Html\List\Dl::tag()
     *     ->dd('Description text');
     * ```
     */
    public function dd(string|Stringable $content): static
    {
        $dd = Dd::tag()->content($content);

        return $this->html($dd->render(), "\n");
    }

    /**
     * Appends a `<dt>` element to the description list.
     *
     * @param string|Stringable $content Content for the `<dt>` element.
     *
     * @return static New instance with the appended description term element.
     *
     * Usage example:
     * ```php
     * $list = \UIAwesome\Html\List\Dl::tag()
     *     ->dt('Term text');
     * ```
     */
    public function dt(string|Stringable $content): static
    {
        $dt = Dt::tag()->content($content);

        return $this->html($dt->render(), "\n");
    }

    /**
     * Cleans up the output after rendering the block element.
     *
     * Removes excessive consecutive newlines from the rendered output to ensure clean HTML structure.
     *
     * @param string $result Rendered HTML output.
     *
     * @return string Cleaned HTML output with excessive newlines removed.
     */
    protected function afterRun(string $result): string
    {
        return parent::afterRun(LineBreakNormalizer::normalize($result));
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
