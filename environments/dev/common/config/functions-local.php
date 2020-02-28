<?php

/**
 * Debug function
 * d($var);
 */
function d($var, $caller=null)
{
    if (!isset($caller)) {
        $caller = array_shift(debug_backtrace(1));
    }
    echo '<code>File: ',$caller['file'],' / Line: ',$caller['line'],'</code>';
    echo '<pre>';
    yii\helpers\VarDumper::dump($var, 10, true);
    echo '</pre>';
}

/**
 * Debug function with debug_backtrace and die() after
 * ddt($var);
 */
function ddt($var)
{
    $caller = array_shift(debug_backtrace(1));
    d($var, $caller);
    die();
}

/**
 * Debug function simple with die() after
 * dd($var);
 */
function dd($var)
{
    die('<pre>'.print_r($var, true).'</pre>');
}

/**
 * Debug function with die() for console
 * ddc($var);
 */
function ddc($var)
{
    $str = PHP_EOL.PHP_EOL;
    $str .= '======================'.PHP_EOL;
    $str .= '====   VarDumper   ==='.PHP_EOL;
    $str .= '======================'.PHP_EOL.PHP_EOL;

    die($str . print_r($var, true));
}
