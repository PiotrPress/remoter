# Remoter

This library is a chainable HTTP Client based on [file_get_contents()](https://www.php.net/manual/en/function.file-get-contents.php) function.

## Installation

```shell
$ composer require piotrpress/remoter
```

## Example

```php
require __DIR__ . '/vendor/autoload.php';

use PiotrPress\Remoter\Request;
use PiotrPress\Remoter\Url;
use PiotrPress\Remoter\Header;

echo ( ( new Request(
    ( new Url(
        'https://api.github.com'
    ) )->setPath( '/repos/PiotrPress/remoter' ),
    'GET',
    ( new Header(
        [ 'User-Agent' => 'PiotrPress/Remoter' ],
        true
    ) )->set( 'Accept', 'application/vnd.github.v3+json' )
) )->send() )->getHeader()->get( 'code' );
```

## Requirements

PHP >= `7.4` version.

## License

[MIT](license.txt)