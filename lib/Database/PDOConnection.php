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
	public function prepareStatement($query){
		return $this->storage->prepare($query);
	}

	public function find($attr){}
	public function mapRowToObject($row){} 
	public function mapRecordsetToArray($rs){}
	public function insert($entity){}
	public function delete($entity){}
	public function update($entity){}
}