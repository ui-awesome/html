<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\HasCrossorigin;
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Embedded\Values\{Controlslist, Preload};
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Block;
use UnitEnum;

use function is_string;
use function strpbrk;

/**
 * Renders the HTML `<audio>` element for embedding audio content.
 *
 * Supports the experimental `disableremoteplayback` attribute. Availability and behavior may vary across browsers.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Embedded\Audio::tag()
 *     ->controls(true)
 *     ->src('/media/podcast.mp3')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Audio extends BaseBlock
{
    use HasCrossorigin;

    /**
     * Sets the `autoplay` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->autoplay(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether media should automatically begin playback when it can.
     *
     * @return static New instance with the updated `autoplay` attribute.
     */
    public function autoplay(bool $value): static
    {
        return $this->addAttribute(ElementAttribute::AUTOPLAY, $value);
    }

    /**
     * Sets the `controls` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->controls(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether browser playback controls should be displayed.
     *
     * @return static New instance with the updated `controls` attribute.
     */
    public function controls(bool $value): static
    {
        return $this->addAttribute(ElementAttribute::CONTROLS, $value);
    }

    /**
     * Sets the `controlslist` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->controlslist(Controlslist::NODOWNLOAD)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Controls list token(s), or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `controlslist` attribute.
     *
     * {@see Controlslist} for predefined enum values.
     */
    public function controlslist(string|UnitEnum|null $value): static
    {
        if (is_string($value) && strpbrk(trim($value), " \t\n\r\f") !== false) {
            $tokens = preg_split('/\s+/', $value, -1, PREG_SPLIT_NO_EMPTY);

            if ($tokens === false) {
                throw new InvalidArgumentException(
                    'Unable to parse the controlslist attribute value.',
                );
            }

            foreach ($tokens as $token) {
                Validator::oneOf($token, Controlslist::cases(), ElementAttribute::CONTROLSLIST);
            }

            return $this->addAttribute(ElementAttribute::CONTROLSLIST, $value);
        }

        Validator::oneOf($value, Controlslist::cases(), ElementAttribute::CONTROLSLIST);

        return $this->addAttribute(ElementAttribute::CONTROLSLIST, $value);
    }

    /**
     * Sets the `disableremoteplayback` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->disableremoteplayback(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether remote playback should be disabled.
     *
     * @return static New instance with the updated `disableremoteplayback` attribute.
     */
    public function disableremoteplayback(bool $value): static
    {
        return $this->addAttribute(ElementAttribute::DISABLEREMOTEPLAYBACK, $value);
    }

    /**
     * Sets the `loop` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->loop(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether media should restart automatically when playback reaches the end.
     *
     * @return static New instance with the updated `loop` attribute.
     */
    public function loop(bool $value): static
    {
        return $this->addAttribute(ElementAttribute::LOOP, $value);
    }

    /**
     * Sets the `muted` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->muted(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether media output should be initially muted.
     *
     * @return static New instance with the updated `muted` attribute.
     */
    public function muted(bool $value): static
    {
        return $this->addAttribute(ElementAttribute::MUTED, $value);
    }

    /**
     * Sets the `preload` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->preload(Preload::AUTO)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Preload hint ('none', 'metadata', or 'auto'), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `preload` attribute.
     *
     * {@see Preload} for predefined enum values.
     */
    public function preload(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Preload::cases(), ElementAttribute::PRELOAD);

        return $this->addAttribute(ElementAttribute::PRELOAD, $value);
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
     * Returns the tag enumeration for the `<audio>` element.
     *
     * @return Block Tag enumeration instance for `<audio>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::AUDIO;
    }
}
