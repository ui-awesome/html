<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedInteger;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, InputMode, Type};
use UIAwesome\Html\Form\InputPassword;
use UIAwesome\Html\Tests\Provider\Form\InputPasswordProvider;

/**
 * Unit tests for {@see InputPassword} rendering and password input attribute behavior.
 *
 * {@see InputPasswordProvider} for test case data providers.
 */
#[Group('form')]
final class InputPasswordTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputPassword::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::PASSWORD,
                'class' => 'value',
            ],
            InputPassword::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    #[TestWith(['off'], 'string')]
    #[TestWith([Autocomplete::OFF], 'enum')]
    public function testRenderWithAutocomplete(string|Autocomplete $value): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" autocomplete="off">
            HTML,
            InputPassword::tag()
                ->autocomplete($value)
                ->id('inputpassword')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" autofocus>
            HTML,
            InputPassword::tag()
                ->autofocus(true)
                ->id('inputpassword')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputpassword" type="password">
            HTML,
            InputPassword::tag(['class' => 'default-class'])
                ->id('inputpassword')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    #[TestWith(['numeric'], 'string')]
    #[TestWith([InputMode::NUMERIC], 'enum')]
    public function testRenderWithInputMode(string|InputMode $value): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" inputmode="numeric">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->inputMode($value)
                ->render(),
            "'inputmode' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" maxlength="12">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->maxlength(12)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" minlength="8">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->minlength(8)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" pattern=".{8,}">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->pattern('.{8,}')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" placeholder="value">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" readonly>
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" required>
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    #[TestWith([20, 20], 'int')]
    #[TestWith([BackedInteger::VALUE, 1], 'enum')]
    public function testRenderWithSize(int|BackedInteger $value, int $expected): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" size="{$expected}">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->size($value)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" tabindex="1">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="password">
            HTML,
            (string) InputPassword::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" value="value">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    /**
     * @param Closure(): InputPassword $setter
     */
    #[DataProviderExternal(InputPasswordProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
