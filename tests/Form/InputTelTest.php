<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedInteger;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, Type};
use UIAwesome\Html\Form\InputTel;
use UIAwesome\Html\Tests\Provider\Form\InputTelProvider;

/**
 * Unit tests for {@see InputTel} rendering and telephone input attribute behavior.
 *
 * {@see InputTelProvider} for test case data providers.
 */
#[Group('form')]
final class InputTelTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputTel::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::TEL,
                'class' => 'value',
            ],
            InputTel::tag()
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
            <input id="inputtel" type="tel" autocomplete="on">
            HTML,
            InputTel::tag()
                ->autocomplete($value)
                ->id('inputtel')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" autofocus>
            HTML,
            InputTel::tag()
                ->autofocus(true)
                ->id('inputtel')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtel" type="tel">
            HTML,
            InputTel::tag(['class' => 'default-class'])
                ->id('inputtel')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" list="value">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" maxlength="10">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->maxlength(10)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" minlength="5">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->minlength(5)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" pattern='[0-9]{3}-[0-9]{3}-[0-9]{4}'>
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->pattern('[0-9]{3}-[0-9]{3}-[0-9]{4}')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" placeholder="value">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" readonly>
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" required>
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    #[TestWith([30, 30], 'int')]
    #[TestWith([BackedInteger::VALUE, 1], 'enum')]
    public function testRenderWithSize(int|BackedInteger $value, int $expected): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" size="{$expected}">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->size($value)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" spellcheck="true">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" tabindex="1">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="tel">
            HTML,
            (string) InputTel::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" value="value">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    /**
     * @param Closure(): InputTel $setter
     */
    #[DataProviderExternal(InputTelProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
