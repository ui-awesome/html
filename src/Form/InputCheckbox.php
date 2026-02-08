<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{HasChecked, HasRequired};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Form\Mixin\{CanBeEnclosedByLabel, HasLabel};
use UIAwesome\Html\Interop\{VoidInterface, Voids};
use UIAwesome\Html\Phrasing\Label;

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
            'template' => ['{prefix}\n{tag}\n{label}\n{suffix}'],
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

        if ($this->notLabel || $this->label === '') {
            return $this->buildElement('', ['{label}' => '']);
        }

        $labelTag = Label::tag();

        $labelAttributes = $this->labelAttributes;

        if (isset($labelAttributes['for']) === false) {
            $labelTag = $labelTag->for($id);
        }

        if ($this->enclosedByLabel === false) {
            $labelTag = $labelTag->attributes($this->labelAttributes)->content($this->label);

            return $this->buildElement('', ['{label}' => $labelTag]);
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

        return $this->buildElement('', ['{tag}' => $labelTag, '{label}' => '']);
    }
}
