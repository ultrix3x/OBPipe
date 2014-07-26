<?php
include('../obpipe.php');

// Create a dynamic output handler
$pipe = new OBPipe();

// Activate the pipe named alpha
$pipe->activate('alpha');

// Output some text
echo "Hello";

// Activate the pipe called bravo
$pipe->activate('bravo');

// Output some text
echo ", world!";

/*
 * The expected output is:
 * "Hello, world!"
 */
?>