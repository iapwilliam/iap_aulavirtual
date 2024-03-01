<?php
$user->setRole($User['perfil']);
$user->setModule($_GET['page']);
if (!$user->allow_access()) {
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}
