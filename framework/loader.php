<?php

/**
 *
 * The main class of the framework.
 *
 * Loads and created the requested controller and sets up all requests
 * To that controller ready to be processed.
 *
 * Calling the $controller->ExecureAction() function will initiate the generation
 * when called after CreateController;
 *
 */

class Loader {

		private $controller;
		private $action;
		private $urlvalues;

		// ------------------------------------------------------
		// Store the URL values on object creation.
		// ------------------------------------------------------
		public function __construct($controller, $action, $urlvalues)
		{
				$this->urlvalues = $urlvalues;
				if($controller == '')
				{
						$this->controller = 'home';
				}
					else
				{
					$this->controller = $controller;
				}

				if($action == '')
				{
						$this->action = 'index';
				}
					else
				{
					$this->action = $action;
				}
		}

		// ------------------------------------------------------
		// Create the requested controller.
		// ------------------------------------------------------
		public function CreateController()
		{
				if( Autoload::Controller($this->controller) )
				{
						$controller = ucwords($this->controller.'_Controller');

						if( method_exists($controller, 'action_'.$this->action) )
						{
								$action = 'action_'.$this->action;
								return new $controller($action, $this->urlvalues);
						}
							else
						{
								return new Error_Controller('404 - Page Not Found');
						}
				}
					else
				{
						echo 'FAIL';
				}
		}

}