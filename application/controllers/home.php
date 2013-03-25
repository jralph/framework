<?php

class Home_Controller extends Base_Controller {

		public function action_index($values)
		{
				$indexModel = new HomeIndex_Model;
				$indexModel->setNames(array('name1'));
				$indexModel->setParams($values);
				$indexModel->checkParams();
				$params = $indexModel->params;

		}

}