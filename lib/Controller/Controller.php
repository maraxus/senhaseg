<?php
namespace Controller;
use \Entity\BaseEntity;
use \View\View;
use \Database\Mappers\StorageMapper;
/**
* Base controller
*/
abstract class Controller
{
	protected $model, $view, $mapper;
	function __construct(BaseEntity $entity, View $view, StorageMapper $mapper)
	{
		$this->model = $entity;
		$this->view = $view;
		$this->mapper = $mapper;
	}

	abstract public function getView();
}