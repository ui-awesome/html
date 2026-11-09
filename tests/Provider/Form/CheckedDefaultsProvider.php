<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

/**
 * Provides explicit selections overriding checked defaults for atomic controls and choice lists.
 */
final class CheckedDefaultsProvider
{
    /**
     * @return array<string, array{array<string>|bool|string|null, bool, string}>
     */
    public static function inputs(): array
    {
        return [
            'array match keeps checked' => [
                ['other', 'active', 'another'],
                true,
                '<input type="checkbox" value="active" checked>',
            ],
            'array mismatch clears default' => [
                ['other'],
                false,
                '<input type="checkbox" value="active">',
            ],
            'empty array clears default' => [
                [],
                false,
                '<input type="checkbox" value="active">',
            ],
            'false clears default' => [
                false,
                false,
                '<input type="checkbox" value="active">',
            ],
            'null clears default' => [
                null,
                false,
                '<input type="checkbox" value="active">',
            ],
            'scalar match keeps checked' => [
                'active',
                true,
                '<input type="checkbox" value="active" checked>',
            ],
            'scalar mismatch clears default' => [
                'other',
                false,
                '<input type="checkbox" value="active">',
            ],
            'true keeps checked' => [
                true,
                true,
                '<input type="checkbox" value="active" checked>',
            ],
        ];
    }

    /**
     * @return array<string, array{array<int>|bool|int|null, string}>
     */
    public static function lists(): array
    {
        return [
            'array mismatch clears both defaults' => [
                [3],
                <<<HTML
                <div>
                <input type="checkbox" value="1">
                <label>One</label>
                <input type="checkbox" value="2">
                <label>Two</label>
                </div>
                HTML,
            ],
            'array selects only matching item' => [
                [3, 1, 4],
                <<<HTML
                <div>
                <input type="checkbox" value="1" checked>
                <label>One</label>
                <input type="checkbox" value="2">
                <label>Two</label>
                </div>
                HTML,
            ],
            'empty array clears both defaults' => [
                [],
                <<<HTML
                <div>
                <input type="checkbox" value="1">
                <label>One</label>
                <input type="checkbox" value="2">
                <label>Two</label>
                </div>
                HTML,
            ],
            'false clears both defaults' => [
                false,
                <<<HTML
                <div>
                <input type="checkbox" value="1">
                <label>One</label>
                <input type="checkbox" value="2">
                <label>Two</label>
                </div>
                HTML,
            ],
            'null clears both defaults' => [
                null,
                <<<HTML
                <div>
                <input type="checkbox" value="1">
                <label>One</label>
                <input type="checkbox" value="2">
                <label>Two</label>
                </div>
                HTML,
            ],
            'scalar mismatch clears both defaults' => [
                3,
                <<<HTML
                <div>
                <input type="checkbox" value="1">
                <label>One</label>
                <input type="checkbox" value="2">
                <label>Two</label>
                </div>
                HTML,
            ],
            'scalar selects only matching item' => [
                2,
                <<<HTML
                <div>
                <input type="checkbox" value="1">
                <label>One</label>
                <input type="checkbox" value="2" checked>
                <label>Two</label>
                </div>
                HTML,
            ],
            'true keeps both defaults' => [
                true,
                <<<HTML
                <div>
                <input type="checkbox" value="1" checked>
                <label>One</label>
                <input type="checkbox" value="2" checked>
                <label>Two</label>
                </div>
                HTML,
            ],
        ];
    }
}
