<?php
namespace Entity;

/**
* Describes the 'TipoDispositivo' Domain Object
*/
class TipoDispositivo extends BaseEntity
{
	protected $id, $nome;

	public function __construct($id, $nome)
	{
		$this->id = $id;
		$this->nome = $nome;

	}

	public static function fromState(array $state) {
		return new self(
			isset($state['id']) ? $state['id'] : 0,
			isset($state['nome']) ? $state['nome'] : ''
		);
	}

	public function getAttribute($attribute)
	{
		$getterMethod = 'get'.ucfirst($attribute);
		return $this->$getterMethod();
	}

	public function toArray()
	{
		$array = array();
		$getterMethod;
		foreach ($this as $key => $value) {
			$getterMethod = 'get'.ucfirst($key);
			$array[$key] = $this->$getterMethod();
		}
		return $array;
	}

	public static function getFriendlyNames()
	{
		$friendly = array(
			'id' => 'id',
			'nome' => 'nome'
		);
		return $friendly;
	}

	public function getId() {
		return $this->id;
	}

	protected function setId($str) {
		$this->id = $str;
	}

	public function getNome(){
		return $this->nome;	
	}

	public function setNome($str){
		$this->nome = $str;
	}

	public function getValuesString()
	{
		$str =  $this->getId().',';
		$str .= $this->getNome().',';
		return $str;
	}

}
