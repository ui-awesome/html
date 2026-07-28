<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, Type};
use UIAwesome\Html\Form\InputColor;
use UIAwesome\Html\Form\Values\Colorspace;
use UIAwesome\Html\Tests\Provider\Form\InputColorProvider;

/**
 * Unit tests for {@see InputColor} rendering and color input attribute behavior.
 */
#[Group('form')]
final class InputColorTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputColor::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::COLOR,
                'class' => 'value',
            ],
            InputColor::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAlpha(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" alpha>
            HTML,
            InputColor::tag()
                ->alpha(true)->id('inputcolor')
                ->render(),
            "'alpha' must be serialized.",
        );
    }

    #[TestWith(['on'], 'string')]
    #[TestWith([Autocomplete::ON], 'enum')]
    public function testRenderWithAutocomplete(string|Autocomplete $value): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" autocomplete="on">
            HTML,
            InputColor::tag()
                ->autocomplete($value)
                ->id('inputcolor')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" autofocus>
            HTML,
            InputColor::tag()
                ->autofocus(true)
                ->id('inputcolor')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    #[TestWith(['display-p3'], 'string')]
    #[TestWith([Colorspace::DISPLAY_P3], 'enum')]
    public function testRenderWithColorspace(string|Colorspace $value): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" colorspace="display-p3">
            HTML,
            InputColor::tag()
                ->colorspace($value)
                ->id('inputcolor')
                ->render(),
            "'colorspace' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcolor" type="color">
            HTML,
            InputColor::tag(['class' => 'default-class'])
                ->id('inputcolor')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" list="value">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" tabindex="1">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="color">
            HTML,
            (string) InputColor::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" value="#ff0000">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->value('#ff0000')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputColor = InputColor::tag();

        self::assertNotSame(
            $inputColor,
            $inputColor->alpha(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $inputColor,
            $inputColor->colorspace(''),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @phpstan-param Closure(): InputColor $setter
     */
    #[DataProviderExternal(InputColorProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
