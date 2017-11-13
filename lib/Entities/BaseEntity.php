<?php
namespace Entity;

/**
 * these constants can be used to designate relationship type in
 * in the relationship array eg.: $relationships[constant('BELONGS_TO')]
 **/
define('HAS_ONE','has_one');
define('HAS_MANY','has_many');
define('BELONGS_TO','belongs_to');
define('BELONGS_TO_MANY','belongs_to_many');

/**
* Provides basic common functionality for Entities
*/
class BaseEntity
{

	protected function __construct()
	{
		# code...
	}

}