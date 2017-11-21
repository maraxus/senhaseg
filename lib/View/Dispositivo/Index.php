<?php
namespace View\Dispositivo;
use View\View;
/**
* 
*/
class Index extends View
{
	public function renderHeaders()
	{
		foreach ($this->data['headers'] as $identifier => $label){
      		echo '<th scope="col" class="text-capitalize">'. $label .'</th>';
      	}
	}

	/**
	 * Check if the string corresponds to a property identifier included in the list headers
	 * @param string $str the string to be checked
	 * @return bool
	 */
	public function isInHeaders($str)
	{
		$headers = array_keys($this->data['headers']);
		if (in_array($str, $headers)) {
			return true;
		}
		return false;
	}

	public function mapColumnValues($entity)
	{
		
		$reflector = new ReflectionClass($entity);

	}

	public function renderLines($lineHeader = "") 
	{
		foreach ($this->data['results'] as $dispositivo){
			echo '<tr>';
			$columns = $dispositivo->toArray();
			foreach ($columns as $column => $value) {
				if ($this->isInHeaders($column)) {
					if ($lineHeader == $column) {
						echo '<th scope="row">'.$value."</th>";
					} else {
						echo '<td>'. $value .'</td>';
					}
				}
			}
			echo '</tr>';
      	}	
	}
}