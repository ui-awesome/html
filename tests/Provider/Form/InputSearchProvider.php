<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use Closure;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Attribute\Values\{Attribute, GlobalAttribute};
use UIAwesome\Html\Form\InputSearch;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\InputSearchTest} test cases.
 */
final class InputSearchProvider
{
    /**
     * @return array<string, array{Closure(): InputSearch, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'maxlength below range' => [
                static fn(): InputSearch => InputSearch::tag()->maxlength(-1),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('-1', Attribute::MAXLENGTH->value, 'value >= 0'),
            ],
            'minlength below range' => [
                static fn(): InputSearch => InputSearch::tag()->minlength(-1),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('-1', Attribute::MINLENGTH->value, 'value >= 0'),
            ],
            'tabindex below range' => [
                static fn(): InputSearch => InputSearch::tag()->tabIndex(-2),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('-2', GlobalAttribute::TABINDEX->value, 'value >= -1'),
            ],
        ];
    }
}
