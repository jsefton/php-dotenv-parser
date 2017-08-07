## PHP DotEnv Parser

This easy tool allows you to pass a `.env` file and be returned a parsed array.

You can then add or edit values from this array.

This parser also allows you to pass an array and store as a valid `.env` file to be used.


### Installation

You will need composer to install this package (get composer). Then run:

```bash
composer require jsefton/php-dotenv-parser
```


### Usage

To parse a `.env` file to an array pass in the path like below:

```php
$env = Parser::envToArray('/path/to/.env');
```

To store an array into a `.env` file pass the array along with the path to store it:

```php
Parser::arrayToEnv($array, '/path/to/.env');
```
