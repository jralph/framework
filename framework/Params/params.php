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

		public static function set($params, $names = array())
		{
				if( ! is_array($params) )
				{
						$param[$name[0]] = $params;
				}
					else
				{
						$total = count($names);

						$i = 0;
						$param = array();
						foreach($params as $param_value)
						{
								$param[$names[$i]] = $param_value;
								if($i == $total)
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
								return 'ERROR: Missing Params!';
						}
				}

				return $param;
		}

}