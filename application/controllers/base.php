<?php

/*
 * The base controller.
 *
 * This contriller is needed as a parent in ALL other controllers
 * for the framework to function correctly.
 *
 * The executeAction method is called to generate the controller
 * action that is requested.
 *
 */

class Base_Controller {

		private $action;
		private $urlvalues;

		public function __construct($action, $urlvalues)
		{
				$this->urlvalues = $urlvalues;
				$this->action = $action;
		}

		public function ExecuteAction()
		{
				return $this->{$this->action}($this->urlvalues);
		}

}