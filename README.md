# OBPipe
OBPipe and SOBPipe are two classes that allows you to handle output
buffering as if you were writing to different pipes.
This makes it possible to reorder the output before it is actually
written.

## class OBPipe

### public function kill()
Terminate the ob_handler

### public function activate($name)
Select which pipe to write to

### public function current()
Get the name of the current pipe

### public function clean($name)
Clean the named pipe

### public function remove($name)
Remove the named pipe

### protected function getBuffer()
Internal function that collects the data from the ob_handler and
puts it in the correvt pipe

### public function flush($name)
Returns the content of the named pipe and empties its content

### public function get($name)
Return the content of the named pipe without changing its content

### public function length($name)
Returns the length if the string in the specified pipe

### public function Output($result)
Collects the complete output stored in all pipes

### public function getNames()
Get the names of all pipes

### public function setNames($names)
Assign which pipes should exist and in which order. Any existing
pipe will be intact and any new pipe will be created. If a pipe
doesn't exist in the array then its content will be removed.


## class SOBPipe
SOBPipe is a static wrapper for the OBPipe

### public static function Init()
Make sure there is an instance to work with. This is called by an
function so there is really no need to call it explicitly

### public static function activate($name)
Activate the given named pipe. Will be created if it doesn't exist

### public static function current()
Return the name of the current pipe

### public static function clean($name)
Remove the content from the named pipe

### public static function remove($name)
Remove the named pipe. Any content will be removed

### public static function flush($name)
Return the content of the named pipe. The content will be removed
from the handler

### public static function get($name)
Return the content of the named pipe. The content will be unchanged
in the handler

### public static function length($name)
Return the length of the named pipe

### public static function getNames()
Return the name of all pipes

### public static function setNames($names)
Set the order of the pipes in the handler. Any named pipe that
doesn't exist will be created and any pipe that isn't listed will
be removed

### public static function kill()
Terminate the static handler


If the name of a pipe is false (boolean) an unnamed pipe will be used
instead. The content of the unnamed pipe will always be presented before
the content of the named handlers.

## Simple usage - Dynamic
```php
<?php
include('../obpipe.php');
$pipe = new OBPipe();
$pipe->activate('alpha');
echo "Hello";
$pipe->activate('bravo');
echo ", world!";
?>
```
Will print "Hello, world!"