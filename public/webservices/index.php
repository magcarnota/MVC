<?php
$config="../../application/configs/config.ini";
$config=parse_ini_file($config,true);
$config=$config['production'];
$_SESSION['register']['config']=$config;

include_once '../../application/models/users/users.php';
include_once '../../application/models/dataGatewayMysql.php';
models_dataGatewayMysql::newInstance();
$users = new models_users_users();

echo "<pre>";
print_r($users->readUsers());
echo "</pre>";
