<?php

declare(strict_types=1);

namespace UIAwesome\Html\Palpable;

use Stringable;
use UIAwesome\Html\Attribute\{
    HasDownload,
    HasHreflang,
    HasPing,
    HasReferrerpolicy,
    HasRel,
    HasTarget,
};
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;
use UnitEnum;

/**
 * Renders the HTML `<a>` element for hyperlinks.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Palpable\A::tag()
 *     ->content('Visit Example')
 *     ->href('https://example.com')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a
 * {@see BaseInline} for the base implementation.
 */
final class A extends BaseInline
{
    use HasDownload;
    use HasHreflang;
    use HasPing;
    use HasReferrerpolicy;
    use HasRel;
    use HasTarget;

    /**
     * Sets the `href` attribute.
     *
     * Usage example:
     * ```php
     * $element->href('https://example.com/page');
     * $element->href('/about');
     * $element->href('#section');
     * $element->href(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value URL, path, or fragment, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `href` attribute.
     */
    public function href(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::HREF, $value);
    }

    /**
     * Sets the `type` attribute.
     *
     * Hints at the MIME type of the linked URL. Any MIME type is accepted; the value is purely informative and
     * carries no built-in browser behavior.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Palpable\A::tag()
     *     ->content('Download the report')
     *     ->href('/report.pdf')
     *     ->type('application/pdf')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value MIME type of the linked URL, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `type` attribute.
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/a#type
     */
    public function type(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('type', $value);
    }

    /**
     * Returns the tag enumeration for the `<a>` element.
     *
     * @return Inline Tag enumeration instance for `<a>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
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
