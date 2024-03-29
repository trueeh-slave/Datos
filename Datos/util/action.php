<?php

require_once 'inserts.php';
require_once 'funciones.php';

$inserts = new Inserts;
$funciones = new Funcion();

if(isset($_POST['add'])) {
    $identificacion = $funciones->testInput($_POST['nident']);
    $tipoDoc = $funciones->testInput($_POST['tipoDoc']);
    $papellido = $funciones->testInput($_POST['papellido']);
    $sapellido = $funciones->testInput($_POST['sapellido']);
    $pnombre = $funciones->testInput($_POST['pnombre']);
    $snombre = $funciones->testInput($_POST['snombre']);
    $ciudad = $funciones->testInput($_POST['ciudad']);
    $fechaCum = $funciones->testInput($_POST['fechaNacimiento']);
    $email = $funciones->testInput($_POST['email']);
    $ingreso = $funciones->testInput($_POST['ingreso']);
    $telefono = $funciones->testInput($_POST['telefono']);

    if($inserts->insertCliente($identificacion, $tipoDoc, $papellido, $sapellido, $pnombre, $snombre, $ciudad, $fechaCum,$email,$ingreso,$telefono)){
        echo $funciones->showMessage('success', 'Se ha agregado al cliente correctamente');
    } else {
        echo $funciones->showMessage('danger', 'Surgió un error, intentelo denuevo.');
    }
}

if (isset($_GET['read'])) {
    $users = $inserts->read();
    $output = '';
    if ($users) {
        foreach ($users as $row) {
            $output .= '<tr>
                      <td>' . $row['ID_CLIENTE'] . '</td>
                      <td>' . $row['NUM_IDENTIFICACION'] . '</td>
                      <td>' . $row['NOMBRE_DOCUMENTO'] . '</td>
                      <td>' . $row['PAPELLIDO_CLIENTE'] . '</td>
                      <td>' . $row['PNOMBRE_CLIENTE'] . '</td>
                      <td>' . $row['NOMBRE_CIUDAD'] . '</td>
                      <td>' . $row['CORREO_ELECTRONICO'] . '</td>
                      <td>' . $row['INGRESO_MENSUAL'] . '</td>
                      <td>' . $row['TELEFONO_CLIENTE'] . '</td>
                      <td>' . $row['SALDO'] . '</td>
                      <td>
                        <a href="#" id="' . $row['ID_CLIENTE'] . '" class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal">Edit</a>

                        <a href="#" id="' . $row['ID_CLIENTE'] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Delete</a>
                      </td>
                    </tr>';
        }
        echo $output;
    } else {
        echo '<tr>
              <td colspan="6">No Users Found in the Database!</td>
            </tr>';
    }
}


// Handle Edit User Ajax Request
if (isset($_GET['edit'])) {
    $id = $_GET['id'];

    $user = $inserts->readOne($id);
    echo json_encode($user);
}

// Handle Update User Ajax Request
if (isset($_POST['update'])) {
    $id = $funciones->testInput($_POST['id']);
    $tipoDoc = $funciones->testInput($_POST['tipoDoc']);
    $papellido = $funciones->testInput($_POST['papellido']);
    $sapellido = $funciones->testInput($_POST['sapellido']);
    $pnombre = $funciones->testInput($_POST['pnombre']);
    $snombre = $funciones->testInput($_POST['snombre']);
    $ciudad = $funciones->testInput($_POST['ciudad']);
    $fechaCum = $funciones->testInput($_POST['fechaNacimiento']);
    $email = $funciones->testInput($_POST['email']);
    $ingreso = $funciones->testInput($_POST['ingreso']);
    $telefono = $funciones->testInput($_POST['telefono']);

    if ($inserts->update($id,$tipoDoc,$papellido,$sapellido,$pnombre,$snombre,$ciudad,$fechaCum,$email,$ingreso,$telefono)) {
        echo $funciones->showMessage('success', 'Se actualizo el cliente correctamente.');
    } else {
        echo $funciones->showMessage('danger', 'Something went wrong!');
    }
}
//Handle Delete User Ajax Request
if(isset($_GET['delete'])){
    $id = $_GET['id'];

    if($inserts->delete($id)){
        echo $funciones->showMessage('success', 'Se elimino el cliente correctamente');
    } else {
        echo $funciones->showMessage('danger', 'Something went wrong!');
    }
}