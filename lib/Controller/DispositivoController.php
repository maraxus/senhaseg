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
		$this->view->data['headers'] = $this->mapper->getFriendlyNames();

	}

	function setListDataRows()
	{
		$results = $this->mapper->findAll(); 

		$this->view->data['results'] = $results;
	}

	public function getView($action, $template)
	{
		$view;
		switch ($action) {
			case 'index':
				$this->setListDataHeaders();
				$this->setListDataRows();
				$view = $this->view;
				require($template);
				break;
			
			default:
				# code...
				break;
		} 
	}
}