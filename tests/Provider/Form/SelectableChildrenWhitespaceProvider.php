<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use UIAwesome\Html\Form\{Optgroup, Select};

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\SelectableChildrenWhitespaceTest} test cases.
 */
final class SelectableChildrenWhitespaceProvider
{
    /**
     * @return array<string, array{Optgroup|Select, string, string}>
     */
    public static function contentAfterOption(): array
    {
        return [
            'select: plain text' => [
                Select::tag(),
                'After',
                <<<HTML
                <select>
                <option>
                Santiago
                </option>
                After
                </select>
                HTML,
            ],
            'select: existing leading LF' => [
                Select::tag(),
                "\nAfter",
                <<<HTML
                <select>
                <option>
                Santiago
                </option>
                After
                </select>
                HTML,
            ],
            'select: repeated boundary LF' => [
                Select::tag(),
                "\n\nAfter\n\n",
                <<<HTML
                <select>
                <option>
                Santiago
                </option>

                After


                </select>
                HTML,
            ],
            'select: indentation and trailing spaces' => [
                Select::tag(),
                "\tAfter  ",
                <<<HTML
                <select>
                <option>
                Santiago
                </option>
                \tAfter\x20\x20
                </select>
                HTML,
            ],
            'select: empty text' => [
                Select::tag(),
                '',
                <<<HTML
                <select>
                <option>
                Santiago
                </option>
                </select>
                HTML,
            ],
            'select: encoded text' => [
                Select::tag(),
                '<after>',
                <<<HTML
                <select>
                <option>
                Santiago
                </option>
                &lt;after&gt;
                </select>
                HTML,
            ],
            'optgroup: plain text' => [
                Optgroup::tag(),
                'After',
                <<<HTML
                <optgroup>
                <option>
                Santiago
                </option>
                After
                </optgroup>
                HTML,
            ],
            'optgroup: existing leading LF' => [
                Optgroup::tag(),
                "\nAfter",
                <<<HTML
                <optgroup>
                <option>
                Santiago
                </option>
                After
                </optgroup>
                HTML,
            ],
            'optgroup: repeated boundary LF' => [
                Optgroup::tag(),
                "\n\nAfter\n\n",
                <<<HTML
                <optgroup>
                <option>
                Santiago
                </option>

                After


                </optgroup>
                HTML,
            ],
            'optgroup: indentation and trailing spaces' => [
                Optgroup::tag(),
                "\tAfter  ",
                <<<HTML
                <optgroup>
                <option>
                Santiago
                </option>
                \tAfter\x20\x20
                </optgroup>
                HTML,
            ],
            'optgroup: empty text' => [
                Optgroup::tag(),
                '',
                <<<HTML
                <optgroup>
                <option>
                Santiago
                </option>
                </optgroup>
                HTML,
            ],
            'optgroup: encoded text' => [
                Optgroup::tag(),
                '<after>',
                <<<HTML
                <optgroup>
                <option>
                Santiago
                </option>
                &lt;after&gt;
                </optgroup>
                HTML,
            ],
        ];
    }

    /**
     * @return array<string, array{Optgroup|Select, string, string}>
     */
    public static function contentBeforeOption(): array
    {
        return [
            'select: plain text' => [
                Select::tag(),
                'Before',
                <<<HTML
                <select>
                Before<option>
                Santiago
                </option>
                </select>
                HTML,
            ],
            'select: existing trailing LF' => [
                Select::tag(),
                "Before\n",
                <<<HTML
                <select>
                Before
                <option>
                Santiago
                </option>
                </select>
                HTML,
            ],
            'select: repeated boundary LF' => [
                Select::tag(),
                "\n\nBefore\n\n",
                <<<HTML
                <select>


                Before

                <option>
                Santiago
                </option>
                </select>
                HTML,
            ],
            'select: indentation and trailing spaces' => [
                Select::tag(),
                "\tBefore  ",
                <<<HTML
                <select>
                \tBefore  <option>
                Santiago
                </option>
                </select>
                HTML,
            ],
            'select: empty text' => [
                Select::tag(),
                '',
                <<<HTML
                <select>
                <option>
                Santiago
                </option>
                </select>
                HTML,
            ],
            'select: encoded text' => [
                Select::tag(),
                '<before>',
                <<<HTML
                <select>
                &lt;before&gt;<option>
                Santiago
                </option>
                </select>
                HTML,
            ],
            'optgroup: plain text' => [
                Optgroup::tag(),
                'Before',
                <<<HTML
                <optgroup>
                Before<option>
                Santiago
                </option>
                </optgroup>
                HTML,
            ],
            'optgroup: existing trailing LF' => [
                Optgroup::tag(),
                "Before\n",
                <<<HTML
                <optgroup>
                Before
                <option>
                Santiago
                </option>
                </optgroup>
                HTML,
            ],
            'optgroup: repeated boundary LF' => [
                Optgroup::tag(),
                "\n\nBefore\n\n",
                <<<HTML
                <optgroup>


                Before

                <option>
                Santiago
                </option>
                </optgroup>
                HTML,
            ],
            'optgroup: indentation and trailing spaces' => [
                Optgroup::tag(),
                "\tBefore  ",
                <<<HTML
                <optgroup>
                \tBefore  <option>
                Santiago
                </option>
                </optgroup>
                HTML,
            ],
            'optgroup: empty text' => [
                Optgroup::tag(),
                '',
                <<<HTML
                <optgroup>
                <option>
                Santiago
                </option>
                </optgroup>
                HTML,
            ],
            'optgroup: encoded text' => [
                Optgroup::tag(),
                '<before>',
                <<<HTML
                <optgroup>
                &lt;before&gt;<option>
                Santiago
                </option>
                </optgroup>
                HTML,
            ],
        ];
    }
}
