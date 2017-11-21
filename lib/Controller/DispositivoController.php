<?php
namespace Controller;
use \Entity\Dispositivo;

/**
* Controller for dispositivo
*/
class DispositivoController extends Controller
{
	function setListDataHeaders()
	{
		// - lista de attributos visiveis na listagem
		$this->view->data['headers'] = $this->model->getFriendlyNames();

	}

	function setListDataRows()
	{
		$results = $this->mapper->findAll(); 
		
		$this->view->data['results'] = $results;
	}

	public function getView()
	{
		$this->setListDataHeaders();
		$this->setListDataRows();
		return $this->view;
	}
}