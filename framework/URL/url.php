<?php

/**
 * URL Helper Class to assist in creation of urls.
 * Also helps in site migration as the domain is auto generated.
 *
 * Eg, moving a site from example.com to example.co.uk, all urls will remain intact
 * and fully functional.
 *
 * <code>
 *		URL::to('home@index');
 *		//OR
 *		URL::to('home/index?page=11', true);
 * </code>
 *
 */

class URL {

		/**
		 * Function to($request, $secure = false)
		 *
		 * Pass in the url request using the @ symbol to represent a controller action.
		 * eg. home@login would go to the home controller at the login action.
		 *
		 * Without passing the @ symbol, it will just add the request to the url
		 * eg. $request = home/index will create the url http://example.com/home/index
		 *
		 * The secure variable defines if the address needs to be secure or not.
		 * If set to true, all urls will be generated with the https protocol.
		 *
		 * @param $request
		 * @param $secure
		 *
		 */
		public static function to($request, $secure = false)
		{
				// Check if $request contains @ to direct to a controller action.
				if( strpos($request, '@') )
				{
						// Explode the request to get the controller and action.
						$request = explode('@', $request);

						// Set controller and action variables.
						$controller = $request[0];
						$action = $request[1];

						// Get the domain being used.
						$host = $_SERVER['HTTP_HOST'];

						// Check if secure link is requested and set protocols accordingly.
						if($secure == true)
						{
								$protocol = 'https://';
						}
							else
						{
								$protocol = 'http://';
						}

						// Create the url and return it.
						$url = $protocol.$host.'/'.$controller.'/'.$action;
						return $url;
				}
					// If no @ is present, generate normal url.
					else
				{
						// Get the domain being used.
						$host = $_SERVER['HTTP_HOST'];

						// Check if secure link is requested and set protocols accordingly.
						if($secure == true)
						{
								$protocol = 'https://';
						}
							else
						{
								$protocol = 'http://';
						}

						// Create the url and return it
						$url = $protocol.$host.'/'.$request;
						return $url;
				}
		}

}