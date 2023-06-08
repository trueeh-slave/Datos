<?php

require_once 'inserts.php';
require_once 'funciones.php';

$inserts = new Inserts;
$funciones = new Funcion();

if(isset($_POST['add'])) {
    $cliente = $funciones->testInput($_POST['idCliente']);
    $inmueble = $funciones->testInput($_POST['idInmueble']);
    $valor = $funciones->testInput($_POST['valorRecaudo']);
    $pago = $funciones->testInput($_POST['idPago']);

    if($inserts->insertPay($cliente,$inmueble,$valor,$pago)){
        echo $funciones->showMessage('success', 'Se ha agregado el pago correctamente');
    } else {
        echo $funciones->showMessage('danger', 'Surgió un error, intentelo denuevo.');
    }
}

if (isset($_GET['read'])) {
    $users = $inserts->readPay();
    $output = '';
    if ($users) {
        foreach ($users as $row) {
            $output .= '<tr>
                      <td>' . $row['ID_RECAUDO'] . '</td>
                      <td>' . $row['ID_CLIENTE_RECAUDO'] . '</td>
                      <td>' . $row['ID_INMUEBLE_RECAUDO'] . '</td>
                      <td>' . $row['VALOR_RECAUDO'] . '</td>
                      <td>' . $row['FECHA_NEGOCIACION'] . '</td>
                      <td>' . $row['NOMBRE'] . '</td>
                    </tr>';
        }
        echo $output;
    } else {
        echo '<tr>
              <td colspan="6">No Users Found in the Database!</td>
            </tr>';
    }
}