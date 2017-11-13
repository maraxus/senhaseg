<?php
namespace Database\Mapper;

/**
* 
*/
class StorageMapper
{
	private $driver;
	function __construct(StorageDriver $driver)
	{
		$this->driver = $driver;
	}


}