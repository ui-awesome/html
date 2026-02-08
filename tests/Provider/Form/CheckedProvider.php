<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\InputCheckboxTest} test cases.
 *
 * Provides representative input/output pairs for the `checked` and `value` attribute.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class CheckedProvider
{
    /**
     * @return array<string, array{bool|int|string|null, bool|int|string|null, string}>
     */
    public static function checked(): array
    {
        return [
            // boolean true (always checked)
            'bool-true-int' => [
                true,
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'bool-true-null' => [
                true,
                null,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" checked>
                HTML,
            ],
            'bool-true-string' => [
                true,
                'active',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="active" checked>
                HTML,
            ],
            // boolean false (never checked)
            'bool-false-int' => [
                false,
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1">
                HTML,
            ],
            'bool-false-null' => [
                false,
                null,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox">
                HTML,
            ],
            'bool-false-false' => [
                false,
                false,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="0">
                HTML,
            ],
            'bool-false-string' => [
                false,
                'active',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="active">
                HTML,
            ],
            // null (never checked)
            'null-int' => [
                null,
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1">
                HTML,
            ],
            'null-null' => [
                null,
                null,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox">
                HTML,
            ],
            // scalar matching (checked)
            'int-0-int-0' => [
                0,
                0,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="0" checked>
                HTML,
            ],
            'int-1-int-1' => [
                1,
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'string-1-boolean-true' => [
                '1',
                true,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'string-1-string-1' => [
                '1',
                '1',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'string-active-string-active' => [
                'active',
                'active',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="active" checked>
                HTML,
            ],
            // scalar mismatch (unchecked)
            'int-1-int-0' => [
                1,
                0,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="0">
                HTML,
            ],
            'string-active-string-inactive' => [
                'active',
                'inactive',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="inactive">
                HTML,
            ],
            // type juggling (checked)
            'int-1-string-1' => [
                1,
                '1',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'string-1-int-1' => [
                '1',
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            // type juggling (unchecked)
            'int-1-string-0' => [
                1,
                '0',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="0">
                HTML,
            ],
        ];
    }
}
