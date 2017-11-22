<?php
namespace Database\Mappers;
use \Database\Mappers\PDOStorageMapper;
use \Database\Mappers\DispositivoPDOMapper;
use \Entitty\Dispositivo;
use PDO;

/**
* common functionality for mappers mapping attribues on entities to PDO DAO
* from base class: $driver, $reflector, $className
*/
class TipoDispositivoPDOMapper extends PDOStorageMapper
{
	
	protected $relationships = array(
		'dispositivos' => array(
			'relation' => 'has_many',
			'mapper' => DispositivoPDOMapper::class,
			'className' => Dispositivo::class,
			'tableName' => 'tipo',
			'pk' => 'id',
			'fk' => 'id'
	));
	protected $tableName = 'tipo';
	protected $primaryKey = 'id';
	protected $fieldsMap = array(
		'id' => array('id', PDO::PARAM_INT),
		'tipo' => array('tipo', PDO::PARAM_STR),
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