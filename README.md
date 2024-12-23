## PHP string helpers

PHP helper class to provide useful string functions.

- [License](#license)
- [Author](#author)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

<img src="https://cdn1.onbayfront.com/bfm/brand/bfm-logo.svg" alt="Bayfront Media" width="250" />

- [Bayfront Media homepage](https://www.bayfrontmedia.com?utm_source=github&amp;utm_medium=direct)
- [Bayfront Media GitHub](https://github.com/bayfrontmedia)

## Requirements

* PHP `^8.0` (Tested up to `8.4`)

## Installation

```
composer require bayfrontmedia/php-string-helpers
```

## Usage

- [startWith](#startwith)
- [endWith](#endwith)
- [lowercase](#lowercase)
- [uppercase](#uppercase)
- [titleCase](#titlecase)
- [camelCase](#camelcase)
- [kebabCase](#kebabcase)
- [snakeCase](#snakecase)
- [random](#random)
- [uid](#uid)
- [uuid4](#uuid4)
- [uuid7](#uuid7)
- [hasComplexity](#hascomplexity)

Depreciated:

- [has](#has)
- [hasSpace](#hasspace)
- [startsWith](#startswith)
- [endsWith](#endswith)
- [uuid](#uuid)

<hr />

### startWith

**Description:**

Returns string, ensuring that it starts with a given string.

**Parameters:**

- `$string` (string)
- `$start_with` (string)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::startWith($string, 'Hello! ');
```

<hr />

### endWith

**Description:**

Returns string, ensuring that it ends with a given string.

**Parameters:**

- `$string` (string)
- `$end_with` (string)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::endWith($string, ' Goodbye!');
```

<hr />

### lowercase

**Description:**

Converts string to lowercase using a specified character encoding.

See: [https://www.php.net/manual/en/mbstring.supported-encodings.php](https://www.php.net/manual/en/mbstring.supported-encodings.php)

**Parameters:**

- `$string` (string)
- `$encoding = 'UTF-8'` (string)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::lowercase($string);
```

<hr />

### uppercase

**Description:**

Converts string to uppercase using a specified character encoding.

See: [https://www.php.net/manual/en/mbstring.supported-encodings.php](https://www.php.net/manual/en/mbstring.supported-encodings.php)

**Parameters:**

- `$string` (string)
- `$encoding = 'UTF-8'` (string)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::uppercase($string);
```

<hr />

### titleCase

**Description:**

Converts string to title case using a specified character encoding.

See: [https://www.php.net/manual/en/mbstring.supported-encodings.php](https://www.php.net/manual/en/mbstring.supported-encodings.php)

**Parameters:**

- `$string` (string)
- `$encoding = 'UTF-8'` (string)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::titleCase($string);
```

<hr />

### camelCase

**Description:**

Converts string to camel case, removing any non-alpha and non-numeric characters.

**Parameters:**

- `$string` (string)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::camelCase($string);
```

<hr />

### kebabCase

**Description:**

Converts string to kebab case (URL-friendly slug), replacing any non-alpha and non-numeric characters with a hyphen.

**Parameters:**

- `$string` (string)
- `$lowercase = false` (bool): Convert string to lowercase

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::kebabCase($string);
```

<hr />

### snakeCase

**Description:**

Converts string to snake case, replacing any non-alpha and non-numeric characters with an underscore.

**Parameters:**

- `$string` (string)
- `$lowercase = false` (bool): Convert string to lowercase

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::snakeCase($string);
```

<hr />

### random

**Description:**

Return a random string of specified length and type.

**Note: Returned string is not cryptographically secure.**

**Parameters:**

- `$length = 8` (int)
- `$type = self::RANDOM_TYPE_ALL` (string): Any `RANDOM_TYPE_*` constant)

Valid `$type` constants include:

- `RANDOM_TYPE_NONZERO`
- `RANDOM_TYPE_NUMERIC`
- `RANDOM_TYPE_ALPHA`: Alphabetic, upper and lowercase
- `RANDOM_TYPE_ALPHA_LOWER`
- `RANDOM_TYPE_ALPHA_UPPER`
- `RANDOM_TYPE_ALPHANUMERIC`: Alphanumeric, upper and lowercase
- `RANDOM_TYPE_ALPHANUMERIC_LOWER`
- `RANDOM_TYPE_ALPHANUMERIC_UPPER`
- `RANDOM_TYPE_ALL`: Alphanumeric and special characters

Backticks and quotation marks are excluded from special characters for safely inserting into a database.

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

echo Str::random(16, Str::RANDOM_TYPE_ALPHANUMERIC);
```

<hr />

### uid

**Description:**

Return a cryptographically secure unique identifier (UID) comprised of lowercase letters and numbers.

**Parameters:**

- `$length = 8` (int)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

echo Str::uid(16);
```

### uuid4

**Description:**

Return a UUID v4 string.

**Parameters:**

- (None)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

echo Str::uuid4();
```

<hr />

### uuid7

**Description:**

Return a lexicographically sortable UUID v7 string.

**Parameters:**

- (None)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

echo Str::uuid7();
```

<hr />

### hasComplexity

**Description:**

Verify input string has a specified complexity.

**Parameters:**

- `$string` (string)
- `$min_length` (int)
- `$max_length` (int): `0` for no max
- `$lowercase` (int): Minimum number of lowercase characters
- `$uppercase` (int): Minimum number of uppercase characters
- `$digits` (int): Minimum number of digits
- `$special_chars` (int): Minimum number of non-alphabetic and non-numeric characters

**Returns:**

- (bool)

**Example:**

```php
use Bayfront\StringHelpers\Str;

if (!Str::hasComplexity('abc123', 8, 32, 1, 1, 1, 1)) {
    // Do something
}
```

<hr />

### ~~has~~

**Description:**

Checks if string contains a case-sensitive needle.

This method has been depreciated in favor of PHP native function `str_contains`.

**Parameters:**

- `$string` (string)
- `$needle` (string)

**Returns:**

- (bool)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

if (Str::has($string, 'this')) {

    // Do something

}
```

<hr />

### ~~hasSpace~~

**Description:**

Checks if string contains any whitespace.

This method has been depreciated in favor of PHP native function `str_contains`.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

if (Str::hasSpace($string)) {

    // Do something

}
```

<hr />

### ~~startsWith~~

**Description:**

Checks if a string starts with a given case-sensitive string.

This method has been depreciated in favor of PHP native function `str_starts_with`.

**Parameters:**

- `$string` (string)
- `$starts_with` (string)

**Returns:**

- (bool)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

if (Str::startsWith($string, 'this')) {

    // Do something

}
```

<hr />

### ~~endsWith~~

**Description:**

Checks if a string ends with a given case-sensitive string.

This method has been depreciated in favor of PHP native function `str_ends_with`.

**Parameters:**

- `$string` (string)
- `$ends_with` (string)

**Returns:**

- (bool)

**Example:**

```php
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

if (Str::endsWith($string, 'string.')) {

    // Do something

}
```

<hr />

### ~~uuid~~

**Description:**

Return a UUID v4 string.

This method has been depreciated in favor of [Str::uuid4](#uuid4) and [Str::uuid7](#uuid7).

**Parameters:**

- (None)

**Returns:**

- (string)

**Example:**

```php
use Bayfront\StringHelpers\Str;

echo Str::uuid();
```