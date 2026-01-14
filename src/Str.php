<?php

namespace Bayfront\StringHelpers;

use const STR_PAD_LEFT;

class Str
{

    /**
     * Returns string, ensuring that it starts with a given string.
     *
     * @param string $string
     * @param string $start_with
     * @return string
     */
    public static function startWith(string $string, string $start_with = ''): string
    {
        if (!str_starts_with($string, $start_with)) {
            return $start_with . $string;
        }

        return $string;
    }

    /**
     * Returns string, ensuring that it ends with a given string.
     *
     * @param string $string
     * @param string $end_with
     * @return string
     */
    public static function endWith(string $string, string $end_with = ''): string
    {
        if (!str_ends_with($string, $end_with)) {
            return $string . $end_with;
        }

        return $string;
    }

    /**
     * Converts string to lowercase using a specified character encoding.
     *
     * See: https://www.php.net/manual/en/mbstring.supported-encodings.php
     *
     * @param string $string
     * @param string $encoding
     * @return string
     */
    public static function lowercase(string $string, string $encoding = 'UTF-8'): string
    {
        return mb_convert_case($string, MB_CASE_LOWER, $encoding);
    }

    /**
     * Converts string to uppercase using a specified character encoding.
     *
     * See: https://www.php.net/manual/en/mbstring.supported-encodings.php
     *
     * @param string $string
     * @param string $encoding
     * @return string
     */
    public static function uppercase(string $string, string $encoding = 'UTF-8'): string
    {
        return mb_convert_case($string, MB_CASE_UPPER, $encoding);
    }

    /**
     * Converts string to title case using a specified character encoding.
     *
     * @param string $string
     * @param string $encoding
     * @return string
     */
    public static function titleCase(string $string, string $encoding = 'UTF-8'): string
    {
        return mb_convert_case($string, MB_CASE_TITLE, $encoding);
    }

    /**
     * Converts string to camel case, removing any non-alpha and non-numeric characters.
     *
     * @param string $string
     * @return string
     */
    public static function camelCase(string $string): string
    {

        // Non-alpha and non-numeric characters become spaces

        $string = preg_replace("/[^a-z0-9]+/i", " ", $string);

        $string = ucwords(strtolower(trim($string)));

        return lcfirst(str_replace(" ", "", $string));

    }

    /**
     * Converts string to kebab case (URL-friendly slug), replacing any non-alpha
     * and non-numeric characters with a hyphen.
     *
     * @param string $string
     * @param bool $lowercase (Convert string to lowercase)
     * @return string
     */
    public static function kebabCase(string $string, bool $lowercase = false): string
    {

        // Replace non letter or digit with hyphen (-)
        $string = preg_replace('/[^a-z0-9]+/i', '-', $string);

        // Transliterate
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);

        // Trim
        $string = trim($string, '-');

        // Remove duplicate -
        $string = preg_replace('/-+/', '-', $string);

        if (true === $lowercase) {
            return self::lowercase($string);
        }

        return $string;

    }

    /**
     * Converts string to snake case, replacing any non-alpha
     * and non-numeric characters with an underscore.
     *
     * @param string $string
     * @param bool $lowercase (Convert string to lowercase)
     * @return string
     */
    public static function snakeCase(string $string, bool $lowercase = true): string
    {

        // Replace non letter or digit with underscore (_)
        $string = preg_replace('/[^a-z0-9]+/i', '_', $string);

        // Transliterate
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);

        // Trim
        $string = trim($string, '_');

        // Remove duplicate _
        $string = preg_replace('/_+/', '_', $string);

        if (true === $lowercase) {
            return self::lowercase($string);
        }

        return $string;

    }

    private static array $alpha_lower = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    ];

    private static array $alpha_upper = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
    ];

    private static array $number = [
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
    ];

    /*
     * Omit backticks and quotation marks for safely inserting into a database
     */
    private static array $symbol = [
        "-", "=", "/", "\\", "[", "]", ";", ",", ".", "~", "!", "@", "#", "$", "%",
        "^", "&", "*", "(", ")", "_", "+", "{", "}", "|", ":", "?", "<", ">"
    ];

    public const RANDOM_TYPE_NONZERO = 'nonzero';
    public const RANDOM_TYPE_NUMERIC = 'numeric';
    public const RANDOM_TYPE_ALPHA = 'alpha';
    public const RANDOM_TYPE_ALPHA_LOWER = 'alpha_lower';
    public const RANDOM_TYPE_ALPHA_UPPER = 'alpha_upper';
    public const RANDOM_TYPE_ALPHANUMERIC = 'alphanumeric';
    public const RANDOM_TYPE_ALPHANUMERIC_LOWER = 'alphanumeric_lower';
    public const RANDOM_TYPE_ALPHANUMERIC_UPPER = 'alphanumeric_upper';
    public const RANDOM_TYPE_ALL = 'all';

    /**
     * Return a random string of specified length and type.
     *
     * Note: Returned string is not cryptographically secure.
     *
     * @param int $length
     * @param string $type (Any RANDOM_TYPE_* constant)
     * @return string
     */
    public static function random(int $length = 8, string $type = self::RANDOM_TYPE_ALL): string
    {

        /*
         * Numeric types can use random_int
         */

        if ($type === self::RANDOM_TYPE_NUMERIC) {
            $result = '';
            for ($i = 0; $i < $length; $i++) {
                $result .= random_int(0, 9);
            }
            return $result;
        } else if ($type === self::RANDOM_TYPE_NONZERO) {
            $result = '';
            for ($i = 0; $i < $length; $i++) {
                $result .= random_int(1, 9);
            }
            return $result;
        }

        $chars = match ($type) {
            self::RANDOM_TYPE_ALPHA => array_merge(self::$alpha_lower, self::$alpha_upper),
            self::RANDOM_TYPE_ALPHA_LOWER => self::$alpha_lower,
            self::RANDOM_TYPE_ALPHA_UPPER => self::$alpha_upper,
            self::RANDOM_TYPE_ALPHANUMERIC => array_merge(self::$alpha_lower, self::$alpha_upper, self::$number),
            self::RANDOM_TYPE_ALPHANUMERIC_LOWER => array_merge(self::$alpha_lower, self::$number),
            self::RANDOM_TYPE_ALPHANUMERIC_UPPER => array_merge(self::$alpha_upper, self::$number),
            default => array_merge(self::$alpha_lower, self::$alpha_upper, self::$number, self::$symbol), // All
        };

        shuffle($chars);

        $return = [];

        while (count($return) < $length) {
            $k = array_rand($chars);
            $return[] = $chars[$k];
        }

        return implode('', $return);

    }

    /**
     * Return a cryptographically secure unique identifier (UID) comprised of lowercase letters and numbers.
     *
     * @param int $length
     * @return string
     */
    public static function uid(int $length = 8): string
    {
        return substr(bin2hex(random_bytes((int)ceil($length / 2))), 0, $length);
    }

    /**
     * Return a UUID v4 string.
     *
     * @return string
     */
    public static function uuid4(): string
    {

        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // Set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));

    }

    /**
     * Return a lexicographically sortable UUID v7 string.
     *
     * @return string
     */
    public static function uuid7(): string
    {

        static $last_timestamp = 0;

        $unixts_ms = intval(microtime(true) * 1000);

        if ($last_timestamp >= $unixts_ms) {
            $unixts_ms = $last_timestamp + 1;
        }

        $last_timestamp = $unixts_ms;
        $data = random_bytes(10);
        $data[0] = chr((ord($data[0]) & 0x0f) | 0x70); // Set version
        $data[2] = chr((ord($data[2]) & 0x3f) | 0x80); // Set variant

        return vsprintf(
            '%s%s-%s-%s-%s-%s%s%s',
            str_split(
                str_pad(dechex($unixts_ms), 12, '0', STR_PAD_LEFT) .
                bin2hex($data),
                4
            )
        );

    }

    /**
     * Is string a valid UUID?
     *
     * @param string $uuid
     * @return bool
     */
    public static function isValidUuid(string $uuid): bool
    {
        return preg_match(
        '/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
        $uuid) === 1;
    }

    /**
     * Convert 16 byte binary string to UUID.
     *
     * @param string $binary
     * @return string
     */
    public static function binToUuid(string $binary): string
    {

        $hex = bin2hex($binary);

        return sprintf(
            '%s-%s-%s-%s-%s',
            substr($hex, 0, 8),
            substr($hex, 8, 4),
            substr($hex, 12, 4),
            substr($hex, 16, 4),
            substr($hex, 20, 12)
        );

    }

    /**
     * Convert UUID to 16 byte binary string.
     *
     * @param string $uuid
     * @return string
     */
    public static function uuidToBin(string $uuid): string
    {
        return hex2bin(str_replace('-', '', $uuid));
    }

    /**
     * Verify input string has a specified complexity.
     *
     * @param string $string
     * @param int $min_length
     * @param int $max_length (0 for no max)
     * @param int $lowercase (Minimum number of lowercase characters)
     * @param int $uppercase (Minimum number of uppercase characters)
     * @param int $digits (Minimum number of digits)
     * @param int $special_chars (Minimum number of non-alphabetic and non-numeric characters)
     * @return bool
     */
    public static function hasComplexity(string $string, int $min_length, int $max_length, int $lowercase, int $uppercase, int $digits, int $special_chars): bool
    {

        if (strlen($string) < $min_length) {
            return false;
        }

        if ($max_length > 0 && strlen($string) > $max_length) {
            return false;
        }

        if ($lowercase > 0 && preg_match_all('/[a-z]/', $string) < $lowercase) {
            return false;
        }

        if ($uppercase > 0 && preg_match_all('/[A-Z]/', $string) < $uppercase) {
            return false;
        }

        if ($digits > 0 && preg_match_all('/[0-9]/', $string) < $digits) {
            return false;
        }

        if ($special_chars > 0 && preg_match_all('/[^A-Za-z0-9]/', $string) < $special_chars) {
            return false;
        }

        return true;

    }

    /*
     * |--------------------------------------------------------------------------
     * | Depreciated
     * |--------------------------------------------------------------------------
     */

    /**
     * Checks if string contains a case-sensitive needle.
     *
     * This method has been depreciated in favor of PHP native function str_contains.
     *
     * @param string $string
     * @param string $needle
     * @return bool
     * @deprecated
     */
    public static function has(string $string, string $needle): bool
    {
        return str_contains($string, $needle);
    }

    /**
     * Checks if string contains any whitespace.
     *
     * This method has been depreciated in favor of PHP native function str_contains.
     *
     * @param string $string
     * @return bool
     * @deprecated
     */
    public static function hasSpace(string $string): bool
    {
        return str_contains($string, ' ');
    }

    /**
     * Checks if a string starts with a given case-sensitive string.
     *
     * This method has been depreciated in favor of PHP native function str_starts_with.
     *
     * @param string $string
     * @param string $starts_with
     * @return bool
     * @deprecated
     */
    public static function startsWith(string $string, string $starts_with = ''): bool
    {
        return (str_starts_with($string, $starts_with));
    }

    /**
     * Checks if a string ends with a given case-sensitive string.
     *
     * This method has been depreciated in favor of PHP native function str_ends_with.
     *
     * @param string $string
     * @param string $ends_with
     * @return bool
     * @deprecated
     */
    public static function endsWith(string $string, string $ends_with = ''): bool
    {
        $length = strlen($ends_with);
        return $length === 0 || (substr($string, -$length) === $ends_with);
    }

    /**
     * Return a UUID v4 string.
     *
     * This method has been depreciated in favor of Str::uuid4 and Str::uuid7.
     *
     * @return string
     * @deprecated
     */
    public static function uuid(): string
    {
        return self::uuid4();
    }

}