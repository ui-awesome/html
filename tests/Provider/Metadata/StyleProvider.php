<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Metadata;

use UIAwesome\Html\Attribute\Values\{Blocking, Type};

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Metadata\StyleTest} test cases.
 */
final class StyleProvider
{
    /**
     * @return array<string, array{Blocking|string, string}>
     */
    public static function blocking(): array
    {
        return [
            'render' => [
                'render',
                'render',
            ],
            'RENDER' => [
                Blocking::RENDER,
                'render',
            ],
        ];
    }

    /**
     * @return array<array-key, array{string|Type, string}>
     */
    public static function type(): array
    {
        return [
            'button' => [
                'button',
                'button',
            ],
            'checkbox' => [
                'checkbox',
                'checkbox',
            ],
            'color' => [
                'color',
                'color',
            ],
            'date' => [
                'date',
                'date',
            ],
            'datetime-local' => [
                'datetime-local',
                'datetime-local',
            ],
            '1' => [
                '1',
                '1',
            ],
            'email' => [
                'email',
                'email',
            ],
            'file' => [
                'file',
                'file',
            ],
            'hidden' => [
                'hidden',
                'hidden',
            ],
            'image' => [
                'image',
                'image',
            ],
            'importmap' => [
                'importmap',
                'importmap',
            ],
            'a' => [
                'a',
                'a',
            ],
            'i' => [
                'i',
                'i',
            ],
            'module' => [
                'module',
                'module',
            ],
            'month' => [
                'month',
                'month',
            ],
            'number' => [
                'number',
                'number',
            ],
            'password' => [
                'password',
                'password',
            ],
            'radio' => [
                'radio',
                'radio',
            ],
            'range' => [
                'range',
                'range',
            ],
            'reset' => [
                'reset',
                'reset',
            ],
            'search' => [
                'search',
                'search',
            ],
            'speculationrules' => [
                'speculationrules',
                'speculationrules',
            ],
            'submit' => [
                'submit',
                'submit',
            ],
            'tel' => [
                'tel',
                'tel',
            ],
            'text' => [
                'text',
                'text',
            ],
            'text/css' => [
                'text/css',
                'text/css',
            ],
            'text/html' => [
                'text/html',
                'text/html',
            ],
            'text/javascript' => [
                'text/javascript',
                'text/javascript',
            ],
            'time' => [
                'time',
                'time',
            ],
            'A' => [
                'A',
                'A',
            ],
            'I' => [
                'I',
                'I',
            ],
            'url' => [
                'url',
                'url',
            ],
            'week' => [
                'week',
                'week',
            ],
            'BUTTON' => [
                Type::BUTTON,
                'button',
            ],
            'CHECKBOX' => [
                Type::CHECKBOX,
                'checkbox',
            ],
            'COLOR' => [
                Type::COLOR,
                'color',
            ],
            'DATE' => [
                Type::DATE,
                'date',
            ],
            'DATETIME_LOCAL' => [
                Type::DATETIME_LOCAL,
                'datetime-local',
            ],
            'DECIMAL' => [
                Type::DECIMAL,
                '1',
            ],
            'EMAIL' => [
                Type::EMAIL,
                'email',
            ],
            'FILE' => [
                Type::FILE,
                'file',
            ],
            'HIDDEN' => [
                Type::HIDDEN,
                'hidden',
            ],
            'IMAGE' => [
                Type::IMAGE,
                'image',
            ],
            'IMPORTMAP' => [
                Type::IMPORTMAP,
                'importmap',
            ],
            'LOWER_ALPHA' => [
                Type::LOWER_ALPHA,
                'a',
            ],
            'LOWER_ROMAN' => [
                Type::LOWER_ROMAN,
                'i',
            ],
            'MODULE' => [
                Type::MODULE,
                'module',
            ],
            'MONTH' => [
                Type::MONTH,
                'month',
            ],
            'NUMBER' => [
                Type::NUMBER,
                'number',
            ],
            'PASSWORD' => [
                Type::PASSWORD,
                'password',
            ],
            'RADIO' => [
                Type::RADIO,
                'radio',
            ],
            'RANGE' => [
                Type::RANGE,
                'range',
            ],
            'RESET' => [
                Type::RESET,
                'reset',
            ],
            'SEARCH' => [
                Type::SEARCH,
                'search',
            ],
            'SPECULATIONRULES' => [
                Type::SPECULATIONRULES,
                'speculationrules',
            ],
            'SUBMIT' => [
                Type::SUBMIT,
                'submit',
            ],
            'TEL' => [
                Type::TEL,
                'tel',
            ],
            'TEXT' => [
                Type::TEXT,
                'text',
            ],
            'TEXT_CSS' => [
                Type::TEXT_CSS,
                'text/css',
            ],
            'TEXT_HTML' => [
                Type::TEXT_HTML,
                'text/html',
            ],
            'TEXT_JAVASCRIPT' => [
                Type::TEXT_JAVASCRIPT,
                'text/javascript',
            ],
            'TIME' => [
                Type::TIME,
                'time',
            ],
            'UPPER_ALPHA' => [
                Type::UPPER_ALPHA,
                'A',
            ],
            'UPPER_ROMAN' => [
                Type::UPPER_ROMAN,
                'I',
            ],
            'URL' => [
                Type::URL,
                'url',
            ],
            'WEEK' => [
                Type::WEEK,
                'week',
            ],
        ];
    }
}
