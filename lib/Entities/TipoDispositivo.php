<?php
namespace Entity;

/**
* Describes the 'TipoDispositivo' Domain Object
*/
class TipoDispositivo extends BaseEntity
{
	protected $id, $Tipo;

	public function __construct($id, $Tipo)
	{
		$this->id = $id;
		$this->Tipo = $Tipo;

	}

	public static function fromState(array $state) {
		return new self(
			isset($state['id']) ? $state['id'] : 0,
			isset($state['Tipo']) ? $state['Tipo'] : ''
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
			'Tipo' => 'Tipo'
		);
		return $friendly;
	}

	public function getId() {
		return $this->id;
	}

	protected function setId($str) {
		$this->id = $str;
	}

	public function getTipo(){
		return $this->Tipo;	
	}

	public function setTipo($str){
		$this->Tipo = $str;
	}

	public function getValuesString()
	{
		$str =  $this->getId().',';
		$str .= $this->getTipo().',';
		return $str;
	}

}
