<?php

class Autoload {

		public static function Controller($name)
		{
				$name = strtolower($name);

				if( file_exists(path('app').DS.'controllers'.DS.$name.'.php') )
				{
						require path('app').DS.'controllers'.DS.$name.'.php';

						return true;
				}
					else
				{
						return false;
				}
		}

}