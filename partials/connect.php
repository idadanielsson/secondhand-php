<?php

require_once 'config.php';

function connect($host, $dbname, $password, $charset)
{
	$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

	try {
		$options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

		return new PDO($dsn, $dbname, $password, $options);
	} catch (PDOException $e) {
		die($e->getMessage());
	}
}

return connect($host, $dbname, $password, $charset);