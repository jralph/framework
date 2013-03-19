<?php
/**
 * PHP MVC Web Framework Landing Page
 *
 * @version 	1.0.0
 * @author 		Joseph Ralph <jralph@joxus.com>
 * @link 		http://joxus.com
 *
 */

// --------------------------------------------------------------
// The path to the application directory.
// --------------------------------------------------------------
$paths['app'] = 'application';

// --------------------------------------------------------------
// The path to the Framework directory.
// --------------------------------------------------------------
$paths['sys'] = 'framework';

// --------------------------------------------------------------
// The path to the public directory.
// --------------------------------------------------------------
$paths['public'] = 'public';

// --------------------------------------------------------------
// The path to the storage directory.
// --------------------------------------------------------------
$paths['storage'] = 'public';

// --------------------------------------------------------------
// Change to the current working directory.
// --------------------------------------------------------------
chdir(__DIR__);

// --------------------------------------------------------------
// Define the directory seperator for the environment.
// --------------------------------------------------------------
if ( ! defined('DS'))
{
		define('DS', DIRECTORY_SEPARATOR);
}

// --------------------------------------------------------------
// Define the path to the base directory.
// --------------------------------------------------------------
$GLOBALS['framework_paths']['base'] = __DIR__.DS;

// --------------------------------------------------------------
// Define each constant if not defined.
// --------------------------------------------------------------
foreach ($paths as $name => $path)
{
		if ( ! isset($GLOBALS['framework_paths'][$name]))
		{
				$GLOBALS['framework_paths'][$name] = realpath($path).DS;
		}
}

/**
 * A global path helper function.
 *
 * <code>
 *		$storage = path('storage');
 * </code>
 *
 * @param string $path
 * @return string
 *
 */
function path($path)
{
		return $GLOBALS['framework_paths'][$path];
}

/**
 * A global path setter function.
 *
 * <code>
 *		set_path('app', 'application');
 * </code>
 *
 * @param string $path
 * @param string $value
 * @return void
 *
 */
function set_path($path, $value)
{
		$GLOBALS['framework_paths'][$path] = $value;
}