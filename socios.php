<?php
 include("conexion.php");

class Socios {
    private $db;
    public function __construct($conexion) {
        $this->db = $conexion;
    }
    public function createSocio($id_usuario) 
    {
        $sql = "UPDATE `usuarios` SET `rol`='socio' WHERE id_usuario = ?;";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_usuario);
        mysqli_stmt_execute($stmt);
    
            if (!mysqli_stmt_execute($stmt)) {
                return false;
            }
            else {
                return true;
            }
    }
    public function getListSocios():array {
        $sql = "SELECT u.id_usuario, u.nombre, u.dni, u.email, s.id_socio, s.estado 
                FROM socios s 
                JOIN usuarios u ON s.id_usuario = u.id_usuario";
        if (!$this->db || $this->db->connect_error) {      
            throw new Exception("Error de conexión a la base de datos en la clase Socios.");
        }
        $result = $this->db->query($sql);
        if ($result) {
            $socios = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $socios[] = $row;
            }
            return $socios;
        } else {
            return [];
        }
    }
    public function getCuota($id_usuario){
        
        $sql = "SELECT cs.* FROM cuotas_socios AS cs 
            JOIN socios AS s ON cs.id_socio = s.id_socio 
            WHERE s.id_usuario = ?;";
            
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
    public function getSocio($id_usuario){
        $sql = "SELECT * FROM usuarios
                WHERE id_usuario = ?;";
            
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
}
?>