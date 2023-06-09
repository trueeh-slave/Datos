<?php
global $conexion;
require_once("../util/usage.php");

$queryTp = "SELECT * FROM tipo_pago WHERE ESTADO = 'A';";
$resultTp = mysqli_query($conexion, $queryTp);

$queryCli = "SELECT * FROM cliente";
$resultCli = mysqli_query($conexion, $queryCli);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Reacaudo</title>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
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
                <form id="add-user-form" class="p-2" novalidate>
                    <div class="row mb-3 gx-3">

                        <div class="col">
                            <!--Cliente dueño del inmueble-->
                            <select name="idCliente" id="cliente"
                                    class="form-select form-control-lg source_dependent_select"
                                    aria-label="Default select example" required>
                                ' <?php while ($row = mysqli_fetch_assoc($resultCli)) { ?>
                                    <option value="<?php echo $row['ID_CLIENTE']; ?>"><?php echo $row['PNOMBRE_CLIENTE']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col" id="selectInmueble">

                        </div>

                    </div>

                    <div class="mb-3">
                        <!--Valor a recaudar-->
                        <div class="mb-3">
                            <input type="number" pattern="[0-9]{10}" name="valorRecaudo"
                                   class="form-control form-control-lg" placeholder="Ingresa el valor" required>
                            <div class="invalid-feedback">Valor del recaudo obligatorio</div>
                        </div>

                        <!--Tipo de pago de cómo se va a realizar un pago-->
                        <div class="col">
                            <select name="idPago" onchange="mostrarInput()" id="tpago" class="form-select" aria-label="Default select example">
                                <?php while ($row = mysqli_fetch_assoc($resultTp)) { ?>
                                    <option value="<?php echo $row['ID']; ?>"><?php echo $row['NOMBRE']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="invalid-feedback">Tipo de pago requerido!</div>

                        <div class="mb-3" style="display: none;" id="divNt">
                            <input type="number" id="numTar" pattern="[0-9]{10}" name="numTarjeta"
                                   class="form-control form-control-lg mt-2" placeholder="Ingresa el número tarjeta">
                        </div>

                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Añadir pago" class="btn btn-primary btn-block btn-lg"
                               id="add-user-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add New User Modal End -->
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="text-primary">Pagos de los usuarios!</h4>
            </div>
            <div>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewUserModal">Añadir
                    nuevo pago
                </button>
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
                    <th>Id</th>
                    <th>Id cliente</th>
                    <th>Id inmueble</th>
                    <th>Valor recaudo</th>
                    <th>Fecha negociación</th>
                    <th>Tipo pago</th>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script>
    const addForm = document.getElementById("add-user-form");
    const showAlert = document.getElementById("showAlert");
    const addModal = new bootstrap.Modal(document.getElementById("addNewUserModal"));
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

            const data = await fetch("../util/actionPago.php", {
                method: "POST",
                body: formData,
            });
            const response = await data.text();
            showAlert.innerHTML = response;
            document.getElementById("add-user-btn").value = "Añadir pago";
            addform1.reset();
            addform1.classList.remove("was-validated");
            addModal.hide();
            fetchAllUsers();
        }
    });

    const fetchAllUsers = async () => {
        const data = await fetch("../util/actionPago.php?read=1", {
            method: "GET",
        });
        const response = await data.text();
        tbody.innerHTML = response;
    };
    fetchAllUsers();
</script>

<script>
    function mostrarInput() {
        var selectElement = document.getElementById("tpago");
        var campoInput = document.getElementById("divNt");
        var inputTexto = document.getElementById("numTar");

        if (selectElement.value === "1") {
            campoInput.style.display = "block";
            inputTexto.required = false;
        } else {
            campoInput.style.display = "none";
            inputTexto.required = false;
        }
    }

</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#cliente').val();
        recargarLista();

        $('#cliente').change(function () {
            recargarLista();
        });
    })
</script>

<script type="text/javascript">
    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "../util/select.php",
            data: "clientes=" + $('#cliente').val(),
            success: function (r) {
                $('#selectInmueble').html(r);
            }
        });
    }
</script>
</body>

</html>