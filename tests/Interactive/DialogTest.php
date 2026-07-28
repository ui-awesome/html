<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Interactive;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\Button;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Interactive\Dialog;
use UIAwesome\Html\Interactive\Values\Closedby;
use UIAwesome\Html\Tests\Provider\Interactive\DialogProvider;

use function implode;

/**
 * Unit tests for {@see Dialog} rendering and dialog attribute behavior.
 *
 * {@see DialogProvider} for test case data providers.
 */
#[Group('interactive')]
final class DialogTest extends TestCase
{
    public function testRenderWithCloseButton(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            <form method="dialog">
            <button>Close</button>
            </form>
            </dialog>
            HTML,
            Dialog::tag()
                ->closeButton('Close')
                ->render(),
            'Close button must be rendered.',
        );
    }

    public function testRenderWithCloseButtonPrependsContent(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            <form method="dialog">
            <button>Close</button>
            </form>
            value
            </dialog>
            HTML,
            Dialog::tag()
                ->content('value')
                ->closeButton(Button::tag()->content('Close'))
                ->render(),
            'Close button content must be prepended.',
        );
    }

    public function testRenderWithCloseButtonUsingInvokerCommandWhenDialogHasId(): void
    {
        self::assertSame(
            <<<HTML
            <dialog id="my-dialog">
            <button command="close" commandfor="my-dialog">Close</button>
            </dialog>
            HTML,
            Dialog::tag()
                ->id('my-dialog')
                ->closeButton('Close')
                ->render(),
            'Close button must emit invoker command when dialog has id.',
        );
    }

    #[DataProviderExternal(DialogProvider::class, 'closedby')]
    public function testRenderWithClosedby(string|Closedby $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <dialog closedby="{$expected}">
            </dialog>
            HTML,
            Dialog::tag()
                ->closedby($value)
                ->render(),
            "'closedby' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            value
            </dialog>
            HTML,
            Dialog::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <dialog class="default-class">
            </dialog>
            HTML,
            Dialog::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithOpen(): void
    {
        self::assertSame(
            <<<HTML
            <dialog open>
            </dialog>
            HTML,
            Dialog::tag()
                ->open(true)
                ->render(),
            "'open' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            </dialog>
            HTML,
            (string) Dialog::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $dialog = Dialog::tag();

        self::assertNotSame(
            $dialog,
            $dialog->closeButton('Close'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $dialog,
            $dialog->closedby(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $dialog,
            $dialog->open(null),
            'New instance must be returned (immutability).',
        );
    }

    public function testReturnSameInstanceWhenCloseButtonIsNull(): void
    {
        $dialog = Dialog::tag();

        self::assertSame(
            $dialog,
            $dialog->closeButton(null),
            'Same instance must be returned for `null` (no-op setter).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingClosedby(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'closedby',
                implode("', '", Enum::normalizeStringArray(Closedby::cases())),
            ),
        );

        Dialog::tag()->closedby('invalid-value');
    }
}
