<?php

$bd_config = array(
  'baseDatos' =>'pruebas',
  'usuario'=>'root',
  'pass'=>'Mysql123*'
);

function conexion($bd_config){
  try{
	  $conexion=new PDO('mysql:host=localhost;dbname='.$bd_config['baseDatos'],$bd_config['usuario'],$bd_config['pass']);
	  return $conexion;
  }
  catch(PDOException $ex){
    return false;
  }
}

$conexion=conexion($bd_config);
if(!$conexion){
	echo 'no hay conexion';
}



if($_SERVER['REQUEST_METHOD']== 'POST'){
	$id = $_POST["id"];
	$unombre = $_POST["uname"];
	$nombre = $_POST["name"];
	$loca = $_POST["location"];
	$tw = $_POST["tw"];
	$fecha3 = $_POST["fecha3"];
	
	$id = str_replace("'","",$id);
	$unombre = str_replace("'","",$unombre);
	$nombre = str_replace("'","",$nombre);
	$loca = str_replace("'","",$loca);
	$tw = str_replace("'","",$tw);
	$fecha3 = str_replace("'","",$fecha3);
	
	$id = str_replace("\\","",$id);
	$unombre = str_replace("\\","",$unombre);
	$nombre = str_replace("\\","",$nombre);
	$loca = str_replace("\\","",$loca);
	$tw = str_replace("\\","",$tw);
	$fecha3 = str_replace("\\","",$fecha3);
	
	$id = str_replace("/","",$id);
	$unombre = str_replace("/","",$unombre);
	$nombre = str_replace("/","",$nombre);
	$loca = str_replace("/","",$loca);
	$tw = str_replace("/","",$tw);
	$fecha3 = str_replace("/","",$fecha3);
	
	/*$todo = "CALL sp_insertaData('$id','$unombre','$nombre','$loca','$tw','$fecha3')";
	echo $todo;*/
	$statement=$conexion->query("CALL sp_insertaData('$id','$unombre','$nombre','$loca','$tw','$fecha3')");
    $statement=$statement->fetchAll();
	return ($statement) ? $statement : false;
	
}



?>
