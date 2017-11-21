
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
	$controller = new \Controller\DispositivoController($view, $mapper);
	$controller->handleAction('index','templates/index/list.php'); ?>
</div>
<?php
require('templates/shared/footer.php');
?>