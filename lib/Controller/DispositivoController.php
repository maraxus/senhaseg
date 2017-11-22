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
		$headers = $this->mapper->getFriendlyNames();
		$headers = array_filter($headers, function($header) {
			if($this->mapper->isRelated($header)) {
				return false;
			}
			return true;
		}, ARRAY_FILTER_USE_KEY);
		$this->view->data['headers'] = $headers; 

	}

	function setListDataRows()
	{
		$results = $this->mapper->findWithRelated('tipo'); 
		//echo var_dump($results);
		$this->view->data['results'] = $results;
	}

	public function handleAction($action, $template)
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