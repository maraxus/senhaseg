<?php
namespace Database\Mappers;
use \Database\Mappers\StorageMapper;

/**
* common functionality for mappers mapping attribues on entities to PDO DAO
* from base class: $driver, $reflector, $className
*/
class TipoDispositivoPDOMapper extends StorageMapper
{
	
	protected $relationships;
	protected $tableName = 'tipo';
	protected $primaryKey = 'id';
	protected $fieldsMap = array(
		'id' => 'id',
		'nome' => 'nome'
	);
	protected $autoValues = array('id');

	public function getRelationships() 
	{
		return $this->relationships;
	}
	public function getClassName()
	{
		return $this->className;
	}

}