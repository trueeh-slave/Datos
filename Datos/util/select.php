<?php
global $conexion;
require_once("usage.php");

$inmueble =$_POST['clientes'];
$sql = "SELECT * FROM inmueble WHERE ID_CLIENTE = '$inmueble';";
$result = mysqli_query($conexion,$sql);

$cadena =
    "<select name='idInmueble' id='inmueble' class='form-select form-control-lg target_dependent_select' aria-label='Default select example' required>";
    while ($ver=mysqli_fetch_row($result)) {
        $cadena = $cadena. '<option value='.$ver[0].'>'.utf8_encode($ver[0]).'</option>';
    }

    echo $cadena."</select>";
?>