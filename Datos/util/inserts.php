<?php

require_once 'conexion.php';

class Inserts extends Config
{
    public function insertCliente($cedula, $tipo_cedula, $papellido, $sapellido, $pnombre, $snombre, $ciudad, $fecha, $email, $ingreso, $telefono)
    {
        $conexion = mysqli_connect("localhost", "root", "", "constructora_3corte");

        if (!$conexion) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
        }

        $query = "CALL insertClient(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssss", $cedula, $tipo_cedula, $papellido, $sapellido, $pnombre, $snombre, $ciudad, $fecha, $email, $ingreso, $telefono);

        mysqli_stmt_execute($stmt);

        $filasAfectadas = mysqli_affected_rows($conexion);

        mysqli_close($conexion);

        return $filasAfectadas > 0;
    }

    public function read()
    {
        $sql = 'SELECT * FROM TABLA_CLIENTE ORDER BY id_cliente DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Fetch Single User From Database
    public function readOne($id)
    {
        $sql = 'SELECT * FROM TABLA_CLIENTE WHERE id_cliente = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result;
    }

    // Update Single User
    public function update($id, $tipo_cedula, $papellido, $sapellido, $pnombre, $snombre, $ciudad, $fecha, $email, $ingreso, $telefono)
    {
        $conexion = mysqli_connect("localhost", "root", "", "constructora_3corte");

        if (!$conexion) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
        }

        $query = "CALL editClient(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssss", $tipo_cedula, $papellido, $sapellido, $pnombre, $snombre, $ciudad, $fecha, $email, $ingreso, $telefono, $id);

        mysqli_stmt_execute($stmt);

        $filasAfectadas = mysqli_affected_rows($conexion);

        mysqli_close($conexion);

        return $filasAfectadas > 0;
    }

    //Delete user from database
    public function delete($id)
    {
        $sql = 'CALL deleteClient(:id)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    public function insertPay($idCliente, $idInmueble, $valor, $tipoDoc)
    {
        $conexion = mysqli_connect("localhost", "root", "", "constructora_3corte");

        if (!$conexion) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
        }

        $query = "CALL addPay(?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $idCliente, $idInmueble, $valor, $tipoDoc);

        mysqli_stmt_execute($stmt);

        $filasAfectadas = mysqli_affected_rows($conexion);

        mysqli_close($conexion);

        return $filasAfectadas > 0;
    }

    public function readPay()
    {
        $sql = 'SELECT * FROM PAGOS';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}





