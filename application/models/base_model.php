<?php

class Base_Model {

		private $paramNames;
		private $paramValues;
		public $params;

		public function setNames($names)
		{
				$this->paramNames = $names;
				return $this;
		}

		public function setParams($params)
		{
				$this->paramValues = $params;
				return $this;
		}

		/**
		 * Check the set params and add them to the model variables.
		 *
		 * Example Usage To Retrieve a Param:
		 * <code>
		 * 		$params = $indexModel->params;
		 *		$params->name1; (Will produce the value of the param named "name1")
		 *		$params->name2; (ect)
		 * </code>
		 *
		 *
		 */
		public function checkParams()
		{
				$params = Params::check($this->paramValues, $this->paramNames);
				$this->params = $params;
				return $this;
		}

}