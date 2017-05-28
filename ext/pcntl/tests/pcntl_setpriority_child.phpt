--TEST--
pcntl_setpriority() for child
--SKIPIF--
<?php

if (!function_exists('pcntl_setpriority')
    || !function_exists('pcntl_getpriority')
    || !function_exists('pcntl_fork')
    || !function_exists('posix_getuid')
    || !function_exists('posix_kill')
) {
    die('skip required functionality is not available');
}

if (posix_getuid() !== 0) die ("skip root required");

?>
--FILE--
<?php
// min and max priorities vary by platform, but -2 to 2 should be safe
$pid = pcntl_fork();
if ($pid < 0) die("failed");

var_dump(pcntl_setpriority(-2, $pid));
var_dump(pcntl_getpriority($pid));
var_dump(pcntl_setpriority(2, $pid));
var_dump(pcntl_getpriority($pid));

posix_kill($pid, SIGTERM);
?>
--EXPECT--
bool(true)
int(-2)
bool(true)
int(2)
