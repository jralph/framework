<?php

/**
 * The View class is used to render the requested view from within a controller.
 *
 * The request must be passed to the class, but an optional $values param
 * can also be passed to add variables into the rendering.
 *
 * <code>
 *		View::Create('folder.index', array(
 *       		'var1' => $value,
 *				'var2' => $value2,
 *   	));
 * </code>
 *
 */

class View {

		/**
		 * IoC Container for the View Class.
		 *
		 * Initializes and runs the View class to render the view that has been requested
		 * along with the values that need to be used.
		 *
		 * Note: All values are created as follows: $tpl_{value_key} = $value.
		 *
		 * @param string $request
		 * @param array $values
		 */
		public static function Create($request, $values = null)
		{
				$view = new View;
				$view->setRequest($request);
				if($values != null)
				{
						$view->setValues($values);
				}
				$view->getRequested();
				$view->generate();

		}

		private $request;
		private $values = null;

		// -------------------------------------------------------------------------
		// This variable is used to store the path of the requested view.
		// -------------------------------------------------------------------------
		private $file;

		// -------------------------------------------------------------------------
		// Explains its self. Sets the $request variable.
		// -------------------------------------------------------------------------
		public function setRequest($request)
		{
				$this->request = $request;
				return $this;
		}

		// -------------------------------------------------------------------------
		// Explains its self. Sets the $values variable.
		// -------------------------------------------------------------------------
		public function setValues($values)
		{
				$this->values = $values;
				return $this;
		}

		/**
		 * Function to get the requested page and path to the page.
		 * This function checks the request variable for any '.'
		 * If any are found, it assumes that the . is NOT in the file name
		 * and that it is leading to a file. (ec. 'test.index' would mean to include
		 * a folder within the views folder called test, and a page within the test folder
		 * called index.php)
		 *
		 */
		public function getRequested()
		{
				// -------------------------------------------------------------------------
				// Explode the request into individual requests if the request contains the
				// file/folder seperator (.)
				// Else set $requested as the request.
				// -------------------------------------------------------------------------
				if(strstr($this->request, '.'))
				{
						$requested = explode('.', $this->request);
				}
					else
				{
						$requested = $this->request;
				}

				// -------------------------------------------------------------------------
				// If $requested is not an array, find the file within the views directory
				// and set the file variable as the path to that page.
				// -------------------------------------------------------------------------
				if( ! is_array($requested) )
				{
						if( file_exists(path('app').'views'.DS.$requested.'.php'))
						{
								$this->file = path('app').'views'.DS.$requested.'.php';
						}
				}
					// -------------------------------------------------------------------------
					// Else $requested is an array.
					// -------------------------------------------------------------------------
					else
				{
						// -------------------------------------------------------------------------
						// Set path variable to empty and $i to 0.
						// If $i is 0, do not include the Directory Seperator, else, include it.
						// -------------------------------------------------------------------------
						$i = 0;
						$path = '';
						foreach($requested as $loc)
						{
								if($i == 0)
								{
										$path .= $loc;
								}
									else
								{
										$path .= DS.$loc;
								}
								$i++;
						}

						// -------------------------------------------------------------------------
						// Check that the path generated above exists within the views directory
						// of the application folder.
						// -------------------------------------------------------------------------
						if( file_exists(path('app').'views'.DS.$path.'.php') )
						{
								$this->file = path('app').'views'.DS.$path.'.php';
						}
				}

		}

		/**
		 * Function to generate the request and set the required values.
		 *
		 * Sets values as $tpl_{$key}.
		 *
		 */
		public function generate()
		{
				if($this->values != null)
				{
						foreach($this->values as $key => $value)
						{
								$key = 'tpl_'.$key;
								${$key} = $value;
						}
				}

				require($this->file);

		}

}