<?php
namespace Database\Mappers;
use \Entity\BaseEntity;
use \Database\StorageDriver;
use ReflectionClass;
use Exception;
/**
* Common functionality for data mappers. It describes and maps a entity to a persistent store, like one,
* or various database tables. Extend this to implement new persistance mappings for your entities.
*/
class StorageMapper
{
	public $driver, $reflector, $className;	
	function __construct($driver, $className)
	{
		$this->className = $className;
		$this->reflector = $reflector = new ReflectionClass($className);
		if (!$reflector->isSubclassOf(\Entity\BaseEntity::class)) {
			throw new Exception("Exiting Mapper constructor: ".$className." is not a Entity class.", 1);
		}
		if (!$driver instanceof StorageDriver) {
			throw new Exception("Exiting Mapper constructor: first argument must be a class implementing \Database\StorageDriver interface.", 1);
		}
		$this->driver = $driver;
	}

}