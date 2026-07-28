<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedInteger;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocapitalize, Autocomplete, Autocorrect};
use UIAwesome\Html\Form\TextArea;
use UIAwesome\Html\Form\Values\Wrap;
use UIAwesome\Html\Tests\Provider\Form\TextAreaProvider;

/**
 * Unit tests for {@see TextArea} rendering and text input attribute behavior.
 *
 * {@see TextAreaProvider} for test case data providers.
 */
#[Group('form')]
final class TextAreaTest extends TestCase
{
    #[DataProviderExternal(TextAreaProvider::class, 'autocapitalize')]
    public function testRenderWithAutocapitalize(string|Autocapitalize $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <textarea autocapitalize="{$expected}">
            </textarea>
            HTML,
            TextArea::tag()
                ->autocapitalize($value)
                ->render(),
            "'autocapitalize' must be serialized.",
        );
    }

    #[TestWith(['on'], 'string')]
    #[TestWith([Autocomplete::ON], 'enum')]
    public function testRenderWithAutocomplete(string|Autocomplete $value): void
    {
        self::assertSame(
            <<<HTML
            <textarea autocomplete="on">
            </textarea>
            HTML,
            TextArea::tag()
                ->autocomplete($value)
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    #[DataProviderExternal(TextAreaProvider::class, 'autocorrect')]
    public function testRenderWithAutocorrect(string|Autocorrect $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <textarea autocorrect="{$expected}">
            </textarea>
            HTML,
            TextArea::tag()
                ->autocorrect($value)
                ->render(),
            "'autocorrect' must be serialized.",
        );
    }

    public function testRenderWithCols(): void
    {
        self::assertSame(
            <<<HTML
            <textarea cols="20">
            </textarea>
            HTML,
            TextArea::tag()
                ->cols(20)
                ->render(),
            "'cols' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <textarea>
            value
            </textarea>
            HTML,
            TextArea::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <textarea class="default-class">
            </textarea>
            HTML,
            TextArea::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <textarea dirname="comment.dir">
            </textarea>
            HTML,
            TextArea::tag()
                ->dirname('comment.dir')
                ->render(),
            "'dirname' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <textarea disabled>
            </textarea>
            HTML,
            TextArea::tag()
                ->disabled(true)
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <textarea form="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->form('value')
                ->render(),
            "'form' must be serialized.",
        );
    }

    #[TestWith([100, 100], 'int')]
    #[TestWith([BackedInteger::VALUE, 1], 'enum')]
    public function testRenderWithMaxlength(int|BackedInteger $value, int $expected): void
    {
        self::assertSame(
            <<<HTML
            <textarea maxlength="{$expected}">
            </textarea>
            HTML,
            TextArea::tag()
                ->maxlength($value)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <textarea minlength="10">
            </textarea>
            HTML,
            TextArea::tag()
                ->minlength(10)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <textarea name="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <textarea placeholder="value">
            </textarea>
            HTML,
            TextArea::tag()
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <textarea readonly>
            </textarea>
            HTML,
            TextArea::tag()
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <textarea required>
            </textarea>
            HTML,
            TextArea::tag()
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRows(): void
    {
        self::assertSame(
            <<<HTML
            <textarea rows="5">
            </textarea>
            HTML,
            TextArea::tag()
                ->rows(5)
                ->render(),
            "'rows' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <textarea>
            </textarea>
            HTML,
            (string) TextArea::tag(),
            'Casting to string must produce HTML.',
        );
    }

    #[DataProviderExternal(TextAreaProvider::class, 'wrap')]
    public function testRenderWithWrap(string|Wrap $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <textarea wrap="{$expected}">
            </textarea>
            HTML,
            TextArea::tag()
                ->wrap($value)
                ->render(),
            "'wrap' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $textArea = TextArea::tag();

        self::assertNotSame(
            $textArea,
            $textArea->cols(1),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $textArea,
            $textArea->rows(1),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $textArea,
            $textArea->wrap(''),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @phpstan-param Closure(): TextArea $setter
     */
    #[DataProviderExternal(TextAreaProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
