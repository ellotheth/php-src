--TEST--
pcntl_setpriority() for self
--SKIPIF--
<?php

if (!function_exists('pcntl_setpriority')
    || !function_exists('pcntl_getpriority')
    || !function_exists('posix_getuid')
) {
    die('skip required functionality is not available');
}

if (posix_getuid() !== 0) die ("skip root required");

?>
--FILE--
<?php
// min and max priorities vary by platform, but -2 to 2 should be safe

$priority = pcntl_getpriority();
var_dump(pcntl_setpriority(-2));
var_dump(pcntl_getpriority());
var_dump(pcntl_setpriority(2));
var_dump(pcntl_getpriority());

pcntl_setpriority($priority);
var_dump(pcntl_getpriority() === $priority);
?>
--EXPECT--
bool(true)
int(-2)
bool(true)
int(2)
bool(true)
