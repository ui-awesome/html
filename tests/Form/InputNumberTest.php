<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, GlobalAttribute, Type};
use UIAwesome\Html\Form\InputNumber;

/**
 * Unit tests for {@see InputNumber} rendering and numeric range attribute behavior.
 */
#[Group('form')]
final class InputNumberTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputNumber::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::NUMBER,
                'class' => 'value',
            ],
            InputNumber::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    #[TestWith(['on'], 'string')]
    #[TestWith([Autocomplete::ON], 'enum')]
    public function testRenderWithAutocomplete(string|Autocomplete $value): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" autocomplete="on">
            HTML,
            InputNumber::tag()
                ->autocomplete($value)
                ->id('inputnumber')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" autofocus>
            HTML,
            InputNumber::tag()
                ->autofocus(true)
                ->id('inputnumber')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputnumber" type="number">
            HTML,
            InputNumber::tag(['class' => 'default-class'])
                ->id('inputnumber')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" list="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" max="100">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->max(100)
                ->render(),
            "'max' must be serialized.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" min="10">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->min(10)
                ->render(),
            "'min' must be serialized.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" min="10" max="100">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->min(10)
                ->max(100)
                ->render(),
            'min and max must be serialized together.',
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" placeholder="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" readonly>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" required>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" step="2">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->step(2)
                ->render(),
            "'step' must be serialized.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" step="any">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->step('any')
                ->render(),
            'step must accept the literal `any`.',
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" tabindex="1">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="number">
            HTML,
            (string) InputNumber::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" value="10">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->value(10)
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

        InputNumber::tag()->tabIndex(-2);
    }
}
