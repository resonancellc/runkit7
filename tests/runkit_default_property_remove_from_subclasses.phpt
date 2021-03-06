--TEST--
runkit_default_property_remove() remove properties from subclasses
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip";
      if(!function_exists('runkit_default_property_add')) print "skip";
?>
--INI--
error_reporting=E_ALL
display_errors=On
--FILE--
<?php
class RunkitClass {
    public $constArray = array();
    public $publicProperty = 1;
    public $publicproperty = 2;
    private $privateProperty = "a";
    protected $protectedProperty = "b";
}

class RunkitSubClass extends RunkitClass {}
class StdSubClass extends stdClass {}

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$className = 'RunkitClass';
$obj = new RunkitSubClass();
runkit_default_property_add($className, 'dynamic', $obj);

runkit_default_property_remove($className, 'dynamic');
runkit_default_property_remove($className, 'publicproperty');
runkit_default_property_remove($className, 'publicproperty');
runkit_default_property_remove($className, 'privateProperty');
runkit_default_property_remove($className, 'protectedProperty');
runkit_default_property_remove($className, 'constArray');
print_r(new RunkitSubClass());

$obj = new StdSubClass();
runkit_default_property_add('StdSubClass', 'str', "test");
runkit_default_property_remove('StdSubClass', 'str', TRUE);
print_r($obj);
$obj = NULL;
?>
--EXPECTF--
Warning: runkit_default_property_remove(): RunkitClass::publicproperty does not exist in %s on line %d

Notice: runkit_default_property_remove(): Making RunkitSubClass::privateProperty public to remove it from class without objects overriding in %s on line %d

Notice: runkit_default_property_remove(): Making RunkitSubClass::protectedProperty public to remove it from class without objects overriding in %s on line %d
RunkitSubClass Object
(
    [publicProperty] => 1
)
StdSubClass Object
(
)
