<?php

declare(strict_types=1);

namespace UIAwesome\Html;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Core\Html as CoreHtml;
use UIAwesome\Html\Embedded\Img;
use UIAwesome\Html\Flow\{Div, Hr, Main, P};
use UIAwesome\Html\Form\{Button, Form, Option, Select, TextArea};
use UIAwesome\Html\Form\Values\SelectTag;
use UIAwesome\Html\Heading\{H1, H2, H3, H4, H5, H6};
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Interop\{Block, Inline, Lists, MetadataBlock, MetadataVoid, Root, Table as TableTag, Voids};
use UIAwesome\Html\List\{Li, Ol, Ul};
use UIAwesome\Html\Palpable\A;
use UIAwesome\Html\Phrasing\{Em, I, Label, Span, Strong};
use UIAwesome\Html\Root\{Footer, Header};
use UIAwesome\Html\Sectioning\{Article, Nav, Section};
use UIAwesome\Html\Table\{Table, Td, Th, Tr};

use function implode;

/**
 * Provides curated static factory methods for the most commonly used HTML elements.
 *
 * Every factory returns a fluent element instance; {@see Html::el()} renders a one-off element string instead.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Html::div()
 *     ->class('container')
 *     ->content('value')
 *     ->render();
 * echo \UIAwesome\Html\Html::el('span', ['class' => 'badge'], 'value');
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements
 * {@see CoreHtml} for the low-level tag renderers.
 */
final class Html
{
    /**
     * Tag enumerations scanned, in order, when resolving a tag name.
     */
    private const array TAG_ENUMS = [
        Block::class,
        Inline::class,
        Lists::class,
        MetadataBlock::class,
        MetadataVoid::class,
        Root::class,
        SelectTag::class,
        TableTag::class,
        Voids::class,
    ];

    /**
     * Returns a new {@see A} instance for the HTML `<a>` element.
     *
     * @return A New `<a>` element instance.
     */
    public static function a(): A
    {
        return A::tag();
    }

    /**
     * Returns a new {@see Article} instance for the HTML `<article>` element.
     *
     * @return Article New `<article>` element instance.
     */
    public static function article(): Article
    {
        return Article::tag();
    }

    /**
     * Returns a new {@see Button} instance for the HTML `<button>` element.
     *
     * @return Button New `<button>` element instance.
     */
    public static function button(): Button
    {
        return Button::tag();
    }

    /**
     * Returns a new {@see Div} instance for the HTML `<div>` element.
     *
     * @return Div New `<div>` element instance.
     */
    public static function div(): Div
    {
        return Div::tag();
    }

    /**
     * Returns a rendered HTML element string for a one-off tag.
     *
     * Resolves the tag kind from the library tag enumerations and dispatches to the matching renderer: void tags render
     * without content, inline tags render without surrounding line breaks, and every other tag renders as a block.
     *
     * Content is encoded with {@see \UIAwesome\Html\Helper\Encode::content()} and attribute values with
     * {@see \UIAwesome\Html\Helper\Encode::value()}, so untrusted input never reaches the output unescaped.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Html::el('span', ['class' => 'badge'], 'value');
     * // <span class="badge">value</span>
     * echo \UIAwesome\Html\Html::el('img', ['src' => 'image.png']);
     * // <img src="image.png">
     * ```
     *
     * @param string $tag Tag name to render.
     * @param array $attributes Associative array of HTML attributes.
     * @param string|Stringable $content Content to be rendered inside the tag. Ignored for void tags.
     *
     * @throws InvalidArgumentException If the tag name is not a known HTML tag.
     *
     * @return string Rendered HTML element string.
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function el(string $tag, array $attributes = [], string|Stringable $content = ''): string
    {
        $case = self::resolveTag($tag);

        if ($case instanceof Voids || $case instanceof MetadataVoid) {
            return CoreHtml::void($case, $attributes);
        }

        $value = (string) $content;

        if ($case instanceof Inline) {
            return CoreHtml::inline($case, $value, $attributes, true);
        }

        return CoreHtml::element($case, $value, $attributes, true);
    }

    /**
     * Returns a new {@see Em} instance for the HTML `<em>` element.
     *
     * @return Em New `<em>` element instance.
     */
    public static function em(): Em
    {
        return Em::tag();
    }

    /**
     * Returns a new {@see Footer} instance for the HTML `<footer>` element.
     *
     * @return Footer New `<footer>` element instance.
     */
    public static function footer(): Footer
    {
        return Footer::tag();
    }

    /**
     * Returns a new {@see Form} instance for the HTML `<form>` element.
     *
     * @return Form New `<form>` element instance.
     */
    public static function form(): Form
    {
        return Form::tag();
    }

    /**
     * Returns a new {@see H1} instance for the HTML `<h1>` element.
     *
     * @return H1 New `<h1>` element instance.
     */
    public static function h1(): H1
    {
        return H1::tag();
    }

    /**
     * Returns a new {@see H2} instance for the HTML `<h2>` element.
     *
     * @return H2 New `<h2>` element instance.
     */
    public static function h2(): H2
    {
        return H2::tag();
    }

    /**
     * Returns a new {@see H3} instance for the HTML `<h3>` element.
     *
     * @return H3 New `<h3>` element instance.
     */
    public static function h3(): H3
    {
        return H3::tag();
    }

    /**
     * Returns a new {@see H4} instance for the HTML `<h4>` element.
     *
     * @return H4 New `<h4>` element instance.
     */
    public static function h4(): H4
    {
        return H4::tag();
    }

    /**
     * Returns a new {@see H5} instance for the HTML `<h5>` element.
     *
     * @return H5 New `<h5>` element instance.
     */
    public static function h5(): H5
    {
        return H5::tag();
    }

    /**
     * Returns a new {@see H6} instance for the HTML `<h6>` element.
     *
     * @return H6 New `<h6>` element instance.
     */
    public static function h6(): H6
    {
        return H6::tag();
    }

    /**
     * Returns a new {@see Header} instance for the HTML `<header>` element.
     *
     * @return Header New `<header>` element instance.
     */
    public static function header(): Header
    {
        return Header::tag();
    }

    /**
     * Returns a new {@see Hr} instance for the HTML `<hr>` element.
     *
     * @return Hr New `<hr>` element instance.
     */
    public static function hr(): Hr
    {
        return Hr::tag();
    }

    /**
     * Returns a new {@see I} instance for the HTML `<i>` element.
     *
     * @return I New `<i>` element instance.
     */
    public static function i(): I
    {
        return I::tag();
    }

    /**
     * Returns a new {@see Img} instance for the HTML `<img>` element.
     *
     * @return Img New `<img>` element instance.
     */
    public static function img(): Img
    {
        return Img::tag();
    }

    /**
     * Returns a new {@see Label} instance for the HTML `<label>` element.
     *
     * @return Label New `<label>` element instance.
     */
    public static function label(): Label
    {
        return Label::tag();
    }

    /**
     * Returns a new {@see Li} instance for the HTML `<li>` element.
     *
     * @return Li New `<li>` element instance.
     */
    public static function li(): Li
    {
        return Li::tag();
    }

    /**
     * Returns a new {@see Main} instance for the HTML `<main>` element.
     *
     * @return Main New `<main>` element instance.
     */
    public static function main(): Main
    {
        return Main::tag();
    }

    /**
     * Returns a new {@see Nav} instance for the HTML `<nav>` element.
     *
     * @return Nav New `<nav>` element instance.
     */
    public static function nav(): Nav
    {
        return Nav::tag();
    }

    /**
     * Returns a new {@see Ol} instance for the HTML `<ol>` element.
     *
     * @return Ol New `<ol>` element instance.
     */
    public static function ol(): Ol
    {
        return Ol::tag();
    }

    /**
     * Returns a new {@see Option} instance for the HTML `<option>` element.
     *
     * @return Option New `<option>` element instance.
     */
    public static function option(): Option
    {
        return Option::tag();
    }

    /**
     * Returns a new {@see P} instance for the HTML `<p>` element.
     *
     * @return P New `<p>` element instance.
     */
    public static function p(): P
    {
        return P::tag();
    }

    /**
     * Returns a new {@see Section} instance for the HTML `<section>` element.
     *
     * @return Section New `<section>` element instance.
     */
    public static function section(): Section
    {
        return Section::tag();
    }

    /**
     * Returns a new {@see Select} instance for the HTML `<select>` element.
     *
     * @return Select New `<select>` element instance.
     */
    public static function select(): Select
    {
        return Select::tag();
    }

    /**
     * Returns a new {@see Span} instance for the HTML `<span>` element.
     *
     * @return Span New `<span>` element instance.
     */
    public static function span(): Span
    {
        return Span::tag();
    }

    /**
     * Returns a new {@see Strong} instance for the HTML `<strong>` element.
     *
     * @return Strong New `<strong>` element instance.
     */
    public static function strong(): Strong
    {
        return Strong::tag();
    }

    /**
     * Returns a new {@see Table} instance for the HTML `<table>` element.
     *
     * @return Table New `<table>` element instance.
     */
    public static function table(): Table
    {
        return Table::tag();
    }

    /**
     * Returns a new {@see Td} instance for the HTML `<td>` element.
     *
     * @return Td New `<td>` element instance.
     */
    public static function td(): Td
    {
        return Td::tag();
    }

    /**
     * Returns a new {@see TextArea} instance for the HTML `<textarea>` element.
     *
     * @return TextArea New `<textarea>` element instance.
     */
    public static function textarea(): TextArea
    {
        return TextArea::tag();
    }

    /**
     * Returns a new {@see Th} instance for the HTML `<th>` element.
     *
     * @return Th New `<th>` element instance.
     */
    public static function th(): Th
    {
        return Th::tag();
    }

    /**
     * Returns a new {@see Tr} instance for the HTML `<tr>` element.
     *
     * @return Tr New `<tr>` element instance.
     */
    public static function tr(): Tr
    {
        return Tr::tag();
    }

    /**
     * Returns a new {@see Ul} instance for the HTML `<ul>` element.
     *
     * @return Ul New `<ul>` element instance.
     */
    public static function ul(): Ul
    {
        return Ul::tag();
    }

    /**
     * Returns the tag enumeration case matching the given tag name.
     *
     * @param string $tag Tag name to resolve.
     *
     * @throws InvalidArgumentException If the tag name is not a known HTML tag.
     *
     * @return BackedEnum Tag enumeration case for the tag name.
     */
    private static function resolveTag(string $tag): BackedEnum
    {
        foreach (self::TAG_ENUMS as $enum) {
            $case = $enum::tryFrom($tag);

            if ($case !== null) {
                return $case;
            }
        }

        throw new InvalidArgumentException(
            Message::VALUE_NOT_IN_LIST->getMessage($tag, 'tag', implode("', '", self::tagNames())),
        );
    }

    /**
     * Returns every tag name the library can render.
     *
     * @return string[] Tag names collected from the supported tag enumerations.
     *
     * @phpstan-return list<string>
     */
    private static function tagNames(): array
    {
        $names = [];

        foreach (self::TAG_ENUMS as $enum) {
            foreach ($enum::cases() as $case) {
                $names[] = $case->value;
            }
        }

        return $names;
    }
}
