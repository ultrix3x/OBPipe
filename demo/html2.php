<?php
include('../obpipe.php');
/*
 * This is an example that gives the same result as html.php but the
 * code is written in another order.
 */


// Activate buffering for body
SOBPipe::activate('body');

// Write some code for the head
echo " </head>\n";
echo " <body>\n";

// Activate buffering for head
SOBPipe::activate('head');

// Write some code for the head
echo "<html>\n";
echo " <head>\n";

// Activate buffering for foot
SOBPipe::activate('foot');

// Write some code for the foot
echo " </body>\n";
echo "</html>\n";

// reactivate buffering for body
SOBPipe::activate('body');

// Write some more code for the body
echo "  This is the content of the page\n";

// reactivate buffering for head
SOBPipe::activate('head');

// Write some more code for the head
echo "  <title>Hello</title>\n";


// Reorder the pipes in the following order head, body and foot
SOBPipe::setNames(array('head', 'body', 'foot'));


/*
 * This should give the following result
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