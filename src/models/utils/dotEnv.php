<?php
/* 
    Exemplo de uso:
    echo Dotenv::get('DB_HOST');
*/
class Dotenv
{
    protected static $data = [];

    protected static function load()
    {
        $filePath = '.env';
        if (file_exists($filePath)) {
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                list($key, $value) = explode('=', $line, 2);
                self::$data[trim($key)] = trim($value);
            }
        }
    }

    public static function get($key, $default = null)
    {
        if (empty(self::$data)) {
            self::load();
        }

        return self::$data[$key] ?? $default;
    }
}

