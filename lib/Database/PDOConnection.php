<?php
namespace Database;
use PDOException;
use PDO;
/**
* A wrapper for PDO connection
*/
class PDOConnection implements StorageDriver
{
	private $dsn;
	private $user;
	private $pass;
	private $options;
	private $storage;
	private $errors = array();
	
	protected function __construct($dsn, $user, $pass, $options)
	{
		try{			
			$this->storage = $storage = new PDO($dsn, $user, $pass, $options);
			$storage->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		} catch(PDOException $e) {
			$this->errors = $e->getMessage();
		}
	}
	public static function fromConfig(Array $config) {
		if (isset($config['options'])) {
			$options = $config['options'];
		} else {
			$options = array();
		}
		return new self($config['dsn'], $config['user'], $config['pass'], $options);
	}
	public function getErrors() 
	{
		return $this->errors;
	}

	public function prepareStatement($query)
	{
		return $this->storage->prepare($query);
	}

	public function mapRowToObject($row, $className)
	{
		$args = array();
		foreach ($row as $key => $value) {
			$args[] = $value;
		}
		$rf = new \ReflectionClass($className);
		return $rf->newinstanceArgs($args);
	} 
	public function findById($id, $className)
	{
		$results = array();
		$statement = $this->storage->prepare('SELECT * FROM dispositivos WHERE id = :id');
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		if($rows){
			foreach ($rows as $row) {
				$results = $this->mapRowToObject($row,$className);
			}
		}
		return $results;
	}
	public function findAll($className)
	{
		$results = array();
		$statement = $this->storage->prepare('SELECT * FROM dispositivos');
		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		if ($rows) {
			foreach ($rows as $row) {
				$results[] = $this->mapRowToObject($row, $className);
			}
		}
		return $results;
	}
	public function insert($entity, $className)
	{
		if (! ($entity instanceof $className)) {
			return false;
		}
		$sql =  'INSERT INTO dispositivos ';
		$sql .= '(hostname, ip, id_tipo, fabricante, modelo, ativo) ';
		$sql .= 'values(:hostname, :ip, :id_tipo, :fabricante, :modelo, :ativo)';
		$statement = $this->storage->prepare($sql);
		$statement->bindValue(':hostname', $entity->getHostname(), PDO::PARAM_STR);
		$statement->bindValue(':ip', $entity->getIp(), PDO::PARAM_STR);
		$statement->bindValue(':id_tipo', $entity->getIdTipo(), PDO::PARAM_INT);
		$statement->bindValue(':fabricante', $entity->getFabricante(), PDO::PARAM_STR);
		$statement->bindValue(':modelo', $entity->getModelo(), PDO::PARAM_STR);
		$statement->bindValue(':ativo', $entity->getActive(), PDO::PARAM_BOOL);	
		return $statement->execute();
		
	}
	public function delete($entity, $className)
	{
		if (!($entity instanceof $className)) {
			return false;
		}
		$sql = 'DELETE FROM dispositivos WHERE id = :id';
		$statement = $this->storage->prepare($sql);
		$statement->bindValue(':id', $entity->getId(), PDO::PARAM_INT);
		return $statement->execute();

	}
	public function update($entity, $className)
	{
		if (!($entity instanceof $className)) {
			return false;
		}
		$sql  = 'UPDATE dispositivos SET ';
		$sql .= 'hostname = :hostname, ';
		$sql .= 'ip = :ip, ';
		$sql .= 'id_tipo = :id_tipo, ';
		$sql .= 'fabricante = :fabricante, ';
		$sql .= 'modelo = :modelo, ';
		$sql .= 'ativo = :ativo ';
		$sql .= 'WHERE id = :id';
		$statement = $this->storage->prepare($sql);
		$statement->bindValue(':hostname', $entity->getHostname(), PDO::PARAM_STR);
		$statement->bindValue(':ip', $entity->getIp(), PDO::PARAM_STR);
		$statement->bindValue(':id_tipo', $entity->getIdTipo(), PDO::PARAM_INT);
		$statement->bindValue(':fabricante', $entity->getFabricante(), PDO::PARAM_STR);
		$statement->bindValue(':modelo', $entity->getModelo(), PDO::PARAM_STR);
		$statement->bindValue(':ativo', $entity->getActive(), PDO::PARAM_BOOL);	
		$statement->bindValue(':id', $entity->getId(), PDO::PARAM_INT);
		return $statement->execute();
	}
}