<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use Stringable;
use UIAwesome\Html\Attribute\Global\HasNonce;
use UIAwesome\Html\Attribute\{HasBlocking, HasMedia};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\MetadataBlock;
use UnitEnum;

/**
 * Renders the HTML `<style>` element for embedded CSS rules.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\Style::tag()
 *     ->content('body { color: red; }')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/style
 * {@see BaseBlock} for the base implementation.
 */
final class Style extends BaseBlock
{
    use HasBlocking;
    use HasMedia;
    use HasNonce;

    /**
     * Sets the `type` attribute.
     *
     * Only `text/css` is recommended; the attribute may be omitted entirely. Declaring any other value is obsolete
     * rather than invalid, and makes the browser skip the stylesheet.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Style::tag()
     *     ->content('body { color: red; }')
     *     ->type('text/css')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value MIME type of the embedded stylesheet, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `type` attribute.
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/style#type
     */
    public function type(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('type', $value);
    }

    /**
     * Returns the tag enumeration for the `<style>` element.
     *
     * @return MetadataBlock Tag enumeration instance for `<style>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): MetadataBlock
    {
        return MetadataBlock::STYLE;
    }
}
