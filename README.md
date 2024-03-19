<p align="center">
    <a href="https://github.com/ui-awesome/html" target="_blank">
        <img src="https://avatars.githubusercontent.com/u/103309199?s%25253D400%252526u%25253Dca3561c692f53ed7eb290d3bb226a2828741606f%252526v%25253D4" height="100px">
    </a>
    <a href="https://developer.mozilla.org/en-US/docs/Web/HTML" target="_blank">
        <img src="https://raw.githubusercontent.com/ui-awesome/html/main/docs/image/logo.jpg" height="100px">
    </a>    
    <h1 align="center">UI Awesome HTML Code Generator for PHP.</h1>
    <br>
</p>

<p align="center">
    <a href="https://github.com/ui-awesome/html/actions/workflows/build.yml" target="_blank">
        <img src="https://github.com/ui-awesome/html/actions/workflows/build.yml/badge.svg" alt="PHPUnit">
    </a>
    <a href="https://codecov.io/gh/ui-awesome/html" target="_blank">
        <img src="https://codecov.io/gh/ui-awesome/html/branch/main/graph/badge.svg?token=MF0XUGVLYC" alt="Codecov">
    </a>
    <a href="https://dashboard.stryker-mutator.io/reports/github.com/ui-awesome/html/main" target="_blank">
        <img src="https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fui-awesome%2Fhtml%2Fmain" alt="Infection">
    </a>
    <a href="https://github.com/ui-awesome/html/actions/workflows/static.yml" target="_blank">
        <img src="https://github.com/ui-awesome/html/actions/workflows/static.yml/badge.svg" alt="Psalm">
    </a>
    <a href="https://shepherd.dev/github/ui-awesome/html" target="_blank">
        <img src="https://shepherd.dev/github/ui-awesome/html/coverage.svg" alt="Psalm Coverage">
    </a>
    <a href="https://github.styleci.io/repos/767561318?branch=main">
        <img src="https://github.styleci.io/repos/767561318/shield?branch=main" alt="Style ci">
    </a>    
</p>

The **HTML** repository is a powerful tool for generating `HTML` code using `PHP`.

```php
use UIAwesome\Html\{Document\Body, Document\Html, Group\Div, Semantic\Header};

echo Html::widget()
    ->content(
        $this->render('header'),
        Body::widget()
            ->class('content flex flex-col h-[100vh] min-h-[100vh] bg-gray-100 dark:bg-gray-500 theme-loading')
            ->content(
                Header::widget()->content($this->render('component/menu')),
                Div::widget()
                    ->class('flex-grow flex flex-col justify-center')
                    ->content(
                        Div::widget()->class('h-full flex flex-col justify-center')->content($content)
                    ),
                $this->render('footer')
            )
    )
    ->lang('en')
    ->render()
```

## Installation

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```shell
composer require --prefer-dist ui-awesome/html:"^0.1"
```

or add

```json
"ui-awesome/html": "^0.1"
```

## Usage

[Check the documentation docs](/docs/README.md) to learn about usage.

## Testing

[Check the documentation testing](/docs/testing.md) to learn about testing.

## Support versions

[![PHP81](https://img.shields.io/badge/PHP-%3E%3D8.1-787CB5)](https://www.php.net/releases/8.1/en.php)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Our social networks

[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/Terabytesoftw)
