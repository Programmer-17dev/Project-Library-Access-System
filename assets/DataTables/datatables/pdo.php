<?php

// Enable error reporting for debugging (remove for production)
error_reporting(\E_ALL);
ini_set('display_errors', '1');

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Database user / pass
 */
$sql_details = [
	'type' => 'Mysql',     // Database type: "Mysql", "Postgres", "Sqlserver", "Sqlite" or "Oracle"
	'user' => 'sa',          // Database user name
	'pass' => 'Pa55word123.',          // Database password
	'host' => 'localhost', // Database host
	'port' => '',          // Database connection port (can be left empty for default)
	'db' => 'test',          // Database name
	'dsn' => '',          // PHP DSN extra information. Set as `charset=utf8mb4` if you are using MySQL
	'pdoAttr' => [],   // PHP PDO attributes array. See the PHP documentation for all options
];

