<?php

/*set include path*/
set_include_path(get_include_path(). PATH_SEPARATOR . __DIR__ .'/lib');
require('Entities/BaseEntity.php');
require('Entities/Dispositivo.php');
require('Entities/TipoDispositivo.php');
require('Entities/Repositories/DispositivosRepository.php');
require('Database/StorageDriver.php');
require('Database/PDOConnection.php');
