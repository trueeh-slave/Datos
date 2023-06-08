<?php
global $conexion;
require_once("../util/usage.php");

$query = "SELECT * FROM reporte_deuda_repartida;";
$result = mysqli_query($conexion, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Cartera</title>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php include 'navbar.php'; ?>

<center>
    <div class="contenedor">
        <div id="bd">
            <input type="button" onclick="exportTableToExcel('reporte','reporteDeudaProyectoCliente')" value="Generar Excel" class="btn btn-success mt-3" > <br>
            <table class="table table-striped table-bordered text-center  w-75 mt-3" id="reporte">
                <thead>
                <th scope="col">Nombre proyecto</th>
                <th scope="col">Número identificación</th>
                <th scope="col">Primer nombre cliente</th>
                <th scope="col">Primer apellido cliente</th>
                <th scope="col">Deuda total</th>
                </thead>
                <tbody>
                <?php
                $contador = 0;
                while ($proyecto = mysqli_fetch_array($result)) {
                    $contador++ ?>
                    <tr>
                        <td scope="row"><?php echo $proyecto['NOMBRE_PROYECTO']; ?></td>
                        <td scope="row"><?php echo $proyecto['NUM_IDENTIFICACION']; ?></td>
                        <td scope="row"><?php echo $proyecto['PNOMBRE_CLIENTE']; ?></td>
                        <td scope="row"><?php echo $proyecto['PAPELLIDO_CLIENTE']; ?></td>
                        <td scope="row"><?php echo $proyecto['DEUDA_TOTAL']; ?></td>
                    </tr>
                <?php }
                echo "La cantidad de registros en la base de datos son: " . $contador; ?>
                </tbody>
            </table>
        </div>
    </div>
</center>
</center>

<script>
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>