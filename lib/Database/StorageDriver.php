<?php
namespace Database;
/**
* This abstract define expected behaviors for connecting to a persistence driver
*/
interface StorageDriver
{

	/*
	 * @param array $config a associative array with configuration values for the driver,
	 * like credentials for database connection for example
	 */
	public static function fromConfig(Array $config);
	public function getErrors();
}