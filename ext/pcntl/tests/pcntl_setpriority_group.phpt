--TEST--
pcntl_setpriority() for process group
--SKIPIF--
<?php

if (!function_exists('pcntl_setpriority')
    || !function_exists('pcntl_getpriority')
    || !function_exists('pcntl_fork')
    || !function_exists('posix_getuid')
    || !function_exists('posix_kill')
    || !function_exists('posix_getpgid')
) {
    die('skip required functionality is not available');
}

if (posix_getuid() !== 0) die ("skip root required");

?>
--FILE--
<?php
// min and max priorities vary by platform, but -2 to 2 should be safe
$priority = pcntl_getpriority();

$pid = pcntl_fork();
if ($pid < 0) die("failed");
$pgid = posix_getpgid($pid);

var_dump(pcntl_setpriority(-2, $pgid, PRIO_PGRP));
var_dump(pcntl_getpriority($pid));
var_dump(pcntl_getpriority());
var_dump(pcntl_getpriority() !== $priority);

// reset everything
posix_kill($pid, SIGTERM);
pcntl_setpriority($priority, $pgid, PRIO_PGRP);
var_dump(pcntl_getpriority() === $priority);
?>
--EXPECT--
bool(true)
int(-2)
int(-2)
bool(true)
bool(true)
