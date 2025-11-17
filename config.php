<?php
 include("conexion.php");

class Config {
    private $db;
    public function __construct($conexion) {
        $this->db = $conexion;
    }
    public function SetMail($mail){
        $sql = "UPDATE `config` SET mail = ? ";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $mail);
        mysqli_stmt_execute($stmt);
            if (!mysqli_stmt_execute($stmt)) {
                return false;
            }
            else {
                return true;
            }
    }
    public function GetMail(){
         $sql = "SELECT mail FROM `config` ";    
            $stmt = mysqli_prepare($this->db, $sql);
 
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
    public function SetMontoCuota($montoCuota){
        $sql = "UPDATE `config` SET monto_cuota = ? ";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "d", $montoCuota);
        mysqli_stmt_execute($stmt);
            if (!mysqli_stmt_execute($stmt)) {
                return false;
            }
            else {
                return true;
            }
    }   
   public function GetMontoCuota() {
  
    $sql = "SELECT monto_cuota FROM `config` LIMIT 1";
    $stmt = mysqli_prepare($this->db, $sql);

    if (mysqli_stmt_execute($stmt)) {
        $resultado = mysqli_stmt_get_result($stmt);
        $fila_de_datos = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);

        return $fila_de_datos['monto_cuota'] ?? null;
    } else {
        mysqli_stmt_close($stmt);
        return false; 
    }
}
}
?>