<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{CanBeMultiple, CanBeRequired, HasAccept, HasForm};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Form\Attribute\HasCapture;
use UIAwesome\Html\Helper\Naming;
use UIAwesome\Html\Interop\Voids;

/**
 * Renders the HTML `<input type="file">` element.
 *
 * The `<input type="file">` element allows the user to choose one or more files from their device storage. Once chosen,
 * the files can be uploaded to a server using form submission, or manipulated using JavaScript code and the File API.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputFile::tag()
 *     ->accept('image/png, image/jpeg')
 *     ->name('avatar')
 *     ->render();
 * echo \UIAwesome\Html\Form\InputFile::tag()
 *     ->multiple(true)
 *     ->name('photos')
 *     ->render();
 * echo \UIAwesome\Html\Form\InputFile::tag()
 *     ->capture(\UIAwesome\Html\Form\Values\Capture::USER)
 *     ->name('video')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/file
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputFile extends BaseInput
{
    use CanBeAutofocus;
    use CanBeMultiple;
    use CanBeRequired;
    use HasAccept;
    use HasCapture;
    use HasForm;
    use HasTabindex;

    /**
     * Returns the array of HTML attributes for the element.
     *
     * @return array Attributes array assigned to the element.
     *
     * @phpstan-return mixed[]
     */
    public function getAttributes(): array
    {
        $attributes = parent::getAttributes();

        $attributes['name'] = $this->generateNameWithMultiple();

        // value attribute is not allowed for the `<input type="file">` element, so we remove it if it exists.
        unset($attributes['value']);

        return $attributes;
    }

    /**
     * Returns the tag enumeration for the `<input>` element.
     *
     * @return Voids Tag enumeration instance for `<input>`.
     */
    protected function getTag(): Voids
    {
        return Voids::INPUT;
    }

    /**
     * Returns the default configuration for the input element.
     *
     * @return array Default configuration array with method calls as keys.
     *
     * @phpstan-return array<string, mixed>
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::FILE]];
    }

    /**
     * Renders the `<input>` element with its attributes.
     *
     * @return string Rendered HTML for the `<input>` element.
     */
    protected function run(): string
    {
        return $this->buildElement();
    }

    /**
     * Generates the name of the input element, adding `[]` if the `multiple` attribute is set.
     *
     * @return string The generated name.
     */
    private function generateNameWithMultiple(): string
    {
        /** @phpstan-var string $name */
        $name = $this->getAttribute('name', '');
        $isMultiple = $this->getAttribute('multiple', false);

        if ($isMultiple === false) {
            return $name;
        }

        return Naming::generateArrayableName($name);
    }
}
