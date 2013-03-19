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
// Set the framework path constraints.
// --------------------------------------------------------------
require '../paths.php';

// --------------------------------------------------------------
// Require the core files for the framework.
// --------------------------------------------------------------
require path('sys').'master.php';

// --------------------------------------------------------------
// Begin Framework.
// --------------------------------------------------------------
$uri = new URI;
$uri->get();

$loader = new Loader($uri->controller, $uri->action, $uri->urlOptions);
$controller = $loader->CreateController();
$controller->ExecuteAction();

