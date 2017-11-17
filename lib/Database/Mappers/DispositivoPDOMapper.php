<?php
namespace Database\Mappers;
use \Database\Mappers\StorageMapper;

/**
* common functionality for mappers mapping attribues on entities to PDO DAO
* from base class: $driver, $reflector, $className
*/
class DispositivoPDOMapper extends StorageMapper
{
	
	protected $relationships;
	protected $tableName = 'dispositivos';
	protected $primaryKey = 'id';
	protected $fieldsMap = array(
		'id' => 'id',
		'hostname' => 'hostname',
		'ip' => 'ip',
		'id_tipo' => 'idTipo',
		'fabricante' => 'fabricante',
		'modelo' => 'modelo',
		'ativo' => 'ativo',
		'dt_cadastro' => 'dtCadastro'
	);
	protected $autoValues = array('id','dt_cadastro');

	public function getRelationships() 
	{
		return $this->relationships;
	}
	public function getClassName()
	{
		return $this->className;
	}

}