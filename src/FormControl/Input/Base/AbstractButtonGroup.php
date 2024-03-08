<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input\Base;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Concern\HasContainerCollection,
    FormControl\Input\Button,
    FormControl\Input\Reset,
    FormControl\Input\Submit,
    Interop\RenderInterface,
    Tag
};

use function implode;

abstract class AbstractButtonGroup extends Element implements RenderInterface
{
    use HasContainerCollection;

    /**
     * @psalm-var Button[]|Reset[]|Submit[]
     */
    protected array $buttons = [];
    protected false|string $individualContainer = false;

    /**
     * Returns a new instance specifying List of buttons. Each array element represents a single input button.
     *
     * @param array $values The list of buttons.
     *
     * @psalm-param Button[]|Reset[]|Submit[] $values
     */
    public function buttons(Button|Reset|Submit ...$values): static
    {
        $new = clone $this;
        $new->buttons = $values;

        return $new;
    }

    /**
     * Set the tag name for the container element for each button.
     *
     * @param false|string $value The tag name for the container element for each button.
     * If `false` the container tag will be disabled.
     *
     * @return static A new instance of the current class with the specified container tag for each button.
     */
    public function individualContainer(false|string $value = 'div'): static
    {
        $new = clone $this;
        $new->individualContainer = $value;

        return $new;
    }

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'containerTag()' => [],
        ];
    }

    protected function run(): string
    {
        $content = $this->renderButtons();

        return match ($this->containerTag) {
            false => $content,
            default => Tag::widget()
                ->attributes($this->containerAttributes)
                ->content($content)
                ->tagName($this->containerTag)
                ->render()
        };
    }

    private function renderButtons(): string
    {
        $buttons = [];

        foreach ($this->buttons as $button) {
            $buttons[] = $button->containerTag($this->individualContainer)->render();
        }

        return implode("\n", $buttons);
    }
}
