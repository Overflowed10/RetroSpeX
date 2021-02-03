<?php

class Database {
	private $con = null;

    public function connect() {
		global $db_config;
		$con = null;
        $db_config['database'] = require 'config.php';

		if ($db_config['env'] == "development") {
			$config = $db_config['development'];
		}elseif ($db_config['env'] == "production") {
			$config = $db_config['production'];
		}else{
			die("Environment must be either 'development' or 'production'.");
		}
        try{
            $this->con = new PDO("mysql:host=".$config['host'].";port=".$config['port'].";dbname=".$config['database'].";charset=utf8", $config['username'], $config['password'] );
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $this->con;
    }

}

?>