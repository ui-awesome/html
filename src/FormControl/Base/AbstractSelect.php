<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Base;

use InvalidArgumentException;
use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\Aria\HasAriaLabel,
    Attribute\CanBeAutofocus,
    Attribute\FormControl\CanBeDisabled,
    Attribute\FormControl\CanBeMultiple,
    Attribute\FormControl\CanBeRequired,
    Attribute\FormControl\HasAutocomplete,
    Attribute\FormControl\HasFieldAttributes,
    Attribute\FormControl\HasSize,
    Attribute\HasClass,
    Attribute\HasId,
    Attribute\HasName,
    Attribute\HasStyle,
    Attribute\HasTabindex,
    Attribute\HasValue,
    Concern\HasAttributes,
    Concern\HasLabelCollection,
    Concern\HasPrefixCollection,
    Concern\HasSuffixCollection,
    Core\Tag,
    FormControl\Label,
    Interop\InputInterface,
    Interop\RenderInterface,
    Interop\Validator\RequiredInterface,
    Interop\ValueInterface
};

use function array_merge;
use function get_debug_type;
use function implode;
use function in_array;
use function is_array;
use function is_object;

/**
 * Provides a foundation for creating HTML `select` elements with various attributes and content.
 */
abstract class AbstractSelect extends Element implements
    InputInterface,
    RenderInterface,
    RequiredInterface,
    ValueInterface
{
    use CanBeAutofocus;
    use CanBeDisabled;
    use CanBeMultiple;
    use CanBeRequired;
    use HasAriaLabel;
    use HasAttributes;
    use HasAutocomplete;
    use HasClass;
    use HasFieldAttributes;
    use HasId;
    use HasLabelCollection;
    use HasName;
    use HasPrefixCollection;
    use HasSize;
    use HasStyle;
    use HasSuffixCollection;
    use HasTabindex;
    use HasValue;

    protected array $groups = [];
    protected array $items = [];
    protected array $itemsAttributes = [];
    protected string $prompt = '';
    protected string|null $promptValue = null;

    /**
     * Specifying the `<optgroup>` tags.
     *
     * The structure of this is similar to that of attributes, except that the array keys represent the optgroup
     * labels specified in $items.
     *
     * ```php
     * [
     *     'groups' => [
     *         '1' => ['label' => 'Chile'],
     *         '2' => ['label' => 'Russia']
     *     ],
     * ];
     * ```
     *
     * @param array $values The optgroup labels specified in items.
     *
     * @return static A new instance of the current class with the specified groups value.
     *
     * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/optgroup.html#optgroup
     */
    public function groups(array $values = []): static
    {
        $new = clone $this;
        $new->groups = $values;

        return $new;
    }

    /**
     * Set the items.
     *
     * The array keys are option values, and the array values are the corresponding option labels. The array can also
     * be nested (for example, some array values are arrays too). For each subarray, an option group will be generated
     * whose label is the key associated with the subarray.
     *
     * Example:
     * ```php
     * [
     *     '1' => 'Santiago',
     *     '2' => 'Concepcion',
     *     '3' => 'Chillan',
     *     '4' => 'Moscu'
     *     '5' => 'San Petersburg',
     *     '6' => 'Novosibirsk',
     *     '7' => 'Ekaterinburgo'
     * ];
     * ```
     *
     * Example with options groups:
     * ```php
     * [
     *     '1' => [
     *         '1' => 'Santiago',
     *         '2' => 'Concepcion',
     *         '3' => 'Chillan',
     *     ],
     *     '2' => [
     *         '4' => 'Moscu',
     *         '5' => 'San Petersburg',
     *         '6' => 'Novosibirsk',
     *         '7' => 'Ekaterinburgo'
     *     ],
     * ];
     * ```
     *
     * @param array $value The items.
     *
     * @return static A new instance of the current class with the specified items.
     */
    public function items(array $value = []): static
    {
        $new = clone $this;
        $new->items = $value;

        return $new;
    }

    /**
     * Set the `HTML` attributes for the items.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified items attributes.
     */
    public function itemsAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->itemsAttributes = $values;

        return $new;
    }

    /**
     * Set the prompt option can be used to define a string that will be displayed on the first line of the drop-down
     * list widget.
     *
     * @param string $content The prompt content.
     * @param string|null $value The value for the prompt.
     *
     * @return static A new instance of the current class with the specified prompt option.
     */
    public function prompt(string $content, string $value = null): static
    {
        $new = clone $this;
        $new->prompt = $content;
        $new->promptValue = $value;

        return $new;
    }

    protected function run(): string
    {
        /** @psalm-var array<int, \Stringable|scalar>|scalar|object|null $value */
        $value = $this->getValue();

        $items = match ($this->prompt) {
            '' => PHP_EOL . Tag::widget()->content('Select an option')->tagName('option')->render(),
            default => PHP_EOL . Tag::widget()
                ->content($this->prompt)
                ->tagName('option')
                ->value($this->promptValue)
                ->render(),
        };

        if (is_object($value)) {
            throw new InvalidArgumentException('Select::class widget value can not be an object.');
        }

        if ($this->isMultiple() === true && is_array($value) === false) {
            throw new InvalidArgumentException('Select::class widget value must be an array when multiple is "true".');
        }

        if ($this->items !== []) {
            $items .= PHP_EOL . implode(PHP_EOL, $this->renderItems($value)) . PHP_EOL;
        }

        unset($this->attributes['value']);

        $selectTag = Tag::widget()
            ->attributes($this->attributes)
            ->content($items)
            ->prefix($this->prefix)
            ->prefixAttributes($this->prefixAttributes)
            ->prefixTag($this->prefixTag)
            ->suffix($this->suffix)
            ->suffixAttributes($this->suffixAttributes)
            ->suffixTag($this->suffixTag)
            ->tagName('select');

        if ($this->disableLabel === true || $this->label === '') {
            return $selectTag->render();
        }

        return Label::widget()
            ->attributes($this->labelAttributes)
            ->content($this->label, PHP_EOL, $selectTag, PHP_EOL)
            ->for($this->labelFor)
            ->render();
    }

    /**
     * @psalm-return string[]
     *
     * @psalm-param array<int, \Stringable|scalar>|null|scalar $formValue
     */
    private function renderItems(mixed $formValue): array
    {
        $formValue = match (get_debug_type($formValue)) {
            'array' => $formValue,
            default => [$formValue],
        };
        $items = [];
        $itemsAttributes = $this->itemsAttributes;
        /** @psalm-var string[]|string[][] $values */
        $values = $this->items;

        foreach ($values as $value => $content) {
            if (is_array($content)) {
                /** @psalm-var array $groupAttrs */
                $groupAttrs = $this->groups[$value] ?? [];
                $options = [];

                foreach ($content as $v => $c) {
                    /** @psalm-var array[] $itemsAttributes */
                    $itemsAttributes[$v] ??= [];
                    $options[] = Tag::widget()
                        ->attributes(
                            array_merge(
                                $itemsAttributes[$v],
                                [
                                    'selected' => in_array($v, $formValue),
                                    'value' => $v,
                                ],
                            )
                        )
                        ->content($c)
                        ->tagName('option')
                        ->render();
                }

                $items[] = Tag::widget()
                    ->attributes($groupAttrs)
                    ->content(implode(PHP_EOL, $options))
                    ->tagName('optgroup')
                    ->render();
            } else {
                /** @psalm-var array[] $itemsAttributes */
                $itemsAttributes[$value] ??= [];
                $items[] = Tag::widget()
                    ->attributes(
                        array_merge(
                            $itemsAttributes[$value],
                            [
                                'selected' => in_array($value, $formValue),
                                'value' => $value,
                            ],
                        )
                    )
                    ->content($content)
                    ->tagName('option')
                    ->render();
            }
        }

        return $items;
    }
}
