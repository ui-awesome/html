<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use InvalidArgumentException;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Table;
use UIAwesome\Html\Table\Values\Scope;
use UnitEnum;

/**
 * Renders the HTML `<th>` element for table header cells.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Th::tag()
 *     ->content('Name')
 *     ->scope(\UIAwesome\Html\Table\Values\Scope::COL)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/th
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Th extends BaseBlock
{
    /**
     * Sets the `abbr` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Th::tag()
     *     ->abbr('International Business Machines')
     *     ->content('IBM')
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Abbreviated header description, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `abbr` attribute.
     */
    public function abbr(string|UnitEnum|null $value): static
    {
        return $this->addAttribute('abbr', $value);
    }

    /**
     * Sets the `colspan` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Td::tag()
     *     ->colspan(2)
     *     ->render();
     * ```
     *
     * @param int|string|null $value Number of columns a cell spans ('1' to '1000'), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not an integer-like value between '1' and '1000'.
     *
     * @return static New instance with the updated `colspan` attribute.
     */
    public function colspan(int|string|null $value): static
    {
        if ($value !== null && Validator::intLike($value, 1, 1000) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    'colspan',
                    '1 <= value <= 1000',
                ),
            );
        }

        return $this->addAttribute('colspan', $value);
    }

    /**
     * Sets the `headers` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Td::tag()
     *     ->headers('name age')
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Space-separated list of header cell IDs, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `headers` attribute.
     */
    public function headers(string|UnitEnum|null $value): static
    {
        return $this->addAttribute('headers', $value);
    }

    /**
     * Sets the `rowspan` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Td::tag()
     *     ->rowspan(2)
     *     ->render();
     * ```
     *
     * @param int|string|null $value Number of rows a cell spans ('0' to '65534'), or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not an integer-like value between '0' and '65534'.
     *
     * @return static New instance with the updated `rowspan` attribute.
     */
    public function rowspan(int|string|null $value): static
    {
        if ($value !== null && Validator::intLike($value, 0, 65534) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    'rowspan',
                    '0 <= value <= 65534',
                ),
            );
        }

        return $this->addAttribute('rowspan', $value);
    }

    /**
     * Sets the `scope` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Th::tag()
     *     ->content('Total')
     *     ->scope(\UIAwesome\Html\Table\Values\Scope::ROW)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Scope of related cells ('row', 'col', 'rowgroup', 'colgroup'), or `null` to
     * remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `scope` attribute.
     *
     * {@see Scope} for predefined enum values.
     */
    public function scope(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Scope::cases(), 'scope');

        return $this->addAttribute('scope', $value);
    }

    /**
     * Returns the tag enumeration for the `<th>` element.
     *
     * @return Table Tag enumeration instance for `<th>`.
     *
     * {@see Table} for valid table tags.
     */
    protected function getTag(): Table
    {
        return Table::TH;
    }
}
