<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input\Base;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\HasClass,
    Attribute\HasId,
    Attribute\HasName,
    Attribute\HasStyle,
    Attribute\HasValue,
    Concern\HasAttributes,
    Concern\HasTemplate,
    Core\Tag,
    Helper\Utils,
    Helper\Validator,
    Interop\RenderInterface,
    Interop\ValueInterface
};

abstract class AbstractHidden extends Element implements RenderInterface, ValueInterface
{
    use HasAttributes;
    use HasClass;
    use HasId;
    use HasName;
    use HasStyle;
    use HasTemplate;
    use HasValue;

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'id()' => [Utils::generateId('hidden-')],
        ];
    }

    protected function run(): string
    {
        Validator::isString($this->getValue());

        return Tag::widget()->attributes($this->attributes)->tagName('input')->type('hidden')->render();
    }
}
