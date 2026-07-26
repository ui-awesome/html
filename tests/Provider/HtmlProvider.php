<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider;

use Closure;
use UIAwesome\Html\Embedded\Img;
use UIAwesome\Html\Flow\{Div, Hr, Main, P};
use UIAwesome\Html\Form\{Button, Form, Option, Select, TextArea};
use UIAwesome\Html\Heading\{H1, H2, H3, H4, H5, H6};
use UIAwesome\Html\Html;
use UIAwesome\Html\List\{Li, Ol, Ul};
use UIAwesome\Html\Palpable\A;
use UIAwesome\Html\Phrasing\{Em, I, Label, Span, Strong};
use UIAwesome\Html\Root\{Footer, Header};
use UIAwesome\Html\Sectioning\{Article, Nav, Section};
use UIAwesome\Html\Table\{Table, Td, Th, Tr};

/**
 * Data provider for {@see \UIAwesome\Html\Tests\HtmlTest} test cases.
 *
 * Provides the complete facade map pairing every static factory method with the element class it must return.
 */
final class HtmlProvider
{
    /**
     * @return array<string, array{Closure(): object, class-string}>
     */
    public static function factory(): array
    {
        return [
            'a' => [Html::a(...), A::class],
            'article' => [Html::article(...), Article::class],
            'button' => [Html::button(...), Button::class],
            'div' => [Html::div(...), Div::class],
            'em' => [Html::em(...), Em::class],
            'footer' => [Html::footer(...), Footer::class],
            'form' => [Html::form(...), Form::class],
            'h1' => [Html::h1(...), H1::class],
            'h2' => [Html::h2(...), H2::class],
            'h3' => [Html::h3(...), H3::class],
            'h4' => [Html::h4(...), H4::class],
            'h5' => [Html::h5(...), H5::class],
            'h6' => [Html::h6(...), H6::class],
            'header' => [Html::header(...), Header::class],
            'hr' => [Html::hr(...), Hr::class],
            'i' => [Html::i(...), I::class],
            'img' => [Html::img(...), Img::class],
            'label' => [Html::label(...), Label::class],
            'li' => [Html::li(...), Li::class],
            'main' => [Html::main(...), Main::class],
            'nav' => [Html::nav(...), Nav::class],
            'ol' => [Html::ol(...), Ol::class],
            'option' => [Html::option(...), Option::class],
            'p' => [Html::p(...), P::class],
            'section' => [Html::section(...), Section::class],
            'select' => [Html::select(...), Select::class],
            'span' => [Html::span(...), Span::class],
            'strong' => [Html::strong(...), Strong::class],
            'table' => [Html::table(...), Table::class],
            'td' => [Html::td(...), Td::class],
            'textarea' => [Html::textarea(...), TextArea::class],
            'th' => [Html::th(...), Th::class],
            'tr' => [Html::tr(...), Tr::class],
            'ul' => [Html::ul(...), Ul::class],
        ];
    }
}
