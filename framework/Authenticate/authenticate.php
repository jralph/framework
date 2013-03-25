<?php

/**
 * User authentication class.
 * Logs a user into the system or checks if a user is logged in.
 *
 * Usage:
 * <code>
 * 		Authenticate::login('username', 'password');
 *		// OR
 *		Authenticate::check();
 * </code>
 *
 */
class Authenticate {

		public $configs;

		public function __construct()
		{
				$this->configs = Config::get('authenticate', path('app').'configs'.DS);
		}

		/**
		 * Check credentials function to check if the requested username and password
		 * exists and is correct.
		 *
		 * @param string $username
		 * @param string $password
		 */
		public function checkCreds($username, $password)
		{
				$table = $this->configs->table;
				$user_field = $this->configs->username_field;
				$pass_field = $this->configs->password_field;

				$password = Hash::make($password);

				$user_check = DB::query('
								SELECT * FROM '.$table.'
								WHERE '.$user_field.' = :username
								AND '.$pass_field.' = :password
							')
							->params(array(
								':username' => $username,
								':password' => $password
							))
							->count();

				if($user_check == 1)
				{
						return true;
				}
					else
				{
						return false;
				}
		}

		/**
		 * Sets the session variables when the login has been checked.
		 *
		 * @param string $username
		 * @param string $password
		 */
		public function set($username, $password)
		{
				$_SESSION['login'] = true;
				$_SESSION['username'] = $username;
				$_SESSION['password'] = Hash::make($password);
				$_SESSION['login_time'] = date('Y-m-d');

				$user = DB::query('
						SELECT * FROM '.$this->configs->table.'
						WHERE '.$this->configs->username_field.' = :username
						AND '.$this->configs->password_field.' = :password
					')
					->params(array(
						':username' => $username,
						':password' => Hash::make($password)
					))
					->first();

				$_SESSION['user_id'] = $user->id;
		}

		// IoC style function to login the user.
		public static function login($username, $password)
		{
				$auth = new Authenticate();
				$check = $auth->checkCreds($username, $password);

				if($check)
				{
						$auth->set($username, $password);
						return true;
				}
					else
				{
						return false;
				}
		}

		/**
		 * Function to check if a user is currently logged in.
		 *
		 * Gets the config data and checks the database for the username
		 * then matches the session password with the users password for
		 * authentication.
		 */
		public static function check()
		{
				if(isset($_SESSION['login']) && $_SESSION['login'] == true)
				{
						$config = Config::get('authenticate', path('app').'configs'.DS);
						$user = DB::query('
								SELECT * FROM '.$config->table.'
								WHERE '.$config->username_field.' = :username
								AND '.$config->password_field.' = :password
							')
							->params(array(
								':username' => $_SESSION['username'],
								':password' => $_SESSION['password'],
							))
							->count();

						if($user == 1)
						{
								return true;
						}
							else
						{
								return false;
						}
				}
					else
				{
					 return false;
				}
		}

		// Simple logout function to logout the current user.
		public static function logout()
		{
				session_unset();
				return true;
		}

		/**
		 * Helper function to return user session info.
		 *
		 * <code>
		 *		Authenticate::user('username');
		 * </code>
		 *
		 */
		public static function user($request)
		{
				return $_SESSION[$request];
		}

}