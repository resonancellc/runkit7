--TEST--
runkit_method_redefine() & runkit_method_add() for methods returning a value by reference
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
ini_set('error_reporting', E_ALL & (~E_DEPRECATED) & (~E_STRICT) & (~E_NOTICE));

class RunkitClass {
	var $a = 0;

	function f() {
		return $this->a;
	}
}
$code = 'return $this->a;';
$o = new RunkitClass;

$b = &$o->f();
$b = 1;
var_dump($o->a);

runkit_method_redefine('RunkitClass', 'f', '', $code);
$c = &$o->f();
$c = 2;
var_dump($o->a);

runkit_method_redefine('RunkitClass', 'f', '', $code, RUNKIT_ACC_RETURN_REFERENCE);
$r = &$o->f();
$r = 3;
var_dump($o->a);

runkit_method_redefine('RunkitClass', 'f', '', $code, 0);
$d = &$o->f();
$d = 4;
var_dump($o->a);

runkit_method_remove('RunkitClass', 'f');
runkit_method_add('RunkitClass', 'f', '', $code);
$d = &$o->f();
$d = 5;
var_dump($o->a);

runkit_method_remove('RunkitClass', 'f');
runkit_method_add('RunkitClass', 'f', '', $code, RUNKIT_ACC_RETURN_REFERENCE);
$d = &$o->f();
$d = 6;
var_dump($o->a);
?>
--EXPECT--
int(0)
int(0)
int(3)
int(3)
int(3)
int(6)
