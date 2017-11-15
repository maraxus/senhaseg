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

	public function mapRowToObject($row)
	{
		return \Entity\Dispositivo::fromState($row);
	} 
	public function findById($attr)
	{
		$statement = $this->storage->prepare('SELECT * FROM dispositivos WHERE id = :id');
		$statement->bindParam(':id', $attr, PDO::PARAM_INT);
		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row) {
			$results = $this->mapRowToObject($row);
		}
		return $results;
	}
	public function findAll()
	{
		$results = array();
		$statement = $this->storage->prepare('SELECT * FROM dispositivos');
		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row) {
			$results = $this->mapRowToObject($row);
		}
		return $results;
	}
	public function insert($entity)
	{
		//$reflector = new \ReflectionClass('\\'.get_class($entity));
		//$fields = $reflector->getdefaultProperties();
		//unset($fields['id']);
		//unset($fields['dtCadastro']);
		//$fields = implode(', ',array_keys($fields));
		$sql =  'INSERT INTO dispositivos ';
		//$sql .= '('.$fields.') ';
		$sql .= '(hostname, ip, id_tipo, fabricante, modelo, ativo) ';
		$sql .= 'values(:hostname, :ip, :id_tipo, :fabricante, :modelo, :ativo)';
		$statement = $this->storage->prepare($sql);
		$statement->bindValue(':hostname', $entity->getHostname(), PDO::PARAM_STR);
		$statement->bindValue(':ip', $entity->getIp(), PDO::PARAM_STR);
		$statement->bindValue(':id_tipo', $entity->getIdTipo(), PDO::PARAM_INT);
		$statement->bindValue(':fabricante', $entity->getFabricante(), PDO::PARAM_STR);
		$statement->bindValue(':modelo', $entity->getModelo(), PDO::PARAM_STR);
		$statement->bindValue(':ativo', $entity->isActive(), PDO::PARAM_BOOL);
		echo $sql;
		return $statement->execute();
		
	}
	public function delete($entity){}
	public function update($entity){}
}