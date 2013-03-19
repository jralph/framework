<?php

class Home_Controller extends Base_Controller {

		public function action_index($values)
		{
				$param = Params::set($values, array(
						'name',
						'name2'
				));

		}

}