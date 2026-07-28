<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\List;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\List\{Dd, Dl, Dt};

/**
 * Unit tests for {@see Dl} rendering and description list composition behavior.
 */
#[Group('list')]
final class DlTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            value
            </dl>
            HTML,
            Dl::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDd(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dd>
            First description
            </dd>
            <dd>
            Second description
            </dd>
            </dl>
            HTML,
            Dl::tag()
                ->dd('First description')
                ->dd('Second description')
                ->render(),
            'Dd entries must be appended.',
        );
    }

    public function testRenderWithDdInstance(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dd class="highlight">
            Description
            </dd>
            </dl>
            HTML,
            Dl::tag()
                ->dd(Dd::tag()->class('highlight')->content('Description'))
                ->render(),
            'Dd must accept a Dd instance.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <dl class="default-class">
            </dl>
            HTML,
            Dl::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDt(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dt>
            First term
            </dt>
            <dt>
            Second term
            </dt>
            </dl>
            HTML,
            Dl::tag()
                ->dt('First term')
                ->dt('Second term')
                ->render(),
            'Dt entries must be appended.',
        );
    }

    public function testRenderWithDtAndDd(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dt>
            Term
            </dt>
            <dd>
            Description
            </dd>
            </dl>
            HTML,
            Dl::tag()
                ->dt('Term')
                ->dd('Description')
                ->render(),
            'Dt/Dd pairs must be appended.',
        );
    }

    public function testRenderWithDtInstance(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dt class="bold">
            Term
            </dt>
            </dl>
            HTML,
            Dl::tag()
                ->dt(Dt::tag()->class('bold')->content('Term'))
                ->render(),
            'Dt must accept a Dt instance.',
        );
    }

    public function testRenderWithTerms(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dt>
            Term 1
            </dt>
            <dd>
            Description 1
            </dd>
            <dt>
            Term 2
            </dt>
            <dd>
            Description 2
            </dd>
            </dl>
            HTML,
            Dl::tag()
                ->terms(
                    [
                        'Term 1',
                        'Description 1',
                    ],
                    [
                        'Term 2',
                        'Description 2',
                    ],
                )
                ->render(),
            'Terms collection must be applied.',
        );
    }

    public function testRenderWithTermsUsingInstances(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dt class="bold">
            Term
            </dt>
            <dd class="highlight">
            Description
            </dd>
            </dl>
            HTML,
            Dl::tag()
                ->terms(
                    [
                        Dt::tag()->class('bold')->content('Term'),
                        Dd::tag()->class('highlight')->content('Description'),
                    ],
                )
                ->render(),
            'Terms must accept term instances.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            </dl>
            HTML,
            (string) Dl::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $dl = Dl::tag();

        self::assertNotSame(
            $dl,
            $dl->dt(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $dl,
            $dl->dd(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $dl,
            $dl->terms(['Term', 'Description']),
            'New instance must be returned (immutability).',
        );
    }
}
