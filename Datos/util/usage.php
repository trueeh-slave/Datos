<?php

$conexion = new mysqli("localhost", "root", "", "constructora_3corte");
if ($conexion->connect_errno) {
    /*echo "Fallo al conectar a MySQL";*/
}else{
    /*echo "La conexión ha sido exitosa";*/
}