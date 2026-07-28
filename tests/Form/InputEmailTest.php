<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedInteger;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, Type};
use UIAwesome\Html\Form\InputEmail;
use UIAwesome\Html\Tests\Provider\Form\InputEmailProvider;

/**
 * Unit tests for {@see InputEmail} rendering and email input attribute behavior.
 */
#[Group('form')]
final class InputEmailTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputEmail::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::EMAIL,
                'class' => 'value',
            ],
            InputEmail::tag()
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
            <input id="inputemail" type="email" autocomplete="on">
            HTML,
            InputEmail::tag()
                ->autocomplete($value)
                ->id('inputemail')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" autofocus>
            HTML,
            InputEmail::tag()
                ->autofocus(true)
                ->id('inputemail')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputemail" type="email">
            HTML,
            InputEmail::tag(['class' => 'default-class'])
                ->id('inputemail')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" list="value">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" maxlength="255">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->maxlength(255)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" minlength="5">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->minlength(5)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithMultiple(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" multiple>
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->multiple(true)
                ->render(),
            "'multiple' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" pattern=".+@example\.com">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->pattern('.+@example\\.com')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" placeholder="value">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" readonly>
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" required>
            HTML,
            InputEmail::tag()
                ->id('inputemail')
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
            <input id="inputemail" type="email" size="{$expected}">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->size($value)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" spellcheck="true">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" tabindex="1">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="email">
            HTML,
            (string) InputEmail::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" value="hello@example.com">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->value('hello@example.com')
                ->render(),
            "'value' must be serialized.",
        );
    }

    /**
     * @phpstan-param Closure(): InputEmail $setter
     */
    #[DataProviderExternal(InputEmailProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
