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


        return true;
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
        $sql = 'SELECT * FROM TABLA_CLIENTE WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result;
    }

    // Update Single User
    public function update($cedula, $tipo_cedula, $papellido, $sapellido, $pnombre, $snombre, $ciudad, $fecha, $email, $ingreso, $telefono)
    {
        $sql = 'UPDATE CLIENTE SET  = :fname, last_name = :lname, email = :email, phone = :phone WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'cedula' => $cedula,
            'tcedula' => $tipo_cedula,
            'papellido' => $papellido,
            'sapellido' => $sapellido,
            'pnombre' => $pnombre,
            'snombre' => $snombre,
            'ciudad' => $ciudad,
            'fecha' => $fecha,
            'email' => $email,
            'ingreso' => $ingreso,
            'telefono' => $telefono
        ]);

        return true;
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM cliente WHERE NUM_IDENTIFICACION = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }
}





