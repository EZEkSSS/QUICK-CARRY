<?php
include_once '../Modelo/modelo.php';

class PaqueteController extends Database {
    public function getEstadoPaquete($id_paquete) {
        $sql = "SELECT estado, peso, tamaño, tipo_entrega, departamento_destinatario, ciudad_destinatario
        FROM PAQUETE
        WHERE id_paquete = $id_paquete;
        ";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row; // Devolver el array asociativo con la información del paquete
        } else {
            return ["error" => "No existe el paquete con el ID $id_paquete"];
        }
    }
}

?>