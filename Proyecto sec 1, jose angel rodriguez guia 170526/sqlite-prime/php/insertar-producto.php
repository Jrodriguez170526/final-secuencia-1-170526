<?php
include 'vars.php';

if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("Falta insertar el nombre"); 
if (empty($_POST["categoria"])) {
    http_response_code(400);
	exit("falta insertar la categoria"); 
if (empty($_POST["descripcion"])) {
    http_response_code(400);
	exit("falta insertar la descripcion"); 
if (empty($_POST["stock"])) {
    http_response_code(400);
	exit("falta insertar el stock"); 
}
if (empty($_POST["precio"])) {
    http_response_code(400);
	exit("falta insertar el precio"); 
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$producto=[
    "nombre"=> $_POST["nombre"],
    "categoria"=> $_POST["categoria"],
    "descripcion"=> $_POST["descripcion"],
    "stock"=> $_POST["stock"],
    "precio"=> $_POST["precio"]
];
try{
    
    $sentencia = $conex->prepare("insert into productos(nombre, categoria, descripcion, stock, precio) values(:nombre, :categoria, :descripcion, :stock, :precio);");
    $resultado = $sentencia->execute($producto);
    http_response_code(200);
    echo "datos insertados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Lo siento, ocurrió un error:".$exc->getMessage();
}


?>