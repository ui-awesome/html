<?php

declare(strict_types=1);

namespace UIAwesome\Html\Palpable;

use UIAwesome\Html\Attribute\{
    HasDownload,
    HasHreflang,
    HasPing,
    HasReferrerpolicy,
    HasRel,
    HasTarget,
    HasType,
};
use UIAwesome\Html\Attribute\Element\HasHref;
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\{Inline, InlineInterface};

/**
 * Renders the HTML `<a>` element for hyperlinks.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Palpable\A::tag()
 *     ->href('https://example.com')
 *     ->content('Visit Example');
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class A extends BaseInline
{
    use HasDownload;
    use HasHref;
    use HasHreflang;
    use HasPing;
    use HasReferrerpolicy;
    use HasRel;
    use HasTarget;
    use HasType;

    /**
     * Returns the tag enumeration for the `<a>` element.
     *
     * @return InlineInterface Tag enumeration instance for `<a>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): InlineInterface
    {
        return Inline::A;
    }

    /**
     * Renders the `<a>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<a>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
