<?php
namespace Controller;
use \View\View;
use \Database\Mappers\StorageMapper;
/**
* Base controller
*/
abstract class Controller
{
	protected $view, $mapper;
	function __construct(View $view, StorageMapper $mapper)
	{
		$this->view = $view;
		$this->mapper = $mapper;
	}

	abstract public function getView();
}