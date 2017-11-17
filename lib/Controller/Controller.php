<?php
namespace Controller;
use \Entity\BaseEntity;
use \View\View;

/**
* Base controller
*/
abstract class Controller
{
	protected $model, $view;
	function __construct(BaseEntity $entity, View $view)
	{
		$this->model = $entity;
		$this->view = $view;
	}

	abstract public function getView();
}