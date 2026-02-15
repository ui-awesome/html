<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Base;

use UIAwesome\Html\Attribute\Form\HasRequired;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Form\InputHidden;
use UIAwesome\Html\Form\Mixin\{CanBeEnclosedByLabel, CanBeUnchecked, HasCheckedState};
use UIAwesome\Html\Mixin\HasLabelCollection;
use UIAwesome\Html\Phrasing\Label;

use function array_key_exists;

abstract class BaseChoice extends BaseInput
{
    use CanBeAutofocus;
    use CanBeEnclosedByLabel;
    use CanBeUnchecked;
    use HasCheckedState;
    use HasLabelCollection;
    use HasRequired;
    use HasTabindex;
    use HasValue;

    /**
     * Returns the array of HTML attributes for the element.
     *
     * @return array Attributes array assigned to the element.
     *
     * @phpstan-return mixed[]
     */
    public function getAttributes(): array
    {
        return $this->buildAttributes(parent::getAttributes());
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
        $uncheckedValue = $this->getUncheckedValue();

        if ($uncheckedValue !== null) {
            /** @phpstan-var string $name */
            $name = $this->getAttribute('name', '');

            $unchecked = InputHidden::tag()
                ->id(null)
                ->name($name)
                ->value($uncheckedValue)
                ->render();
        }

        $label = $this->getLabel();

        if ($this->isLabel() === false) {
            return $this->buildElement(
                '',
                [
                    '{label}' => '',
                    '{unchecked}' => $unchecked,
                ],
            );
        }

        $labelAttributes = $this->getLabelAttributes();
        $labelTag = Label::tag()->attributes($labelAttributes);

        if ($this->enclosedByLabel === false) {
            if (array_key_exists('for', $labelAttributes) === false) {
                $labelTag = $labelTag->for($id);
            }

            $labelTag = $labelTag->content($label);

            return $this->buildElement(
                '',
                [
                    '{label}' => $labelTag,
                    '{unchecked}' => $unchecked,
                ],
            );
        }

        $labelTag = $labelTag
            ->html(
                "\n",
                Html::element($this->getTag(), '', $this->getAttributes()),
                "\n",
                $label,
                "\n",
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
