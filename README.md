<!-- markdownlint-disable MD041 -->
<p align="center">
    <picture>
        <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/ui-awesome/.github/refs/heads/main/logo/ui_awesome_dark.png">
        <source media="(prefers-color-scheme: light)" srcset="https://raw.githubusercontent.com/ui-awesome/.github/refs/heads/main/logo/ui_awesome_light.png">
        <img src="https://raw.githubusercontent.com/ui-awesome/.github/refs/heads/main/logo/ui_awesome_dark.png" alt="UI Awesome" width="150px">
    </picture>
    <h1 align="center">Html</h1>
    <br>
</p>
<!-- markdownlint-enable MD041 -->

<p align="center">
    <a href="https://github.com/ui-awesome/html/actions/workflows/build.yml" target="_blank">
        <img src="https://img.shields.io/github/actions/workflow/status/ui-awesome/html/build.yml?style=for-the-badge&label=PHPUnit&logo=github" alt="PHPUnit">
    </a>
    <a href="https://dashboard.stryker-mutator.io/reports/github.com/ui-awesome/html/main" target="_blank">
        <img src="https://img.shields.io/endpoint?style=for-the-badge&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fui-awesome%2Fhtml%2Fmain" alt="Mutation Testing">
    </a>
    <a href="https://github.com/ui-awesome/html/actions/workflows/static.yml" target="_blank">
        <img src="https://img.shields.io/github/actions/workflow/status/ui-awesome/html/static.yml?style=for-the-badge&label=PHPStan&logo=github" alt="PHPStan">
    </a>
</p>

<p align="center">
    <strong>A fluent, immutable PHP library for generating HTML elements with typed attribute helpers.</strong><br>
    <em>Safe by default content encoding, raw HTML when needed, and standards-compliant rendering.</em>
</p>

## Features

<picture>
    <source media="(min-width: 768px)" srcset="./docs/svgs/features.svg">
    <img src="./docs/svgs/features-mobile.svg" alt="Feature Overview" style="width: 100%;">
</picture>

### Installation

```bash
composer require ui-awesome/html:^0.4
```

### Quick start

This package provides immutable, fluent wrapper classes for common HTML elements.

It supports safe content encoding via `content()`, raw HTML via `html()`, and composition using element instances.

#### Document skeleton + composition + immutability

```php
use UIAwesome\Html\Flow\{Div, Main, P};
use UIAwesome\Html\Heading\H1;
use UIAwesome\Html\Metadata\{Link, Meta, Title};
use UIAwesome\Html\Palpable\A;
use UIAwesome\Html\Root\{Body, Head, Html};

$baseLink = A::tag()->class('nav-link');

echo Html::tag()
    ->lang('en')
    ->html(
        Head::tag()->html(
            Meta::tag()->charset('utf-8'),
            Meta::tag()->name('viewport')->content('width=device-width, initial-scale=1'),
            Title::tag()->content('UI Awesome HTML'),
            Link::tag()->rel('stylesheet')->href('/assets/app.css'),
        ),
        Body::tag()->class('app')->html(
            Main::tag()->class('container')->html(
                H1::tag()->content('UI Awesome HTML'),
                P::tag()->content('Build HTML with a fluent, immutable API.'),
                Div::tag()->class('nav')->html(
                    $baseLink->href('/docs')->content('Documentation'),
                    $baseLink->href('/github')->content('GitHub'),
                ),
            ),
        ),
    )
    ->render();
```

#### Safe content vs raw HTML

```php
use UIAwesome\Html\Flow\Div;

echo Div::tag()->content('<strong>encoded</strong>')->render();
// <div>&lt;strong&gt;encoded&lt;/strong&gt;</div>

echo Div::tag()->html('<strong>raw</strong>')->render();
// <div>
// <strong>raw</strong>
// </div>
```

#### Powerful list composition

Create ordered lists, unordered lists, and description lists with a fluent API.

```php
use UIAwesome\Html\List\{Dl, Ol, Ul};

// Unordered list with items
$features = Ul::tag()
    ->class('feature-list')
    ->items(
        'Immutable by design',
        'Type-safe attributes',
        'Fluent API',
        'Standards-compliant',
    );

// Ordered list with custom start and nested items
$steps = Ol::tag()
    ->class('steps')
    ->start(1)
    ->reversed(false)
    ->li('Install with Composer', 1)
    ->li('Create HTML elements', 2)
    ->li('Render to string', 3);

// Description list for metadata or glossaries
$metadata = Dl::tag()
    ->class('metadata-list')
    ->dt('Package')
    ->dd('ui-awesome/html')
    ->dt('Version')
    ->dd('0.4.0')
    ->dt('License')
    ->dd('BSD-3-Clause');

// Render all lists
$html = $features->render() . PHP_EOL . $steps->render() . PHP_EOL . $metadata->render();
```

## Documentation

For detailed configuration options and advanced usage.

- [Testing Guide](docs/testing.md)
- [Development Guide](docs/development.md)

## Package information

[![PHP](https://img.shields.io/badge/%3E%3D8.1-777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/releases/8.1/en.php)
[![Latest Stable Version](https://img.shields.io/packagist/v/ui-awesome/html.svg?style=for-the-badge&logo=packagist&logoColor=white&label=Stable)](https://packagist.org/packages/ui-awesome/html)
[![Total Downloads](https://img.shields.io/packagist/dt/ui-awesome/html.svg?style=for-the-badge&logo=composer&logoColor=white&label=Downloads)](https://packagist.org/packages/ui-awesome/html)

## Quality code

[![Codecov](https://img.shields.io/codecov/c/github/ui-awesome/html.svg?style=for-the-badge&logo=codecov&logoColor=white&label=Coverage)](https://codecov.io/github/ui-awesome/html)
[![PHPStan Level Max](https://img.shields.io/badge/PHPStan-Level%20Max-4F5D95.svg?style=for-the-badge&logo=github&logoColor=white)](https://github.com/ui-awesome/html/actions/workflows/static.yml)
[![Super-Linter](https://img.shields.io/github/actions/workflow/status/ui-awesome/html/linter.yml?style=for-the-badge&label=Super-Linter&logo=github)](https://github.com/ui-awesome/html/actions/workflows/linter.yml)
[![StyleCI](https://img.shields.io/badge/StyleCI-Passed-44CC11.svg?style=for-the-badge&logo=github&logoColor=white)](https://github.styleci.io/repos/776094320?branch=main)

## Our social networks

[![Follow on X](https://img.shields.io/badge/-Follow%20on%20X-1DA1F2.svg?style=for-the-badge&logo=x&logoColor=white&labelColor=000000)](https://x.com/Terabytesoftw)

## License

[![License](https://img.shields.io/badge/License-BSD--3--Clause-brightgreen.svg?style=for-the-badge&logo=opensourceinitiative&logoColor=white&labelColor=555555)](LICENSE)
