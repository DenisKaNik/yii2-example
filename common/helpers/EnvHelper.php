<?php

if (!function_exists('env')) {

    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null) {
        /**
         * Закомментировал, т.к. значения true|false|null имеют тип string в $_ENV[$key], а в коде ожидается именно boolean тип.
         * Для справки, на PROD-сервере YII_DEBUG=false, а debug-панель всё равно выводится. Не выводится всем она лишь из-за блокировки по IP.
         * Для всех остальных IP выкидывается exception и записывается в (frontend|backend|common)/runtime/logs/app.log, что приводит к большому размеру log-файла.
         */
//        if(array_key_exists($key, $_ENV)) {
//            return $_ENV[$key];
//        }

        /**
         * Все настройки из .env файла добавляются также и в $_SERVER https://github.com/vlucas/phpdotenv/blob/master/src/Loader.php#L386.
         * Лично я считаю, лишним добавление значений в $_SERVER, к тому же этот массив попадает в отчёты.
         * Чтобы не переопределять методы пакеты, можно открыть функцию ниже и значения удалятся из $_SERVER. Сама функция в конце файла.
         */
        //unsetEnvSession();
        
        $value = getenv($key);
        if ($value === false)
            return value($default);
        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'null':
            case '(null)':
                return null;
            case 'empty':
            case '(empty)':
                return '';
        }
        if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
            return substr($value, 1, -1);
        }
        return $value;
    }

}


if (!function_exists('value')) {

    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value) {
        return $value instanceof Closure ? $value() : $value;
    }

}
if (!function_exists('str_ends_with')) {

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function str_ends_with($haystack, $needles) {
        foreach ((array) $needles as $needle) {
            if ((string) $needle === substr($haystack, -strlen($needle)))
                return true;
        }
        return false;
    }

}
if (!function_exists('str_starts_with')) {

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function str_starts_with($haystack, $needles) {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && strpos($haystack, $needle) === 0)
                return true;
        }
        return false;
    }

}
if (!function_exists('array_get')) {

    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function array_get($array, $key, $default = null) {
        if (is_null($key))
            return $array;
        if (isset($array[$key]))
            return $array[$key];
        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return value($default);
            }
            $array = $array[$segment];
        }
        return $array;
    }

}

/**
 * Удаляем ключи $_ENV из $_SERVER
 */
function unsetEnvSession()
{
    if (isset($_ENV)) {
        foreach ($_ENV as $k => $v) {
            if (isset($_SERVER[$k])) {
                unset($_SERVER[$k]);
            }
        }
    }
}