<?php
namespace Database\Mappers;
use \Database\Mappers\StorageMapper;
use PDO;
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
		'id' => array('id', PDO::PARAM_INT),
		'hostname' => array('hostname', PDO::PARAM_STR),
		'ip' => array('ip', PDO::PARAM_STR),
		'id_tipo' => array('idTipo', PDO::PARAM_INT),
		'fabricante' => array('fabricante', PDO::PARAM_INT),
		'modelo' => array('modelo', PDO::PARAM_STR),
		'ativo' => array('ativo', PDO::PARAM_BOOL),
		'dt_cadastro' => array('dtCadastro',PDO::PARAM_STR),
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

	public function mapRowToObject($row)
	{
		$args = array();
		foreach ($row as $key => $value) {
			$args[] = $value;
		}
		$rf = new \ReflectionClass($this->getClassName());
		return $rf->newinstanceArgs($args);
	} 
	public function findById($id)
	{
		$results = array();
		$tableName = $this->tableName;
		$primaryKey = $this->primaryKey;
		$statement = $this->driver->prepareStatement("SELECT * FROM {$tableName} WHERE {$primaryKey} = :id");
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		if($rows){
			foreach ($rows as $row) {
				$results = $this->mapRowToObject($row);
			}
		}
		return $results;
	}
	public function findAll()
	{
		$results = array();
		$tableName = $this->tableName;
		$statement = $this->driver->prepareStatement("SELECT * FROM {$tableName}");
		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		if ($rows) {
			foreach ($rows as $row) {
				$results[] = $this->mapRowToObject($row);
			}
		}
		return $results;
	}

	public function filterFields()
	{
		$fields = array_keys($this->fieldsMap);
		$key;

		// Remove fields with values automatically created by the database that shoudn't change
		// Like AUTO INCREMENT primary keys at insert 
		if(count($this->autoValues)){
			foreach ($this->autoValues as $field) {
				$key = array_search($field, $fields);
				unset($fields[$key]);
			}
		}
		return $fields;
	} 

	public function prepareFieldsList()
	{
		$fields = $this->filterFields();
		$list = implode(', ', $fields);
		return $list;
	}

	public function prepareValuesList()
	{
		$fields = explode(', ', $this->prepareFieldsList());
		$list = ':'.implode(', :', $fields);
		return $list;
	}

	public function insert($entity)
	{
		$fields = $this->filterFields();
		$fieldsMap = $this->fieldsMap;
		$className = $this->getClassName();
		if (!$entity instanceof $className) {
			return false;
		}
		$tableName = $this->tableName;
		$sql =  "INSERT INTO {$tableName} ";
		$sql .= '('.$this->prepareFieldsList().') ';
		$sql .= 'values('.$this->prepareValuesList().')';
		$statement = $this->driver->prepareStatement($sql);
		foreach ($fields as $field) {
			$method = 'get'.ucfirst($fieldsMap[$field][0]);
			$statement->bindValue(":{$field}", $entity->$method(), $fieldsMap[$field][1]);
		}	
		return $statement->execute();
		
	}
	public function delete($entity)
	{
		
		$tableName = $this->tableName;
		$className = $this->getClassName();
		$primaryKey = $this->primaryKey;
		$fieldsMap = $this->fieldsMap;
		if (!($entity instanceof $className)) {
			return false;
		}
		$sql = "DELETE FROM {$tableName} WHERE {$primaryKey} = :id";
		$statement = $this->driver->prepareStatement($sql);
		$method = 'get'.ucfirst($fieldsMap[$primaryKey][0]);
		$statement->bindValue(':id', $entity->$method(), $fieldsMap[$primaryKey][1]);
		return $statement->execute();

	}
	public function update($entity)
	{
		$tableName = $this->tableName;
		$className = $this->getClassName();
		$primaryKey = $this->primaryKey;
		$fieldsMap = $this->fieldsMap;
		$fields = $this->filterFields();

		if (!($entity instanceof $className)) {
			return false;
		}

		$sql  = "UPDATE {$tableName} SET ";

		foreach ($fields as $field) {
			$sql .= "{$field} = :{$field}, ";
		}
		$sql = rtrim($sql, ', ');
		$sql .= " WHERE {$primaryKey} = :id ";
		echo $sql;
		$statement = $this->driver->prepareStatement($sql);
		foreach ($fields as $field) {
			$method = 'get'.ucfirst($fieldsMap[$field][0]);
			$statement->bindValue(":{$field}", $entity->$method(), $fieldsMap[$field][1]);
		}
		$method = 'get'.ucfirst($fieldsMap[$primaryKey][0]);
		$statement->bindValue(':id', $entity->$method(), $fieldsMap[$primaryKey][1]);
		return $statement->execute();
	}
}