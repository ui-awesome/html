<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use PHPForge\Support\Stub\BackedString;
use PHPForge\Support\Stub\Unit;
use Stringable;
use UnitEnum;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\InputCheckboxTest} and
 * {@see \UIAwesome\Html\Tests\Form\InputRadioTest} test cases.
 *
 * Provides representative input/output pairs for the `checked` and `value` attribute.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class CheckedProvider
{
    /**
     * @return array<
     *   string,
     *   array{
     *     mixed[]|bool|float|int|string|Stringable|UnitEnum|null,
     *     bool|float|int|string|Stringable|UnitEnum|null, string,
     *   },
     * >
     */
    public static function checked(): array
    {
        return [
            // array (checked)
            'checked: [1, 2], value: 1' => [
                [1, 2],
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            // array (unchecked)
            'checked: [1, 2], value: 3' => [
                [1, 2],
                3,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="3">
                HTML,
            ],
            // array type juggling (checked)
            'checked: ["1", "2"], value: 1' => [
                ['1', '2'],
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'checked: [1, 2], value: "1"' => [
                [1, 2],
                '1',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            // backed enum (checked)
            'checked: BackedEnum("value"), value: "value"' => [
                BackedString::VALUE,
                'value',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="value" checked>
                HTML,
            ],
            // backed enum (unchecked)
            'checked: BackedEnum("value"), value: "other"' => [
                BackedString::VALUE,
                'other',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="other">
                HTML,
            ],
            // boolean `false` (never checked)
            'checked: false, value: "active"' => [
                false,
                'active',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="active">
                HTML,
            ],
            'checked: false, value: ""' => [
                false,
                '',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox">
                HTML,
            ],
            'checked: false, value: 1' => [
                false,
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1">
                HTML,
            ],
            'checked: false, value: false' => [
                false,
                false,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="0">
                HTML,
            ],
            'checked: false, value: null' => [
                false,
                null,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox">
                HTML,
            ],
            // boolean `true` (always checked)
            'checked: true, value: "active"' => [
                true,
                'active',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="active" checked>
                HTML,
            ],
            'checked: true, value: 1' => [
                true,
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'checked: true, value: null' => [
                true,
                null,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" checked>
                HTML,
            ],
            // float matching (checked)
            'checked: 1.1, value: 1.1' => [
                1.1,
                1.1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1.1" checked>
                HTML,
            ],
            'checked: 1.1, value: "1.1"' => [
                1.1,
                '1.1',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1.1" checked>
                HTML,
            ],
            'checked: "1.1", value: 1.1' => [
                '1.1',
                1.1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1.1" checked>
                HTML,
            ],
            // float mismatch (unchecked)
            'checked: 1.1, value: 1.2' => [
                1.1,
                1.2,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1.2">
                HTML,
            ],
            // null (never checked)
            'checked: null, value: 1' => [
                null,
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1">
                HTML,
            ],
            'checked: null, value: null' => [
                null,
                null,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox">
                HTML,
            ],
            // scalar matching (checked)
            'checked: "active", value: "active"' => [
                'active',
                'active',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="active" checked>
                HTML,
            ],
            'checked: 0, value: 0' => [
                0,
                0,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="0" checked>
                HTML,
            ],
            'checked: 1, value: 1' => [
                1,
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'checked: "1", value: true' => [
                '1',
                true,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'checked: "1", value: "1"' => [
                '1',
                '1',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            // scalar mismatch (unchecked)
            'checked: "active", value: "inactive"' => [
                'active',
                'inactive',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="inactive">
                HTML,
            ],
            'checked: 1, value: 0' => [
                1,
                0,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="0">
                HTML,
            ],
            // type juggling (checked)
            'checked: 1, value: "1"' => [
                1,
                '1',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            'checked: "1", value: 1' => [
                '1',
                1,
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="1" checked>
                HTML,
            ],
            // type juggling (unchecked)
            'checked: 1, value: "0"' => [
                1,
                '0',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="0">
                HTML,
            ],
            // stringable (checked)
            'checked: stringable("active"), value: "active"' => [
                new class implements Stringable {
                    public function __toString(): string
                    {
                        return 'active';
                    }
                },
                'active',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="active" checked>
                HTML,
            ],
            // stringable (unchecked)
            'checked: stringable("inactive"), value: "active"' => [
                new class implements Stringable {
                    public function __toString(): string
                    {
                        return 'inactive';
                    }
                },
                'active',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="active">
                HTML,
            ],
            // unit enum (checked)
            'checked: UnitEnum("value"), value: "value"' => [
                Unit::value,
                'value',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="value" checked>
                HTML,
            ],
            // unit enum (unchecked)
            'checked: UnitEnum("value"), value: "other"' => [
                Unit::value,
                'other',
                <<<HTML
                <input id="inputcheckbox-" type="checkbox" value="other">
                HTML,
            ],
        ];
    }
}
