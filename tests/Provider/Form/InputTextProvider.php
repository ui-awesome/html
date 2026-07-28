<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use Closure;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Attribute\Values\{Attribute, GlobalAttribute};
use UIAwesome\Html\Form\InputText;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\InputTextTest} test cases.
 */
final class InputTextProvider
{
    /**
     * @return array<string, array{Closure(): InputText, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'maxlength below range' => [
                static fn(): InputText => InputText::tag()->maxlength(-1),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('-1', Attribute::MAXLENGTH->value, 'value >= 0'),
            ],
            'minlength below range' => [
                static fn(): InputText => InputText::tag()->minlength(-1),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('-1', Attribute::MINLENGTH->value, 'value >= 0'),
            ],
            'tabindex below range' => [
                static fn(): InputText => InputText::tag()->tabIndex(-2),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('-2', GlobalAttribute::TABINDEX->value, 'value >= -1'),
            ],
        ];
    }
}
