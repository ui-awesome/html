<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{GlobalAttribute, Target, Type};
use UIAwesome\Html\Form\InputImage;

/**
 * Unit tests for {@see InputImage} rendering and image submit button behavior.
 */
#[Group('form')]
final class InputImageTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputImage::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::IMAGE,
                'class' => 'value',
            ],
            InputImage::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAlt(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" alt="value">
            HTML,
            InputImage::tag()
                ->alt('value')
                ->id('inputimage')
                ->render(),
            "'alt' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" autofocus>
            HTML,
            InputImage::tag()
                ->autofocus(true)
                ->id('inputimage')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputimage" type="image">
            HTML,
            InputImage::tag(['class' => 'default-class'])
                ->id('inputimage')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formaction="/submit">
            HTML,
            InputImage::tag()
                ->formaction('/submit')
                ->id('inputimage')
                ->render(),
            "'formaction' must be serialized.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formenctype="multipart/form-data">
            HTML,
            InputImage::tag()
                ->formenctype('multipart/form-data')
                ->id('inputimage')
                ->render(),
            "'formenctype' must be serialized.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formmethod="post">
            HTML,
            InputImage::tag()
                ->formmethod('post')
                ->id('inputimage')
                ->render(),
            "'formmethod' must be serialized.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formnovalidate>
            HTML,
            InputImage::tag()
                ->formnovalidate(true)
                ->id('inputimage')
                ->render(),
            "'formnovalidate' must be serialized.",
        );
    }

    #[TestWith(['_blank'], 'string')]
    #[TestWith([Target::BLANK], 'enum')]
    public function testRenderWithFormtarget(string|Target $value): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" formtarget="_blank">
            HTML,
            InputImage::tag()
                ->formtarget($value)
                ->id('inputimage')
                ->render(),
            "'formtarget' must be serialized.",
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" height="100">
            HTML,
            InputImage::tag()
                ->height(100)
                ->id('inputimage')
                ->render(),
            "'height' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" src="value">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" tabindex="1">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="image">
            HTML,
            (string) InputImage::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputimage" type="image" width="100">
            HTML,
            InputImage::tag()
                ->id('inputimage')
                ->width(100)->render(),
            "'width' must be serialized.",
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

        InputImage::tag()->tabIndex(-2);
    }
}
