<?php

// --------------------------------------------------------------
// Require the framework core files to be included.
// --------------------------------------------------------------
require 'core.php';

// --------------------------------------------------------------
// Setup Autoloader to load required classes.
// --------------------------------------------------------------
function __autoload($class)
{
		$class = strtolower($class);

		if( file_exists(path('app').'models'.DS.$class.'.php') )
		{
				require path('app').'models'.DS.$class.'.php';
		}
			elseif( file_exists(path('app').DS.'library'.DS.$class.'.php') )
		{
				require path('app').DS.'library'.DS.$class.'.php';
		}
}