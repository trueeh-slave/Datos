<?php
global $conexion;
require_once("../util/usage.php");

$doc = "SELECT * FROM tipo_documento;";
$resultDoc = mysqli_query($conexion, $doc);

$ciudad = 'SELECT * FROM ciudad;';
$resultCiudad = mysqli_query($conexion, $ciudad);

//editar
$docEdit = "SELECT * FROM tipo_documento;";
$resultDocEdit = mysqli_query($conexion, $doc);

$ciudadEdit = 'SELECT * FROM ciudad;';
$resultCiudadEdit = mysqli_query($conexion, $ciudadEdit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Recaudo</title>
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
                <h5 class="modal-title">Agregar Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-user-form" class="p-2" novalidate>
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <input type="text" name="nident" class="form-control form-control-lg" placeholder="Identificación" required>
                            <div class="invalid-feedback">Identificación Obligatoria</div>
                        </div>

                        <div class="col">
                            <select name="tipoDoc" id="" class="form-select form-control-lg" aria-label="Default select example" required>
                                <?php while ($row = mysqli_fetch_assoc($resultDoc)) { ?>
                                    <option value="<?php echo $row['ID_DOCUMENTO']; ?>"><?php echo $row['NOMBRE_DOCUMENTO']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">Tipo de documento obligatorio.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="papellido" class="form-control form-control-lg" placeholder="Primer Apellido" required>
                        <div class="invalid-feedback">Apellido obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="sapellido" class="form-control form-control-lg" placeholder="Segundo Apellido" required>
                        <div class="invalid-feedback">Apellido obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="pnombre" class="form-control form-control-lg" placeholder="Primer Nombre" required>
                        <div class="invalid-feedback">Nombre obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="snombre" class="form-control form-control-lg" placeholder="Segundo Nombre">
                    </div>

                    <div class="mb-3">
                        <select name="ciudad" id="" class="form-select form-control-lg" aria-label="Default select example" required>
                            <?php while ($row = mysqli_fetch_assoc($resultCiudad)) { ?>
                                <option value="<?php echo $row['ID_CIUDAD']; ?>"><?php echo $row['NOMBRE_CIUDAD']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">Ciudad Obligatoria.</div>
                    </div>

                    <div class="mb-3">
                        <input type="date" name="fechaNacimiento" class="form-control form-control-lg" required>
                        <div class="invalid-feedback">La fecha es requerida!</div>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
                        <div class="invalid-feedback">Email obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="number" name="ingreso" class="form-control form-control-lg" placeholder="Ingreso Mensual" required>
                        <div class="invalid-feedback">Ingreso Mensual obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="number" name="telefono" class="form-control form-control-lg" placeholder="Teléfono" required>
                        <div class="invalid-feedback">Teléfono obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Agregar Cliente" class="btn btn-primary btn-block btn-lg" id="add-user-btn">
                    </div>
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
                <h5 class="modal-title">Editar cliente</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-user-form" class="p-2" novalidate>
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <select name="tipoDoc" id="tipoDoc" class="form-select form-control-lg" aria-label="Default select example" required>
                                <?php while ($row = mysqli_fetch_assoc($resultDocEdit)) { ?>
                                    <option value="<?php echo $row['ID_DOCUMENTO']; ?>"><?php echo $row['NOMBRE_DOCUMENTO']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">Tipo de documento obligatorio.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="papellido" id="papellido" class="form-control form-control-lg" placeholder="Primer Apellido" required>
                        <div class="invalid-feedback">Apellido obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="sapellido" id="sapellido" class="form-control form-control-lg" placeholder="Segundo Apellido" required>
                        <div class="invalid-feedback">Apellido obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="pnombre" id="pnombre" class="form-control form-control-lg" placeholder="Primer Nombre" required>
                        <div class="invalid-feedback">Nombre obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="snombre" id="snombre" class="form-control form-control-lg" placeholder="Segundo Nombre">
                    </div>

                    <div class="mb-3">
                        <select name="ciudad" id="ciudad" class="form-select form-control-lg" aria-label="Default select example" required>
                            <?php while ($row = mysqli_fetch_assoc($resultCiudadEdit)) { ?>
                                <option value="<?php echo $row['ID_CIUDAD']; ?>"><?php echo $row['NOMBRE_CIUDAD']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">Ciudad Obligatoria.</div>
                    </div>

                    <div class="mb-3">
                        <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control form-control-lg" required>
                        <div class="invalid-feedback">La fecha es requerida!</div>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Email" required>
                        <div class="invalid-feedback">Email obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="number" name="ingreso" id="ingreso" class="form-control form-control-lg" placeholder="Ingreso Mensual" required>
                        <div class="invalid-feedback">Ingreso Mensual obligatorio.</div>
                    </div>

                    <div class="mb-3">
                        <input type="number" name="telefono" id="telefono" class="form-control form-control-lg" placeholder="Teléfono" required>
                        <div class="invalid-feedback">Teléfono obligatorio.</div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Actualizar Cliente" class="btn btn-success btn-block btn-lg" id="edit-user-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit User Modal End -->
<div class="container w-100">
    <div class="row mt-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="text-primary">Clientes Registrados</h4>
            </div>
            <div>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewUserModal">Add New User</button>
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
            <div class="table-responsive" style="max-width: 100% !important;">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th>ID Cliente</th>
                        <th>Identificación</th>
                        <th>Tipo Documento</th>
                        <th>Primer Apellido</th>
                        <th>Segundo Apellido</th>
                        <th>Primer nombre</th>
                        <th>Segundo nombre </th>
                        <th>Ciudad</th>
                        <th>Fecha nacimiento</th>
                        <th>Correo</th>
                        <th>Ingreso</th>
                        <th>Teléfono</th>
                        <th>Saldo</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                        <td>ID Cliente</td>
                        <td>Identificación</td>
                        <td>Tipo Documento</td>
                        <td>Primer Apellido</td>
                        <td>Segundo Apellido</td>
                        <td>Ciudad</td>
                        <td>Fecha Nacimiento </td>
                        <td>Correo</td>
                        <td>Ingreso Mensual</td>
                        <td>Teléfono</td>
                        <td>Saldo Pendiente</td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm rounded-pill py-0">Editar</a>
                            <a href="#" class="btn btn-danger btn-sm rounded-pill py-0">Eliminar</a>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    const addForm = document.getElementById("add-user-form");
    const updateForm = document.getElementById("edit-user-form");
    const showAlert = document.getElementById("showAlert");
    const addModal = new bootstrap.Modal(document.getElementById("addNewUserModal"));
    const editModal = new bootstrap.Modal(document.getElementById("editUserModal"));
    const tbody = document.querySelector("tbody");

    const addform1 = document.getElementById('add-user-form');

    //añadir nuevo pago con un jax request
    addform1.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(addform1);
        formData.append("add", 1);

        if (addform1.checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
            addform1.classList.add("was-validated");
            return false;
        } else {
            document.getElementById("add-user-btn").value = "Please Wait...";

            const data = await fetch("../util/action.php", {
                method: "POST",
                body: formData,
            });
            const response = await data.text();
            showAlert.innerHTML = response;
            document.getElementById("add-user-btn").value = "Agregar Cliente";
            addform1.reset();
            addform1.classList.remove("was-validated");
            addModal.hide();
            fetchAllUsers();
        }
    });

    const fetchAllUsers = async () => {
        const data = await fetch("../util/action.php?read=1", {
            method: "GET",
        });
        const response = await data.text();
        tbody.innerHTML = response;
    };
    fetchAllUsers();

    // Edit User Ajax Request
    tbody.addEventListener("click", (e) => {
        if (e.target && e.target.matches("a.editLink")) {
            e.preventDefault();
            let id = e.target.getAttribute("id");
            editUser(id);
        }
    });

    const editUser = async (id) => {
        const data = await fetch(`../util/action.php?edit=1&id=${id}`, {
            method: "GET",
        });
        const response = await data.json();
        document.getElementById("id").value = response.ID_CLIENTE;
        document.getElementById("tipoDoc").value = response.NOMBRE_DOCUMENTO;
        document.getElementById("papellido").value = response.PAPELLIDO_CLIENTE;
        document.getElementById("sapellido").value = response.SAPELLIDO_CLIENTE;
        document.getElementById("pnombre").value = response.PNOMBRE_CLIENTE;
        document.getElementById("snombre").value = response.SNOMBRE_CLIENTE;
        document.getElementById("ciudad").value = response.NOMBRE_CIUDAD;
        document.getElementById("fechaNacimiento").value = response.FECHA_NACIMIENTO;
        document.getElementById("email").value = response.CORREO_ELECTRONICO;
        document.getElementById("ingreso").value = response.INGRESO_MENSUAL;
        document.getElementById("telefono").value = response.TELEFONO_CLIENTE;
    };

    // Update User Ajax Request
    updateForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(updateForm);
        formData.append("update", 1);

        if (updateForm.checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
            updateForm.classList.add("was-validated");
            return false;
        } else {
            document.getElementById("edit-user-btn").value = "Please Wait...";

            const data = await fetch("../util/action.php", {
                method: "POST",
                body: formData,
            });
            const response = await data.text();
            showAlert.innerHTML = response;
            document.getElementById("edit-user-btn").value = "Add User";
            updateForm.reset();
            updateForm.classList.remove("was-validated");
            editModal.hide();
            fetchAllUsers();
        }
    });

    // Delete User Ajax Request
    tbody.addEventListener("click", (e) => {
        if (e.target && e.target.matches("a.deleteLink")) {
            e.preventDefault();
            let id = e.target.getAttribute("id");
            deleteUser(id);
        }
    });

    const deleteUser = async (id) => {
        const data = await fetch(`../util/action.php?delete=1&id=${id}`, {
            method: "POST",
        });
        const response = await data.text();
        showAlert.innerHTML = response;
        fetchAllUsers();
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>