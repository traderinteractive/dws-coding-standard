# DWS Coding Standard
[![Build Status](https://travis-ci.org/dominionenterprises/dws-coding-standard.png)](https://travis-ci.org/dominionenterprises/dws-coding-standard)
[![Code Coverage](http://img.shields.io/coveralls/dominionenterprises/dws-coding-standard.svg?style=flat)](https://coveralls.io/r/dominionenterprises/dws-coding-standard)

A fairly complete [PHP_CodeSniffer](http://www.squizlabs.com/php-codesniffer) coding standard.  See the [standard document](standard.md) to
see what "sniffs" are enforced.

## Composer

This standard is meant to be used in a project using [Composer](http://getcomposer.org).  It can be added to your project's composer.json as follows:

```json
{
    "require-dev": {
        "dominionenterprises/dws-coding-standard": "~1.0"
    }
}
```

Then to use it, you can run the following (or add to your build process):

```bash
./vendor/bin/phpcs --standard=$(pwd)/vendor/dominionenterprises/dws-coding-standard/DWS YOUR_FILES_AND_DIRECTORIES
```

## Contact

Developers may be contacted at:

 * [Pull Requests](https://github.com/dominionenterprises/dws-coding-standard/pulls)
 * [Issues](https://github.com/dominionenterprises/dws-coding-standard/issues)

## Tests

Tests for the sniffs are included, and are run using the included build:

```bash
./build.php
```
