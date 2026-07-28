<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use Stringable;
use UIAwesome\Html\Attribute\{
    HasBlocking,
    HasCrossorigin,
    HasFetchpriority,
    HasIntegrity,
    HasReferrerpolicy,
    HasSrc,
};
use UIAwesome\Html\Contracts\Attribute\SrcInterface;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\MetadataBlock;
use UnitEnum;

/**
 * Renders the HTML `<script>` element for executable code or data blocks.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\Script::tag()
 *     ->async(true)
 *     ->src('https://example.com/app.js')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script
 * {@see BaseBlock} for the base implementation.
 */
final class Script extends BaseBlock implements SrcInterface
{
    use HasBlocking;
    use HasCrossorigin;
    use HasFetchpriority;
    use HasIntegrity;
    use HasReferrerpolicy;
    use HasSrc;

    /**
     * Sets the `async` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Script::tag()
     *     ->src('/assets/app.js')
     *     ->async(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to execute the script asynchronously.
     *
     * @return static New instance with the updated `async` attribute.
     */
    public function async(bool $value): static
    {
        return $this->addAttribute('async', $value);
    }

    /**
     * Sets the `defer` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Script::tag()
     *     ->src('/assets/app.js')
     *     ->defer(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to defer script execution.
     *
     * @return static New instance with the updated `defer` attribute.
     */
    public function defer(bool $value): static
    {
        return $this->addAttribute('defer', $value);
    }

    /**
     * Sets the `nomodule` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Script::tag()
     *     ->src('/assets/legacy.js')
     *     ->nomodule(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to prevent execution in browsers that support modules.
     *
     * @return static New instance with the updated `nomodule` attribute.
     */
    public function nomodule(bool $value): static
    {
        return $this->addAttribute('nomodule', $value);
    }

    /**
     * Sets the `type` attribute.
     *
     * Accepts `module`, `importmap`, `speculationrules`, or any MIME type. Omitting it, or using a JavaScript MIME
     * type, runs the element as a classic script; any other MIME type turns it into a data block that the browser
     * does not execute, such as `application/ld+json`.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Script::tag()
     *     ->src('/assets/app.js')
     *     ->type('module')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Script token or MIME type, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `type` attribute.
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script/type
     */
    public function type(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('type', $value);
    }

    /**
     * Returns the tag enumeration for the `<script>` element.
     *
     * @return MetadataBlock Tag enumeration instance for `<script>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): MetadataBlock
    {
        return MetadataBlock::SCRIPT;
    }
}
