<?php
global $conexion;
session_start();
require_once("usage.php");

$nombre = $_POST['username'];
$password = $_POST['password'];

$consulta ="SELECT * FROM user WHERE username = '$nombre' AND pass = '$password'";
$res=mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($res);

if ($filas>0) {
    header("location: ../template/cliente.php");
} else{
    echo "<script>";
    echo "alert('La información no es válida');";
    echo "window.location.href = '../index.php';";
    echo "</script>";
}
mysqli_free_result($res);
mysqli_close($conexion);
?>
