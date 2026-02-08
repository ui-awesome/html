<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\Form\{HasChecked, HasRequired};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Form\Mixin\{CanBeEnclosedByLabel, HasLabel};
use UIAwesome\Html\Interop\{VoidInterface, Voids};
use UIAwesome\Html\Phrasing\Label;
use UnitEnum;

/**
 * Represents the HTML `<input type="checkbox">` element.
 *
 * The checkbox is a graphical control element that allows the user to select or deselect one or more independent
 * options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputCheckbox::tag()
 *     ->checked(true)
 *     ->name('terms')
 *     ->value('accepted')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/checkbox
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputCheckbox extends BaseInput
{
    use CanBeAutofocus;
    use CanBeEnclosedByLabel;
    use HasChecked;
    use HasLabel;
    use HasRequired;
    use HasTabindex;
    use HasValue;

    private float|int|string|Stringable|UnitEnum|null $uncheckedValue = null;

    /**
     * Set the value that should be submitted when the checkbox is not checked.
     *
     * @param float|int|string|Stringable|UnitEnum|null $value Value to be submitted.
     *
     * @return static New instance with the updated `uncheckedValue` value.
     */
    public function uncheckedValue(float|int|string|Stringable|UnitEnum|null $value): self
    {
        $new = clone $this;
        $new->uncheckedValue = $value;

        return $new;
    }

    /**
     * Returns the tag enumeration for the `<input>` element.
     *
     * @return VoidInterface Tag enumeration instance for `<input>`.
     */
    protected function getTag(): VoidInterface
    {
        return Voids::INPUT;
    }

    /**
     * Returns the default configuration for the input element.
     *
     * @return array Default configuration array with method calls as keys.
     *
     * @phpstan-return array<string, mixed>
     */
    protected function loadDefault(): array
    {
        return [
            'template' => ['{prefix}\n{unchecked}\n{tag}\n{label}\n{suffix}'],
            'type' => [Type::CHECKBOX],
        ] + parent::loadDefault();
    }

    /**
     * Renders the `<input>` element with its attributes.
     *
     * @return string Rendered HTML for the `<input>` element.
     */
    protected function run(): string
    {
        /** @var string|null $id */
        $id = $this->getAttribute('id', null);

        $unchecked = '';

        if ($this->uncheckedValue !== null) {
            /** @phpstan-var string $name */
            $name = $this->getAttribute('name', '');

            $unchecked = InputHidden::tag()
                ->id(null)
                ->name($name)
                ->value($this->uncheckedValue)
                ->render();
        }

        if ($this->notLabel || $this->label === '') {
            return $this->buildElement('', ['{label}' => '', '{unchecked}' => $unchecked]);
        }

        $labelTag = Label::tag();

        $labelAttributes = $this->labelAttributes;

        if (isset($labelAttributes['for']) === false) {
            $labelTag = $labelTag->for($id);
        }

        if ($this->enclosedByLabel === false) {
            $labelTag = $labelTag->attributes($this->labelAttributes)->content($this->label);

            return $this->buildElement(
                '',
                [
                    '{label}' => $labelTag,
                    '{unchecked}' => $unchecked,
                ],
            );
        }

        $labelTag = $labelTag
            ->attributes($this->labelAttributes)
            ->html(
                PHP_EOL,
                Html::element($this->getTag(), '', $this->getAttributes()),
                PHP_EOL,
                $this->label,
                PHP_EOL,
            );

        return $this->buildElement(
            '',
            [
                '{tag}' => $labelTag,
                '{label}' => '',
                '{unchecked}' => $unchecked,
            ],
        );
    }
}
