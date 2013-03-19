<?php

/**
 * Parameter helper class for use within
 *
 * Similar to passing params to a function, this will return if params are missing.
 * Also lets the user check if params have been set and what value they hold.
 *
 * eg, passing array('test', 'test2', 'test3') as the params and array('name1', 'name2', 'name3')
 * as the names will return an array with the array keys as the names and array values as the params.
 *
 */

class Params {

		/**
		 * Checks through all of the paramaters passed in the url and gives them a name to be used.
		 * If more params than names are given, it will skip the end params.
		 * If less params than names are given, it will fail.
		 *
		 * Function will create an object the names and set a variable in the object as each name and
		 * the value of that variable as the value of the param.
		 *
		 *
		 * @param array $params
		 * @param array $names
		 *
		 */
		public static function check($params, $names)
		{
				if( ! is_array($params) )
				{
						$param = array();
						$param[$names] = $params;
				}
					else
				{
						$total = count($names);

						$i = 0;
						$param = array();
						foreach($params as $param_value)
						{
								$param[$names[$i]] = $param_value;
								if($i+1 == $total)
								{
										break;
								}
									else
								{
									$i++;
								}
						}

						if(count($param) < $total)
						{
								return false;
						}
				}


				$object = new stdClass;
				foreach($param as $key => $value)
				{
						$object->{$key} = $value;
				}

				return $object;
		}

}