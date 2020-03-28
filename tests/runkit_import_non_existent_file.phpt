--TEST--
runkit_import() Importing non-existent file
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip";
      if(!function_exists('runkit_import')) print "skip";
?>
--FILE--
<?php
runkit_import('non-existent_file.unknown');
echo "After error";
?>
--EXPECTF--
Warning: runkit_import(non-existent_file.unknown): %sailed to open stream: No such file or directory in %s on line %d

Warning: runkit_import(): Failed opening 'non-existent_file.unknown' for inclusion %s on line %d

Warning: runkit_import(): Import Failure in %s on line %d
After error
