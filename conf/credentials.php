<?php

declare(strict_types=1);

/**
 * Credenciales a la DB
 */
return [
	'default' => [
		'driver' => 'mysql',
		'dns' => 'localhost',
		'port' => 3008,
		'databaseName' => 'simplymvcphp',
		'charset' => 'utf8mb4',
		'userName' => 'root',
		'password' => ''
	],
	'helpdesk' => [
		'driver' => 'mysql',
		'dns' => 'localhost',
		'port' => 3008,
		'databaseName' => 'helpdeskdb',
		'charset' => 'utf8mb4',
		'userName' => 'root',
		'password' => ''
	]

];
