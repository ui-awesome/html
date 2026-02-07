<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{HasChecked, HasForm, HasRequired};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Form\Mixin\{CanBeEnclosedByLabel, HasLabel};
use UIAwesome\Html\Interop\{VoidInterface, Voids};

use function str_replace;

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
    use HasForm;
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
        if ($this->enclosedByLabel) {
            if ($this->label === '') {
                return $this->buildElement('', ['{label}' => '']);
            }

            $inputTag = Html::element($this->getTag(), '', $this->getAttributes());

            $labelContent = PHP_EOL . $inputTag . PHP_EOL . $this->label . PHP_EOL;

            $labelAttributes = $this->labelAttributes;

            if (isset($this->attributes['id']) && isset($labelAttributes['for']) === false) {
                $labelAttributes['for'] = $this->attributes['id'];
            }

            $label = Html::element($this->labelTag, $labelContent, $labelAttributes);

            $new = clone $this;

            $new->template = str_replace('{tag}', '{label_enclosed}', $this->template);

            return $new->buildElement('', ['{label_enclosed}' => $label, '{label}' => '']);
        }

        return $this->buildElement('', ['{label}' => $this->renderLabelTag()]);
    }
}
