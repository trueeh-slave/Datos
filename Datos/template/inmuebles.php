<?php
global $conexion;
require_once("../util/usage.php");

$query = "SELECT * FROM tabla_inmuebles;";
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
            <input type="button" onclick="exportTableToExcel('reporte','ReporteInmueble')" value="Generar Excel" class="btn btn-success mt-3" > <br>
            <table class="table table-striped table-bordered text-center  w-75 mt-3" id="reporte">
                <thead>
                <th scope="col">id</th>
                <th scope="col">Nombre_proyecto</th>
                <th scope="col">Número torre</th>
                <th scope="col">Número inmueble</th>
                <th scope="col">Id_cliente</th>
                <th scope="col">Precio Venta</th>
                <th scope="col">Costo adicional</th>
                <th scope="col">Fecha negociación</th>
                <th scope="col">Valor Separación</th>
                <th scope="col">Número cuotas</th>
                <th scope="col">Saldo inmueble</th>
                <th scope="col">Valor cuota</th>
                <th scope="col">Estado</th>
                </thead>
                <tbody>
                <?php
                $contador = 0;
                while ($inmueble = mysqli_fetch_array($result)) {
                    $contador++ ?>
                    <tr>
                        <td scope="row"><?php echo $inmueble['ID_INMUEBLE']; ?></td>
                        <td scope="row"><?php echo $inmueble['NOMBRE_PROYECTO']; ?></td>
                        <td scope="row"><?php echo $inmueble['NUM_TORRE']; ?></td>
                        <td scope="row"><?php echo $inmueble['NUM_INMUEBLE']; ?></td>
                        <td scope="row"><?php echo $inmueble['ID_CLIENTE']; ?></td>
                        <td scope="row"><?php echo $inmueble['PRECIO_VENTA']; ?></td>
                        <td scope="row"><?php echo $inmueble['COSTO_ADICIONAL']; ?></td>
                        <td scope="row"><?php echo $inmueble['FECHA_NEGOCIACION']; ?></td>
                        <td scope="row"><?php echo $inmueble['VALOR_SEPARACION']; ?></td>
                        <td scope="row"><?php echo $inmueble['NUM_CUOTAS']; ?></td>
                        <td scope="row"><?php echo $inmueble['SALDO_INMUEBLE']; ?></td>
                        <td scope="row"><?php echo $inmueble['VALOR_CUOTA']; ?></td>
                        <td scope="row"><?php echo $inmueble['ESTADO_INMUEBLE']; ?></td>
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

</html>