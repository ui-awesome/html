<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input;

/**
 * ButtonGroup renders a button group widget.
 *
 * For example,
 *
 * ```php
 * <?=
 *     ButtonGroup::create()
 *         ->buttons(
 *             Button::widget()->labelContent('Submit')->type('submit'),
 *             Button::widget()->labelContent('Reset')->type('reset')
 *         );
 * ?>
 * ```
 *
 * Pressing on the button should be handled via JavaScript. See the following for details:
 */
final class ButtonGroup extends Base\AbstractButtonGroup {}
