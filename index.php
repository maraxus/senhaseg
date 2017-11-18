
<?php 
require('bootstrap.php');
require('templates/shared/header.php');
?>

<div class="card-header">
	<h4>Dispositivos</h4>
</div>
<div class="card-body">
	<?php 
	$conn = \Database\PDOConnection::fromConfig(array(
		'dsn' => 'mysql:host=localhost;dbname=senhaseg_dispositivos',
		'user' => 'maraxus',
		'pass' => 'charlote'
	));
	$mapper = new \Database\Mappers\DispositivoPDOMapper($conn, \Entity\Dispositivo::class);
	$view = new \View\Dispositivo\Index();
	$entity = \Entity\Dispositivo::fromState(array(
		'hostname'=>'www.netflix.com',
		'ip'=>'39.9.222.53',
		'idTipo'=>3,
		'fabricante'=>'Cisco',
		'modelo'=>'DER4-7665',
		true,
	));
	$controller = new \Controller\DispositivoController($entity, $view, $mapper);
	$view = $controller->getView();
	require('templates/index/list.php'); ?>
</div>
<?php
require('templates/shared/footer.php');
?>