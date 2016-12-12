# 

[![Software License][ico-license]](LICENSE.md)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/?branch=master)
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Build Status](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/build-status/master)[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status](https://travis-ci.org/Marc-Calafell/todosBackend.svg?branch=master)](https://travis-ci.org/Marc-Calafell/todosBackend)

## Install
Make composer install:
``` bash
$ composer install
```

Make npm install
``` bash
$ npm install
```
Generate a new key
``` bash
$ php artisan key:generate 
```
Rename .env.example to .env
``` bash
$ cp .env.example .env
```

Create database file
``` bash
$ touch database/database.sqlite
```

Migrate databases
``` bash
$ php artisan migrate:refresh --seed 
```

Lluminize todos Backend
``` bash
$ llum boot
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email marccalafell95@gmail.com instead of using the issue tracker.

## Credits

- [marc calafell][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/Marc-Calafell/todosBackend/.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Marc-Calafell/todosBackend//master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/Marc-Calafell/todosBackend/.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Marc-Calafell/todosBackend/.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/Marc-Calafell/todosBackend/.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/Marc-Calafell/todosBackend/
[link-travis]: https://travis-ci.org/Marc-Calafell/todosBackend/
[link-scrutinizer]: https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/build-status/master
[link-code-quality]: https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/
[link-downloads]: https://packagist.org/packages/Marc-Calafell/todosBackend/
[link-author]: https://github.com/Marc-Calafell/todosBackend
[link-contributors]: ../../contributors
