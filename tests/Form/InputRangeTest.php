<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, GlobalAttribute, Type};
use UIAwesome\Html\Form\InputRange;

/**
 * Unit tests for {@see InputRange} rendering and slider range attribute behavior.
 */
#[Group('form')]
final class InputRangeTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputRange::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::RANGE,
                'class' => 'value',
            ],
            InputRange::tag()
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
            <input id="inputrange" type="range" autocomplete="on">
            HTML,
            InputRange::tag()
                ->autocomplete($value)
                ->id('inputrange')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" autofocus>
            HTML,
            InputRange::tag()
                ->autofocus(true)
                ->id('inputrange')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputrange" type="range">
            HTML,
            InputRange::tag(['class' => 'default-class'])
                ->id('inputrange')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" list="value">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" max="100">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->max(100)
                ->render(),
            "'max' must be serialized.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" min="10">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->min(10)
                ->render(),
            "'min' must be serialized.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" min="10" max="100">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->min(10)
                ->max(100)
                ->render(),
            'min and max must be serialized together.',
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" step="2">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->step(2)
                ->render(),
            "'step' must be serialized.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" step="any">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->step('any')
                ->render(),
            'step must accept the literal `any`.',
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" tabindex="1">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="range">
            HTML,
            (string) InputRange::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" value="50">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->value(50)
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

        InputRange::tag()->tabIndex(-2);
    }
}
