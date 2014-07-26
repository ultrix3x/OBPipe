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

// Collect the output in a variable
$data = $pipe->Output('');

// Kill the output handler
$pipe->kill();

// Remove the handler
$pipe = null;

// Output the data in a reverse order
echo strrev($data);
/*
 * The expected output is:
 * "!dlrow ,olleH"
 */
?>