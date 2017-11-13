<?php
namespace Entity;

/**
* Describes the 'TipoDispositivo' Domain Object
*/
class TipoDispositivo extends BaseEntity
{
	private $id, $nome;

	protected function __construct($id, $nome)
	{
		$this->id = $id;
		$this->nome = $nome;

	}

	public static function fromState(array $state) {
		return new self(
			$state['id'],
			$state['nome']
		);
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

}
