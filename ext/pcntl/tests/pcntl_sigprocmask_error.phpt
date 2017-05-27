--TEST--
pcnt_sigprocmask() errors
--SKIPIF--
<?php

if (!extension_loaded('pcntl')) die('skip pcntl extension not available');
if (!function_exists('pcntl_sigprocmask')) die('skip required functionality is not available');

?>
--FILE--
<?php

pcntl_sigprocmask();

// if $how is invalid, sigprocmask() returns non-zero
var_dump(pcntl_sigprocmask(PHP_INT_MAX, []));

?>
--EXPECTF--

Warning: pcntl_sigprocmask() expects at least 2 parameters, 0 given in %s on line %d

Warning: pcntl_sigprocmask(): Invalid argument in %s on line %d
bool(false)
