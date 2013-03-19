<?php

class Error_Controller extends Base_Controller {

		private $error;

		public function __construct($error)
		{
				$this->error = $error;
		}

		public function ExecuteAction()
		{
			echo 'ERROR: '.$this->error;
		}

}