<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedInteger;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, Type};
use UIAwesome\Html\Form\InputSearch;
use UIAwesome\Html\Tests\Provider\Form\InputSearchProvider;

/**
 * Unit tests for {@see InputSearch} rendering and search input attribute behavior.
 *
 * {@see InputSearchProvider} for test case data providers.
 */
#[Group('form')]
final class InputSearchTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputSearch::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::SEARCH,
                'class' => 'value',
            ],
            InputSearch::tag()
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
            <input id="inputsearch" type="search" autocomplete="on">
            HTML,
            InputSearch::tag()
                ->autocomplete($value)
                ->id('inputsearch')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autofocus>
            HTML,
            InputSearch::tag()
                ->autofocus(true)
                ->id('inputsearch')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsearch" type="search">
            HTML,
            InputSearch::tag(['class' => 'default-class'])
                ->id('inputsearch')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dirname="search.dir">
            HTML,
            InputSearch::tag()
                ->dirname('search.dir')
                ->id('inputsearch')
                ->render(),
            "'dirname' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" list="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" maxlength="10">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->maxlength(10)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" minlength="3">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->minlength(3)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" pattern="search.*">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->pattern('search.*')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" placeholder="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" readonly>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" required>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
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
            <input id="inputsearch" type="search" size="{$expected}">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->size($value)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" spellcheck="true">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" tabindex="1">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search">
            HTML,
            (string) InputSearch::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" value="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    /**
     * @phpstan-param Closure(): InputSearch $setter
     */
    #[DataProviderExternal(InputSearchProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
