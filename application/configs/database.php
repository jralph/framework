<?php

/**
 * The configuration for the database connection.
 *
 * Required values to be set are:
 *      driver
 *      host
 *      database
 *      username
 *      password
 *
 * Any optional values may be set after the above.
 * Values can be accessed from the config object.
 * <code>
 *      //Access config file data
 *      $configs = Config::get('connection', 'location_of_this_file');
 *
 *      //Read values once set, returns data from the below array.
 *      $configs->driver
 *
 * </code>
 *
 */
return array(
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'doit',
    'username'  => 'root',
    'password'  => 'KasWrp1a',
);
