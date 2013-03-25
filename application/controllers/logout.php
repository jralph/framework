<?php

class Logout_Controller extends Base_Controller {

		public function action_index($values)
		{
				Authenticate::logout();
		}

}