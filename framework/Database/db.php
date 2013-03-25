<?php
/**
 * The IoC for the database object.
 *
 * Example Usage:
 * <code>
 *      $query =    DB::query('
 *                      SELECT * FROM table1
 *                      WHERE value = :param1
 *                      AND value2 = :param2
 *                      ORDER BY id DESC
 *                      LIMIT 1
 *                  ')
 *                  ->params(array(
 *                      ':param1' => 'value',
 *                      ':param2' => 'value'
 *                  ))
 *                  ->get();
 * </code>
 */
class DB {

    /**
     * IoC for the database object.
     * Initiated the object and sets the configuration values
     * for the PDO connection.
     *
     * Passes the sql input to the database object.
     * Returns the database object instance.
     *
     * If driver is not set, uses default driver from config file.
     *
     * @param string $sql
     * @param string $driver
     * @return \Connection
     */
    public static function query($sql, $driver = NULL)
    {
        $config = Config::get('database', path('app').'configs'.DS);
        if(isset($driver)){
            $driver = $driver;
        } else {
            $driver = $config->driver;
        }
        if($driver == 'adb'){
                $pdo = new PDO('odbc:Driver={Microsoft Access Driver (*.accdb)};Dbq=tools/test.accdb');
        } else {
                $pdo = new PDO($driver.':host='.$config->host.';dbname='.$config->database,
                               $config->username, $config->password);
        }
        $database = new Connection;
        $database->connect($pdo)
                 ->query($sql);

        return $database;
    }

}