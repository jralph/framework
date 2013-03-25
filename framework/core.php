<?php

// --------------------------------------------------------------
// Require Core Classes.
// --------------------------------------------------------------
require path('sys').'loader.php';
require path('sys').'Autoloader'.DS.'autoload.php';
require path('sys').'Params'.DS.'params.php';
require path('sys').'URI'.DS.'uri.php';
require path('sys').'View'.DS.'view.php';
require path('sys').'Config'.DS.'config.php';
require path('sys').'Config'.DS.'configuration.php';
require path('sys').'URL'.DS.'url.php';
require path('sys').'Hash'.DS.'hash.php';
require path('sys').'Authenticate'.DS.'authenticate.php';
require path('app').'controllers'.DS.'base.php';
require path('app').'controllers'.DS.'error.php';
require path('app').'models'.DS.'base_model.php';


// --------------------------------------------------------------
// Require DB Classes.
// --------------------------------------------------------------
require path('sys').'Database'.DS.'connection.php';
require path('sys').'Database'.DS.'db.php';