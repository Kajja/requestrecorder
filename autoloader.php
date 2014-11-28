<?php

/**
 * Autoloader used when running the unit tests
 *
 */


// Registering the autoloader function
spl_autoload_register(function($class) {

		// Namespace prefix that this autoloader function handles
		$prefix = 'Kajja\\';

		// Is the class in the namespace?
		$len = strlen($prefix);
	    if (strncmp($prefix, $class, $len) !== 0) {
	        // No, move to the next registered autoloader (if there is one)
	        return;
	    }
		
		// Directory for the namespace
		$dir = __DIR__ . '/src/';

		// Get the class name without the namespace prefix
    	$shortClassName = substr($class, $len);

	    // Replace the namespace prefix with the base directory, 
	    // replace namespace separators with directory separators,
	    // append .php file extension
	    $file = $dir . str_replace('\\', '/', $shortClassName) . '.php';

	    // if the file exists, require it
	    if (file_exists($file)) {
	        require $file;
	    }
	}
);

// To automatically get access to the classes installed by composer (composer
// creates a autoload function)
require 'vendor/autoload.php';