<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use PHPForge\Support\Stub\{BackedInteger, BackedString, Unit};
use Stringable;
use UnitEnum;

/**
 * Provides names and multiple-file expectations for {@see \UIAwesome\Html\Tests\Form\InputFileTest}.
 */
final class InputFileProvider
{
    /**
     * @return array<string, array{string|Stringable|UnitEnum|null, bool, string, string}>
     */
    public static function names(): array
    {
        return [
            'null name' => [
                null,
                false,
                '',
                '<input type="file">',
            ],
            'null name with multiple' => [
                null,
                true,
                '[]',
                "<input name='[]' type=\"file\" multiple>",
            ],
            'empty name' => [
                '',
                false,
                '',
                '<input type="file">',
            ],
            'empty name with multiple' => [
                '',
                true,
                '[]',
                "<input name='[]' type=\"file\" multiple>",
            ],
            'string name' => [
                'uploads',
                false,
                'uploads',
                '<input name="uploads" type="file">',
            ],
            'string name with multiple' => [
                'uploads',
                true,
                'uploads[]',
                '<input name="uploads[]" type="file" multiple>',
            ],
            'arrayable name' => [
                'uploads[]',
                false,
                'uploads[]',
                '<input name="uploads[]" type="file">',
            ],
            'arrayable name with multiple' => [
                'uploads[]',
                true,
                'uploads[]',
                '<input name="uploads[]" type="file" multiple>',
            ],
            'string-backed name' => [
                BackedString::VALUE,
                false,
                'value',
                '<input name="value" type="file">',
            ],
            'string-backed name with multiple' => [
                BackedString::VALUE,
                true,
                'value[]',
                '<input name="value[]" type="file" multiple>',
            ],
            'integer-backed name' => [
                BackedInteger::VALUE,
                false,
                '1',
                '<input name="1" type="file">',
            ],
            'integer-backed name with multiple' => [
                BackedInteger::VALUE,
                true,
                '1[]',
                '<input name="1[]" type="file" multiple>',
            ],
            'unit enum name' => [
                Unit::value,
                false,
                'value',
                '<input name="value" type="file">',
            ],
            'unit enum name with multiple' => [
                Unit::value,
                true,
                'value[]',
                '<input name="value[]" type="file" multiple>',
            ],
            'stringable name' => [
                new class implements Stringable {
                    public function __toString(): string
                    {
                        return 'uploads';
                    }
                },
                false,
                'uploads',
                '<input name="uploads" type="file">',
            ],
            'stringable name with multiple' => [
                new class implements Stringable {
                    public function __toString(): string
                    {
                        return 'uploads';
                    }
                },
                true,
                'uploads[]',
                '<input name="uploads[]" type="file" multiple>',
            ],
            'arrayable stringable name' => [
                new class implements Stringable {
                    public function __toString(): string
                    {
                        return 'uploads[]';
                    }
                },
                false,
                'uploads[]',
                '<input name="uploads[]" type="file">',
            ],
            'arrayable stringable name with multiple' => [
                new class implements Stringable {
                    public function __toString(): string
                    {
                        return 'uploads[]';
                    }
                },
                true,
                'uploads[]',
                '<input name="uploads[]" type="file" multiple>',
            ],
        ];
    }
}
