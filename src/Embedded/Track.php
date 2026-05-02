<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\HasLabel;
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Embedded\Values\Kind;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<track>` element for timed text tracks in media.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Embedded\Track::tag()
 *     ->default(true)
 *     ->kind('captions')
 *     ->label('English')
 *     ->src('/media/captions-en.vtt')
 *     ->srclang('en')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/track
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Track extends BaseVoid
{
    use HasLabel;

    /**
     * Sets the `default` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Track::tag()
     *     ->default(true)
     *     ->render();
     * ```
     *
     * @param bool|null $value Default state. Use `true` to enable, `false` to disable, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `default` attribute.
     */
    public function default(bool|null $value): static
    {
        return $this->addAttribute(ElementAttribute::DEFAULT, $value);
    }

    /**
     * Sets the `kind` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Track::tag()
     *     ->kind(Kind::SUBTITLES)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Track kind ('subtitles', 'captions', 'descriptions', 'chapters', or
     * 'metadata'), or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `kind` attribute.
     *
     * {@see Kind} for predefined enum values.
     */
    public function kind(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Kind::cases(), ElementAttribute::KIND);

        return $this->addAttribute(ElementAttribute::KIND, $value);
    }

    /**
     * Sets the `src` attribute.
     *
     * Usage example:
     * ```php
     * $element->src('https://example.com/image.png');
     * $element->src('images/photo.jpg');
     * $element->src(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Image source URL or path, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `src` attribute.
     */
    public function src(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::SRC, $value);
    }

    /**
     * Sets the `srclang` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Track::tag()
     *     ->srclang('en')
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value BCP 47 language tag, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `srclang` attribute.
     */
    public function srclang(string|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::SRCLANG, $value);
    }

    /**
     * Returns the tag enumeration for the `<track>` element.
     *
     * @return Voids Tag enumeration instance for `<track>`.
     *
     * {@see Voids} for valid void-level tags.
     */
    protected function getTag(): Voids
    {
        return Voids::TRACK;
    }
}
