<?php
 include("conexion.php");

class Pago {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function createPago() 
    {
         $sql = "";    
            $stmt = mysqli_prepare($this->db, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    
        if (mysqli_stmt_execute($stmt)) {    
            $resultado = mysqli_stmt_get_result($stmt);
            $fila_de_datos = mysqli_fetch_assoc($resultado);
            mysqli_stmt_close($stmt);

            return $fila_de_datos; 
        } 
        else {     
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    public function updatePago($id_cuota_socio){

    }
}
 ?>