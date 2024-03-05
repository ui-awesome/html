<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input;

use UIAwesome\Html\{
    Attribute\FormControl\CanBeMultiple,
    Attribute\FormControl\CanBeRequired,
    Attribute\FormControl\HasAccept,
    Concern\HasUncheckedCollection,
    Helper\Utils,
    Interop\Validator\RequiredInterface
};

/**
 * The input element with a type attribute whose value is "file" represents a list of file items, each consisting of a
 * file name, a file type, and a file body (the contents of the file).
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.file.html#input.file
 */
final class File extends Base\AbstractInput implements RequiredInterface
{
    use CanBeMultiple;
    use CanBeRequired;
    use HasAccept;
    use HasUncheckedCollection;

    protected string $type = 'file';

    protected function loadDefaultDefinitions(): array
    {
        return [
            'id()' => [Utils::generateId('file-')],
            'template()' => ['{prefix}\n{unchecktag}\n{tag}\n{suffix}'],
        ];
    }

    protected function run(): string
    {
        $attributes = $this->attributes;
        $uncheckTag = '';

        $name = $this->getName();

        if ($this->isMultiple() === true && $name !== '') {
            $attributes['name'] = Utils::generateArrayableName($name);
            $name = $attributes['name'];
        }

        // The value attribute is not allowed for the input type `file`.
        unset($attributes['value']);

        if ($this->uncheckValue !== null) {
            $uncheckTag = Hidden::widget()
                ->attributes($this->uncheckAttributes)
                ->id(null)
                ->name($name)
                ->value($this->uncheckValue)
                ->render();
        }

        return $this->renderInputTag($attributes, ['{unchecktag}' => $uncheckTag]);
    }
}
