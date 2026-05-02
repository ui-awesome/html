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

use function explode;
use function is_string;
use function str_replace;
use function strpbrk;

/**
 * Renders the HTML `<video>` element for embedding video content.
 *
 * Supports the experimental `disablepictureinpicture` and `disableremoteplayback` attributes. Availability and
 * behavior may vary across browsers.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Embedded\Video::tag()
 *     ->controls(true)
 *     ->src('/media/intro.mp4')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/video
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Video extends BaseBlock
{
    use HasCrossorigin;

    /**
     * Sets the `autoplay` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
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
     * echo \UIAwesome\Html\Embedded\Video::tag()
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
     * echo \UIAwesome\Html\Embedded\Video::tag()
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
            $tokens = explode(' ', str_replace(["\t", "\n", "\r", "\f"], ' ', $value));

            foreach ($tokens as $token) {
                if ($token === '') {
                    continue;
                }

                Validator::oneOf($token, Controlslist::cases(), ElementAttribute::CONTROLSLIST);
            }

            return $this->addAttribute(ElementAttribute::CONTROLSLIST, $value);
        }

        Validator::oneOf($value, Controlslist::cases(), ElementAttribute::CONTROLSLIST);

        return $this->addAttribute(ElementAttribute::CONTROLSLIST, $value);
    }

    /**
     * Sets the `disablepictureinpicture` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
     *     ->disablepictureinpicture(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether Picture-in-Picture controls and suggestions should be disabled.
     *
     * @return static New instance with the updated `disablepictureinpicture` attribute.
     */
    public function disablepictureinpicture(bool $value): static
    {
        return $this->addAttribute('disablepictureinpicture', $value);
    }

    /**
     * Sets the `disableremoteplayback` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
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
     * Sets the `height` attribute.
     *
     * Usage example:
     * ```php
     * $element->height(200);
     * $element->height('50%');
     * $element->height('auto');
     * ```
     *
     * @param int|string|Stringable|UnitEnum|null $value Height value in pixels or CSS units, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `height` attribute.
     */
    public function height(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::HEIGHT, $value);
    }

    /**
     * Sets the `loop` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
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
     * echo \UIAwesome\Html\Embedded\Video::tag()
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
     * Sets the `playsinline` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
     *     ->playsinline(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether video playback should stay inline instead of entering fullscreen.
     *
     * @return static New instance with the updated `playsinline` attribute.
     */
    public function playsinline(bool $value): static
    {
        return $this->addAttribute('playsinline', $value);
    }

    /**
     * Sets the `poster` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
     *     ->poster('/images/cover.jpg')
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Poster image URL, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `poster` attribute.
     */
    public function poster(string|UnitEnum|null $value): static
    {
        return $this->addAttribute('poster', $value);
    }

    /**
     * Sets the `preload` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
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
     * Sets the `width` attribute.
     *
     * Usage example:
     * ```php
     * $element->width(400);
     * $element->width('50%');
     * $element->width('auto');
     * $element->width(null);
     * ```
     *
     * @param int|string|Stringable|UnitEnum|null $value Width value in pixels or CSS units, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `width` attribute.
     */
    public function width(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::WIDTH, $value);
    }

    /**
     * Returns the tag enumeration for the `<video>` element.
     *
     * @return Block Tag enumeration instance for `<video>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::VIDEO;
    }
}
