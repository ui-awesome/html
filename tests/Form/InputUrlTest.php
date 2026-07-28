<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedInteger;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, Type};
use UIAwesome\Html\Form\InputUrl;
use UIAwesome\Html\Tests\Provider\Form\InputUrlProvider;

/**
 * Unit tests for {@see InputUrl} rendering and URL input attribute behavior.
 *
 * {@see InputUrlProvider} for test case data providers.
 */
#[Group('form')]
final class InputUrlTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputUrl::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::URL,
                'class' => 'value',
            ],
            InputUrl::tag()
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
            <input id="inputurl" type="url" autocomplete="on">
            HTML,
            InputUrl::tag()
                ->autocomplete($value)
                ->id('inputurl')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" autofocus>
            HTML,
            InputUrl::tag()
                ->autofocus(true)
                ->id('inputurl')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputurl" type="url">
            HTML,
            InputUrl::tag(['class' => 'default-class'])
                ->id('inputurl')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" list="value">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" maxlength="10">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->maxlength(10)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" minlength="5">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->minlength(5)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" pattern="https://.*">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->pattern('https://.*')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" placeholder="value">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" readonly>
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" required>
            HTML,
            InputUrl::tag()
                ->id('inputurl')
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
            <input id="inputurl" type="url" size="{$expected}">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->size($value)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" spellcheck="true">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" tabindex="1">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="url">
            HTML,
            (string) InputUrl::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl" type="url" value="value">
            HTML,
            InputUrl::tag()
                ->id('inputurl')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    /**
     * @phpstan-param Closure(): InputUrl $setter
     */
    #[DataProviderExternal(InputUrlProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
