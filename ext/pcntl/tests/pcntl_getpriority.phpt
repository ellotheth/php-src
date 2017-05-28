--TEST--
pcntl_getpriority()
--SKIPIF--
<?php

if (!extension_loaded("pcntl")) die("skip");
if (!function_exists('pcntl_getpriority')) die('skip required functionality is not available');

?>
--FILE--
<?php
var_dump(pcntl_getpriority());
var_dump(pcntl_getpriority(PHP_INT_MAX));
var_dump(pcntl_getpriority(0, PHP_INT_MAX));
?>
--EXPECTF--
int(%d)

Warning: pcntl_getpriority(): Error %d: No process was located using the given parameters in %s on line %d
bool(false)

Warning: pcntl_getpriority(): Error %d: Invalid identifier flag in %s on line %d
bool(false)
