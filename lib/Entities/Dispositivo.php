<?php
namespace Entity;
use DateTime;
/**
* Describes the 'Dispositivo' Domain Object
*/
class Dispositivo extends BaseEntity
{
	private $id, $hostname, $ip, $idTipo, $fabricante, $modelo, $ativo, $dtCadastro;

	public function __construct($id, $hostname, $ip, $idTipo, $fabricante, $modelo, $ativo, $dtCadastro) {
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
			isset($state['id']) ? $state['id'] : 0,
			isset($state['hostname']) ? $state['hostname'] : '',
			isset($state['ip']) ? $state['ip'] : '',
			isset($state['idTipo']) ? $state['idTipo'] : 0,
			isset($state['fabricante']) ? $state['fabricante'] : '',
			isset($state['modelo']) ? $state['modelo'] : '',
			isset($state['ativo']) ? $state['ativo'] : false,
			isset($state['dtCadastro']) ? $state['dtCadastro'] : new DateTime()
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

	public function getValuesString()
	{
		$str =  $this->getId().',';
		$str .= $this->getHostname().',';
		$str .= $this->getIp().',';
		$str .= $this->getIdTipo().',';
		$str .= $this->getFabricante().',';
		$str .= $this->getModelo().',';
		$str .= $this->isActive().',';
		$str .= $this->getDtCadastro();
		return $str;
	}

}