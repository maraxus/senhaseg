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
abstract class BaseEntity
{

	protected function __construct()
	{
		# code...
	}

	/**
	 * This should return an array with the property identifiers and their friendly names. 
	 * Only for the properties which are meaningful for users, and could get
	 * shown in a view. So ID's for example, shouldn't be included in this list
	 * array['ident'] => 'pretty name';
	 */
	abstract public function getFriendlyNames();

}