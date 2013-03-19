<?php

class Config {

    /**
     * IoC for configuration object.
     *
     *
     * @param type $conf_file
     * @param type $loc
     * @return \Configuration
     */
    public static function get($conf_file, $loc)
    {

        $config = new Configuration;
        $config->get($conf_file, $loc);

        return $config;

    }

}