<?php
namespace Entity;
use DateTime;
/**
* Describes the 'Dispositivo' Domain Object
*/
class Dispositivo extends BaseEntity
{
	private $id, $hostname, $ip, $idTipo, $fabricante, $modelo, $ativo, $dtCadastro;
	private $tipo;

	protected function __construct($id, $hostname, $ip, $idTipo, $fabricante, $modelo, $ativo, $dtCadastro) {
		$this->id = $id;
		$this->hostname = $hostname;
		$this->ip = $ip;
		$this->idTipo = $idTipo;
		$this->fabricante = $fabricante;
		$this->modelo = $modelo;
		$this->ativo = $ativo;
		$this->dtCadastro = $dtCadastro;

	}

	public static function fromState($state){
		return new self(
			$state['id'],
			$state['hostname'],
			$state['ip'],
			$state['idTipo'],
			$state['fabricante'],
			$state['modelo'],
			$state['ativo'],
			$state['dtCadastro']
		);
	}

	public function getId(){
		return $this->id;
	}

	public function setId($int){
		$this->id = $int;
	}

	public function getHostname(){
		return $this->hostname;
	}

	public function setHostname($str) {
		$this->hostname = $str;
	}

	public function getIdTipo(){
		return $this->idTipo;
	}

	public function setIdTipo($int) {
		$this->idTipo = $int;
	}

	public function getIp(){
		return $this->ip;
	}

	public function setIp($str){
		$this->ip = $str;
	}

	public function getFabricante(){
		return $this->fabricante;
	}

	public function setFabricante($str) {
		$this->fabricante = $str;
	}

	public function getModelo(){
		return $this->modelo;
	}

	public function setModelo($str) {
		$this->modelo = $str;
	}

	public function isActive(){
		return $this->ativo;
	}

	public function activate(){
		$this->ativo = true;
	}

	public function deactivate(){
		$this->ativo = false;
	}

	public function setDtCadastro(DateTime $date){
		$this->dtCadastro = $date;
	}

	public function getDtCadastro(){
		return $this->dtCadastro->format('d/m/Y');
	}

}