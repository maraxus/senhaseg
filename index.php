
<?php 
require('bootstrap.php');
require('templates/shared/header.php');
?>

<div class="card-header">
	<h4>Dispositivos</h4>
</div>
<div class="card-body">
	<?php
	$driver = \Database\PDOConnection::fromConfig(array(
		'dsn' => 'mysql:host=localhost;dbname=senhaseg_dispositivos',
		'user'=>'maraxus',
		'pass'=>'charlote'
	));
	$rows = $driver->findById(1);
	$driver->insert($rows);
	?>
</div>
<?php
require('templates/shared/footer.php');
?>