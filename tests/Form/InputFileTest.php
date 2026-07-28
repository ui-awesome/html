<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{GlobalAttribute, Type};
use UIAwesome\Html\Form\InputFile;
use UIAwesome\Html\Form\Values\Capture;

/**
 * Unit tests for {@see InputFile} rendering and file selection attribute behavior.
 *
 * Global attribute, ARIA, data, event, and content behavior is covered once for the shared `BaseInput`
 * render path by {@see \UIAwesome\Html\Tests\Form\InputMonthTest}.
 */
#[Group('form')]
final class InputFileTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputFile::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::FILE,
                'class' => 'value',
                'name' => '',
            ],
            InputFile::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccept(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" accept="image/*">
            HTML,
            InputFile::tag()
                ->accept('image/*')
                ->id('inputfile')
                ->render(),
            "'accept' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" autofocus>
            HTML,
            InputFile::tag()
                ->autofocus(true)
                ->id('inputfile')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    #[TestWith(['user', 'user'], 'string')]
    #[TestWith([Capture::ENVIRONMENT, 'environment'], 'enum')]
    public function testRenderWithCapture(string|Capture $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" capture="{$expected}">
            HTML,
            InputFile::tag()
                ->capture($value)
                ->id('inputfile')
                ->render(),
            "'capture' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputfile" type="file">
            HTML,
            InputFile::tag(['class' => 'default-class'])
                ->id('inputfile')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithMultiple(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" name="value[]" type="file" multiple>
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->multiple(true)
                ->name('value')
                ->render(),
            "'multiple' must be serialized.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" required>
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputfile" type="file" tabindex="1">
            HTML,
            InputFile::tag()
                ->id('inputfile')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="file">
            HTML,
            (string) InputFile::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputFile = InputFile::tag();

        self::assertNotSame(
            $inputFile,
            $inputFile->capture(''),
            'New instance must be returned (immutability).',
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

        InputFile::tag()->tabIndex(-2);
    }
}
