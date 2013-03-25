<?php

class Configuration {

    /**
     * Fetches the array from the requested configuration file located
     * in the requested configuration path.
     * Sets variables for each configuration value.
     *
     * @param string $conf_file
     * @param string $conf_path
     */
    public function get($conf_file, $conf_path)
    {
        $config = array();
        if($conf_path !== '' and file_exists($path = $conf_path.'/'.$conf_file.'.php')){
            $config = array_merge($config, require $path);
        }

        foreach($config as $key => $value){
            $this->{$key} = $value;
        }
    }

}