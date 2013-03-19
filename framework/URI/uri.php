<?php

// ----------------------------------------------------------------------
// URI Helper to convert URL requests into controller/action/options.
// ----------------------------------------------------------------------


class URI {

		public $controller;
		public $action;
		public $urlOptions;

		public function get()
		{
				$uri = explode('/', $_SERVER['PATH_INFO']);
				$this->controller = $uri[1];
				unset($uri[1]);
				$this->action = $uri[2];
				unset($uri[2]);

				$options = $uri;
				unset($options[0]);

				$uri_values = array();
				foreach($options as $option)
				{
						$uri_values[] = $option;
				}

				$this->urlOptions = $uri_values;

		}

}