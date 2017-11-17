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
		$this->view->data['results'] = $this->model->findAll(); 
	}

	public function getView()
	{
		$this->setListDataHeaders();
		$this->setListDataRows();
		return $this->view;
	}
}