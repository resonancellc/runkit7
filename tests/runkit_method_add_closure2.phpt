--TEST--
runkit_method_add() function with closure
--SKIPIF--
<?php
	if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip";
?>
--INI--
display_errors=on
--FILE--
<?php
class Example {
    function foo() {
        echo "foo!\n";
    }
}


// create an Example object
$e = new Example();


for ($i=0; $i<=1; $i++) {
    // Add a new public method
    runkit_method_add(
        'Example',
        'add',
        function ($num1, $num2) {
            return $num1 + $num2;
        }
    );
    $e->add(12, 4);//echo "\n";
    runkit_method_remove(
        'Example',
        'add'
    );
}
--EXPECT--
