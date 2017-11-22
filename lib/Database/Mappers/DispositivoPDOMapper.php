<?php
namespace Database\Mappers;
use \Database\Mappers\PDOStorageMapper;
use \Database\Mappers\TipoDispositivoPDOMapper;
use \Entity\TipoDispositivo;
use PDO;
/**
* common functionality for mappers mapping attribues on entities to PDO DAO
* from base class: $driver, $reflector, $className
*/
class DispositivoPDOMapper extends PDOStorageMapper
{
	
	protected $relationships = array(
		'tipo' => array(
			'relation' => 'belongs_to',
			'mapper' => TipoDispositivoPDOMapper::class,
			'className' => TipoDispositivo::class,
			'tableName' => 'tipo',
			'pk' => 'id',
			'fk' => 'id_tipo'
		) );
	protected $tableName = 'dispositivos';
	protected $primaryKey = 'id';
	protected $fieldsMap = array(
		'id' => array('id', PDO::PARAM_INT),
		'hostname' => array('hostname', PDO::PARAM_STR),
		'ip' => array('ip', PDO::PARAM_STR),
		'id_tipo' => array('idTipo', PDO::PARAM_INT),
		'fabricante' => array('fabricante', PDO::PARAM_INT),
		'modelo' => array('modelo', PDO::PARAM_STR),
		'ativo' => array('ativo', PDO::PARAM_BOOL),
		'dt_cadastro' => array('dtCadastro',PDO::PARAM_STR),
		'tipo' => array('tipo',PDO::PARAM_STR)
	);
	protected $autoValues = array('id','dt_cadastro');

	protected $relatedValues = array('tipo' => array('tipo', 'tipo'));
	
}