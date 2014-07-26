<?php
include('../obpipe.php');

// Create a dynamic output handler
$pipe = new OBPipe();

// Activate the pipe called bravo
$pipe->activate('bravo');

// Output some text
echo ", world!";

// Activate the pipe named alpha
$pipe->activate('alpha');

// Output some text
echo "Hello";

// Reorder the output
$pipe->setNames(array('alpha', 'bravo'));

/*
 * The expected output is:
 * "Hello, world!"
 */
?>