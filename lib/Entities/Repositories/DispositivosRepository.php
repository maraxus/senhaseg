<?php
namespace Entities\Repositories;
use Database\StorageMapper;
use Entity\Dispositivo;
 /**
 * A Repository for the 'Dispositivo' entity. This class returns aggregates from storage and most
 * Querying job goes here. It's a interface between client services and entities with entity's persistence
 * Layer.
 */
 class DispositivosRepository
 {
 	
 	private $storage, $relationships;

 	function __construct(StorageMapper $mapper)
 	{
 		$this->mapper = $storage;
 		$this->relationships = $this->mapper->getRelations();
 	}

 	protected function createNewFromState()
 	{
 		return Dispositivo::fromState();
 	}

 	function createNewDispositivo(Array $state) 
 	{
 		$new = createNewFromState($tate);
 		if ($new->isValid()) {
	 		$this->storage->insert($new);
	 		return true;
 		}
 		return false;
 	}
 }