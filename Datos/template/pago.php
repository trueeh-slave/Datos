<?php
global $conexion;
require_once("../util/usage.php");

$query = "SELECT * FROM cliente;";
$result = mysqli_query($conexion, $query);

$queryInm = "SELECT * FROM inmueble;";
$resultInm = mysqli_query($conexion, $queryInm);

$queryTp = "SELECT * FROM tipo_pago;";
$resultTp = mysqli_query($conexion, $queryTp);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Reacaudo</title>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php include 'navbar.php'; ?>


<!-- Add New User Modal Start -->
<div class="modal fade" tabindex="-1" id="addNewUserModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir nuevo pago</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="addPay" class="p-2" novalidate>
                    <div class="row mb-3 gx-3">

                        <div class="col">
                            <!--Cliente dueño del inmueble-->
                            <select name="idCliente" id="cliente" class="form-select" aria-label="Default select example">
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?php echo $row['ID_CLIENTE']; ?>"><?php echo $row['PNOMBRE_CLIENTE']; ?></option>
                                <?php } ?>
                            </select>

                            <div class="invalid-feedback">El cliente es requerido!</div>
                        </div>

                        <div class="col">

                            <!--Inmueble al que se realiza el pago-->
                            <select name="idInmueble" id="inmueble" class="form-select" aria-label="Default select example">

                                <option selected>Inmueble</option>
                                <?php while ($row = mysqli_fetch_assoc($resultInm)) { ?>
                                    <option value="<?php echo $row['ID_INMUEBLE']; ?>"><?php echo $row['ID_INMUEBLE']; ?></option>
                                <?php } ?>
                            </select>

                            <div class="invalid-feedback">El inmueble es requerido!</div>
                        </div>

                    </div>

                    <!--<div class="mb-3">
                      <input type="date" name="fechaNego" class="form-control form-control-lg" required>
                      <div class="invalid-feedback">La fecha es requerida!</div>
                    </div>-->

                    <div class="mb-3">

                        <!--Valor a recaudar-->
                        <div class="mb-3">
                            <input type="text" pattern="[0-9]{10}" name="valorRecuado" class="form-control form-control-lg" placeholder="Ingresa el valor" required>
                            <div class="invalid-feedback">El valor de recaudo es necesario!</div>
                        </div>

                        <!--Tipo de pago de cómo se va a realizar un pago-->
                        <select name="idPago" id="" class="form-select"  aria-label="Default select example">
                            <?php while ($row = mysqli_fetch_assoc($resultTp)) { ?>
                                <option value="<?php echo $row['ID']; ?>"><?php echo $row['NOMBRE']; ?></option>
                            <?php } ?>
                        </select>

                        <div class="invalid-feedback">Tipo de pago requerido!</div>
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Añadir pago" class="btn btn-primary btn-block btn-lg" id="add-pay-btn">
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- Add New User Modal End -->

<!-- Edit User Modal Start -->
<div class="modal fade" tabindex="-1" id="editUserModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new user</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-user-form" class="p-2" novalidate>
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <input type="text" name="fname" id="fname" class="form-control form-control-lg" placeholder="Enter First Name" required>
                            <div class="invalid-feedback">First name is required!</div>
                        </div>

                        <div class="col">
                            <input type="text" name="lname" id="lname" class="form-control form-control-lg" placeholder="Enter Last Name" required>
                            <div class="invalid-feedback">Last name is required!</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Enter E-mail" required>
                        <div class="invalid-feedback">E-mail is required!</div>
                    </div>

                    <div class="mb-3">
                        <input type="tel" name="phone" id="phone" class="form-control form-control-lg" placeholder="Enter Phone" required>
                        <div class="invalid-feedback">Phone is required!</div>
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Update User" class="btn btn-success btn-block btn-lg" id="edit-user-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit User Modal End -->
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="text-primary">Pagos de los usuarios!</h4>
            </div>
            <div>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewUserModal">Añadir nuevo pago</button>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div id="showAlert"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Id cliente</th>
                        <th>Id inmueble</th>
                        <th>Valor recaudo</th>
                        <th>Fecha negociación</th>
                        <th>Tipo pago</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="../js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>