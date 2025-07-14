<?php
function conn()
{
	$mysqli=new mysqli (DB_HOST, DB_ADMIN_USER, DB_ADMIN_PASS, DB_NAME);
	  $mysqli->query("SET NAMES 'utf8'");
	return $mysqli;
}
function lectura()
{
	$mysqli=new mysqli (DB_HOST, DB_USER, DB_PASS, DB_NAME);
	  $mysqli->query("SET NAMES 'utf8'");
	return $mysqli;
}
function desconectar($mysqli){
	$mysqli->kill($mysqli->thread_id);
	$mysqli->close();	
}
?>