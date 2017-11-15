<?php
namespace Database\Mappers;
use StorageMapper

/**
* common functionality for mappers mapping attribues on entities to PDO DAO
*/
class PDOMapper extends StorageMapper
{
	
	private $relationships;

	public getRelationships() 
	{
		return $this->relationships;
	}
}