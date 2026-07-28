<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{GlobalAttribute, Target, Type};
use UIAwesome\Html\Form\InputSubmit;

/**
 * Unit tests for {@see InputSubmit} rendering and form submission attribute behavior.
 */
#[Group('form')]
final class InputSubmitTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputSubmit::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::SUBMIT,
                'class' => 'value',
            ],
            InputSubmit::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" autofocus>
            HTML,
            InputSubmit::tag()
                ->autofocus(true)
                ->id('inputsubmit')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag(['class' => 'value'])
                ->id('inputsubmit')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formaction="/submit-handler">
            HTML,
            InputSubmit::tag()
                ->formaction('/submit-handler')
                ->id('inputsubmit')
                ->render(),
            "'formaction' must be serialized.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formenctype="multipart/form-data">
            HTML,
            InputSubmit::tag()
                ->formenctype('multipart/form-data')
                ->id('inputsubmit')
                ->render(),
            "'formenctype' must be serialized.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formmethod="post">
            HTML,
            InputSubmit::tag()
                ->formmethod('post')
                ->id('inputsubmit')
                ->render(),
            "'formmethod' must be serialized.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formnovalidate>
            HTML,
            InputSubmit::tag()
                ->formnovalidate(true)
                ->id('inputsubmit')
                ->render(),
            "'formnovalidate' must be serialized.",
        );
    }

    public function testRenderWithFormnovalidateValueFalse(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->formnovalidate(false)
                ->id('inputsubmit')
                ->render(),
            'formnovalidate must be omitted when `false`.',
        );
    }

    public function testRenderWithFormnovalidateValueNull(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->formnovalidate(null)
                ->id('inputsubmit')
                ->render(),
            'formnovalidate must be omitted when `null`.',
        );
    }

    #[TestWith(['_blank'], 'string')]
    #[TestWith([Target::BLANK], 'enum')]
    public function testRenderWithFormtarget(string|Target $value): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formtarget="_blank">
            HTML,
            InputSubmit::tag()
                ->formtarget($value)
                ->id('inputsubmit')
                ->render(),
            "'formtarget' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" tabindex="1">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="submit">
            HTML,
            (string) InputSubmit::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" value="value">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTabindex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-2',
                GlobalAttribute::TABINDEX->value,
                'value >= -1',
            ),
        );

        InputSubmit::tag()->tabIndex(-2);
    }
}
