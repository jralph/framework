<?php

class Connection {

    /**
     * The established PDO database connection.
     *
     * @var string
     */
    public $pdo;

    /**
     * The SQL query to be run.
     *
     * @var string
     */
    public $sql;

    /**
     * The output of the prepared PDO query.
     *
     * @var string
     */
    public $results;

    /**
     * An array of paramaters to pass to the PDO query.
     * Example:
     *      array(
     *          ':param' => 'value',
     *          ':param2' => 'value
     *      )
     *
     * @var array
     */
    public $params = array();

    /**
     * Get the specified database connection.
     *
     * @param string $pdo
     * @return \Connection
     */
    public function connect($pdo)
    {
        $this->pdo = $pdo;
        return $this;
    }

    /**
     * Sets the sql variable to the requested sql query.
     *
     * @param string $sql
     * @return \Connection
     */
    public function query($sql)
    {
        $this->sql = $sql;

        return $this;

    }

    /**
     * Executes the query using PDO var, sql var and params var.
     * Sets results var as the returned query results.
     *
     * @return \Connection
     */
    public function execute()
    {
        $dbh = $this->pdo;
        $data = $dbh->prepare($this->sql);
        $data->execute($this->params);
        $data = $data->fetchAll();

        $this->results = $data;

        return $this;
    }

    /**
     * Calls the execute function.
     * Converts the results array to an object.
     *
     * @param string $cols
     * @return object
     */
    public function get($cols = null)
    {
        if(isset($cols)){

        }
        $this->execute();

        $object = array();
        $i = 0;
        foreach($this->results as $data){
            $object[$i] = (object) $data;
            $i++;
        }

        return $object;

    }

    /**
     * Return a simple array of results instead of an array of objects.
     * Similar to the default PDO query output and mysql query output.
     * Main purpose is to replace legacy queries.
     *
     * @param string $cols
     * @return array
     */
    public function get_array($cols = null)
    {
        if(isset($cols)){

        }
        $this->execute();

        return $this->results;
    }

    /**
     * Sets the params variable to specified paramaters.
     *
     * @param array $params
     * @return \Connection
     */
    public function params($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Calls the execute function.
     * Gets the first result of the query and returns as an object.
     *
     * @return object
     */
    public function first()
    {
        $this->execute();

        $object = array();
        $i = 0;
        foreach($this->results as $data){
            $object[$i] = (object) $data;
            $i++;
        }

        $data = array_slice($object, 0, 1);
        $data = array_shift($data);

        return $data;

    }

    /**
     * Calls the execute function.
     * Gets the last result of the query and returns as an object.
     *
     * @return object
     */
    public function last()
    {
        $this->execute();

        $count = $this->count();

        $object = array();
        $i = 0;
        foreach($this->results as $data){
            $object[$i] = (object) $data;
            $i++;
        }
        $data = array_slice($object, $count-1, $count);
        $data = array_shift($data);

        return $data;
    }

    /**
     * Checks if results are present (for use with last() function).
     * Calls the execure function if not already run.
     * Returns total number of results in the results array.
     *
     * @return string
     */
    public function count()
    {
        if(!isset($this->results)){
            $this->execute();
        }

        $count = count($this->results);

        return $count;
    }

}
