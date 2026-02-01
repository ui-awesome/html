<?php

declare(strict_types=1);

namespace UIAwesome\Html\Palpable;

use UIAwesome\Html\Attribute\Element\HasHref;
use UIAwesome\Html\Attribute\HasDownload;
use UIAwesome\Html\Attribute\HasHreflang;
use UIAwesome\Html\Attribute\HasPing;
use UIAwesome\Html\Attribute\HasReferrerpolicy;
use UIAwesome\Html\Attribute\HasRel;
use UIAwesome\Html\Attribute\HasTarget;
use UIAwesome\Html\Attribute\HasType;
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\{Inline, InlineInterface};

/**
 * Represents the HTML `<a>` element for creating hyperlinks.
 *
 * Provides a concrete `<a>` element implementation that returns `Inline::A` and inherits inline-level rendering and
 * global attribute support from {@see BaseInline}.
 *
 * The `<a>` element (or anchor element), with its `href` attribute, creates a hyperlink to web pages, files, email
 * addresses, locations in the same page, or anything else a URL can address.
 *
 * Key features.
 * - Inline element accepts child content.
 * - Supports anchor-specific attributes: `download`, `href`, `hreflang`, `ping`, `referrerpolicy`, `rel`, `target`,
 *   `type`.
 * - Supports global HTML attributes via {@see BaseInline}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Palpable\A;
 *
 * echo A::tag()
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
