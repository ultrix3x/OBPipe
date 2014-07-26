<?php
include('../obpipe.php');
/*
 * Almost the same example as html.php and html3.php but here the usage
 * of the unnamed pipe is used to insert content before the pipes.
 */
 
// Create three pipes. head, body and foot
SOBPipe::setNames(array('head', 'body', 'foot'));

// Activate buffering for head
SOBPipe::activate('head');

// Write some code for the head
echo "<html>\n";
echo " <head>\n";

// Activate buffering for body
SOBPipe::activate('body');

// Write some code for the head
echo " </head>\n";
echo " <body>\n";

// Activate buffering for foot
SOBPipe::activate('foot');

// Write some code for the foot
echo " </body>\n";
echo "</html>\n";

// reactivate buffering for head
SOBPipe::activate('head');

// Write some more code for the head
echo "  <title>Hello</title>\n";

// reactivate buffering for body
SOBPipe::activate('body');

// Write some more code for the body
echo "  This is the content of the page\n";

// Activate the unnamed pipe
SOBPipe::activate(false);

// Write a line that will be displayed before the piped result
echo "Content-Type: text/html\n\r\n\r";



/*
 * This should give the following result
 * Content-Type: text/html
 * 
 * <html>
 *  <head>
 *   <title>Hello</title>
 *  </head>
 *  <body>
 *   This is the content if the page
 *  </body>
 * </html>
 */
?>