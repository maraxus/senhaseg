<?php
namespace Database\Mappers;

/**
* Common functionality for data mappers
*/
class StorageMapper
{
	private $driver;
	function __construct(StorageDriver $driver)
	{
		$this->driver = $driver;
	}

}