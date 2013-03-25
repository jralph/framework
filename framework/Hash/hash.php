<?php

/**
 * A Simple Hashing Method to create secure passwords and values to be used.
 * Uses the key setup in the authenticate config file to generate the salt.
 *
 * <code>
 *		// Will return the hashed password.
 * 		Hash::make('password');
 *		// Will check a value against an already hashed value.
 *		// Example $hashed_value = 20fc70af043f19eff7df7900707bfc1e88fa3437z$0rMfuT1R.Ks
 *		Hash::check('password', $hashed_value)
 * </code>
 *
 */
class Hash {

		public static function make($string)
		{
				$value = sha1(md5(md5(sha1($string))));

				$config = Config::get('authenticate', path('app').'configs'.DS);

				$key = $config->key;

				$salts = str_split($key);

				foreach($salts as $salt)
				{
						$string = crypt($string, $salt);
				}

				return $value.$string;
		}

		public static function check($string, $hashed_value)
		{
				$hashed = static::make($string);

				if($hashed == $hashed_value)
				{
						return true;
				}
					else
				{
						return false;
				}
		}

}