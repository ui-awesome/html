<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{PopoverTargetAction, Target};
use UIAwesome\Html\Form\Button;
use UIAwesome\Html\Form\Values\{ButtonCommand, ButtonType};
use UIAwesome\Html\Tests\Provider\Form\ButtonProvider;

/**
 * Unit tests for {@see Button} inline form behavior.
 */
#[Group('form')]
final class ButtonTest extends TestCase
{
    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <button autofocus></button>
            HTML,
            Button::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    #[TestWith(['show-modal'], 'string')]
    #[TestWith([ButtonCommand::SHOW_MODAL], 'enum')]
    public function testRenderWithCommand(string|ButtonCommand $value): void
    {
        self::assertSame(
            <<<HTML
            <button command="show-modal"></button>
            HTML,
            Button::tag()
                ->command($value)
                ->render(),
            "'command' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <button>&lt;value&gt;</button>
            HTML,
            Button::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <button class="default-class"></button>
            HTML,
            Button::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <button disabled></button>
            HTML,
            Button::tag()
                ->disabled(true)
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <button form="value"></button>
            HTML,
            Button::tag()
                ->form('value')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <button formaction="/submit-handler"></button>
            HTML,
            Button::tag()
                ->formaction('/submit-handler')
                ->render(),
            "'formaction' must be serialized.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <button formenctype="multipart/form-data"></button>
            HTML,
            Button::tag()
                ->formenctype('multipart/form-data')
                ->render(),
            "'formenctype' must be serialized.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <button formmethod="post"></button>
            HTML,
            Button::tag()
                ->formmethod('post')
                ->render(),
            "'formmethod' must be serialized.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <button formnovalidate></button>
            HTML,
            Button::tag()
                ->formnovalidate(true)
                ->render(),
            "'formnovalidate' must be serialized.",
        );
    }

    public function testRenderWithFormnovalidateValueFalse(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()
                ->formnovalidate(false)
                ->render(),
            'formnovalidate must be omitted when `false`.',
        );
    }

    public function testRenderWithFormnovalidateValueNull(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            Button::tag()
                ->formnovalidate(null)
                ->render(),
            'formnovalidate must be omitted when `null`.',
        );
    }

    #[TestWith(['_blank'], 'string')]
    #[TestWith([Target::BLANK], 'enum')]
    public function testRenderWithFormtarget(string|Target $value): void
    {
        self::assertSame(
            <<<HTML
            <button formtarget="_blank"></button>
            HTML,
            Button::tag()
                ->formtarget($value)
                ->render(),
            "'formtarget' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <button name="value"></button>
            HTML,
            Button::tag()
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithPopoverTarget(): void
    {
        self::assertSame(
            <<<HTML
            <button popovertarget="my-popover"></button>
            HTML,
            Button::tag()
                ->popoverTarget('my-popover')
                ->render(),
            "'popovertarget' must be serialized.",
        );
    }

    #[DataProviderExternal(ButtonProvider::class, 'popoverTargetAction')]
    public function testRenderWithPopoverTargetAction(string|PopoverTargetAction $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <button popovertargetaction="{$expected}"></button>
            HTML,
            Button::tag()
                ->popoverTargetAction($value)
                ->render(),
            "'popovertargetaction' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <button tabindex="1"></button>
            HTML,
            Button::tag()
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <button></button>
            HTML,
            (string) Button::tag(),
            'Casting to string must produce HTML.',
        );
    }

    #[DataProviderExternal(ButtonProvider::class, 'type')]
    public function testRenderWithType(string|ButtonType $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <button type="{$expected}"></button>
            HTML,
            Button::tag()
                ->type($value)
                ->render(),
            "'type' must be serialized.",
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <button value="value"></button>
            HTML,
            Button::tag()
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    /**
     * @param Closure(): Button $setter
     */
    #[DataProviderExternal(ButtonProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
