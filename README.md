# Nacosvel Rooster Server Implementation for Laravel.

[![GitHub Tag](https://img.shields.io/github/v/tag/jundayw/laravel-rooster-server)](https://github.com/jundayw/laravel-rooster-server/tags)
[![Total Downloads](https://img.shields.io/packagist/dt/nacosvel/laravel-rooster-server?style=flat-square)](https://packagist.org/packages/nacosvel/laravel-rooster-server)
[![Packagist Version](https://img.shields.io/packagist/v/nacosvel/laravel-rooster-server)](https://packagist.org/packages/nacosvel/laravel-rooster-server)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/nacosvel/laravel-rooster-server)](https://github.com/jundayw/laravel-rooster-server)
[![Packagist License](https://img.shields.io/github/license/jundayw/laravel-rooster-server)](https://github.com/jundayw/laravel-rooster-server)

## Installation

You can install the package via [Composer](https://getcomposer.org/):

```bash
composer require nacosvel/laravel-rooster-server
```

### Publish Command

You can publish configuration file using the `vendor:publish` command:

```shell
php artisan vendor:publish --tag=rooster-server-config
```

You can publish migrations file using the `vendor:publish` command:

```shell
php artisan vendor:publish --tag=rooster-server-migrations
```

or

```shell
php artisan vendor:publish --provider="Nacosvel\RoosterServer\RoosterServerServiceProvider"
```

## License

Nacosvel Rooster Server is made available under the MIT License (MIT). Please see [License File](LICENSE) for more
information.
