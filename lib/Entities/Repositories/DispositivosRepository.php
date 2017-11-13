<?php
namespace Entities\Repositories;
use Database\StorageDriver;
 /**
 * A Repository for the 'Dispositivo' entity. This class returns aggregates from storage and most
 * Querying job goes here. It's a interface between client services and entities with entity's persistence
 * Layer.
 */
 class DispositivosRepository
 {
 	
 	private $mapper;
 	function __construct(StorageMapper $mapper)
 	{
 		$this->mapper = $storage;
 	}

 	function createNewDispositivo(Dispositivo $device) 
 	{
 		if ($device->isValid()) {
	 		$this->storage->insert($device);
	 		return true;
 		}
 		return false;
 	}
 }