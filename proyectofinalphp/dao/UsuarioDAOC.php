<?php 
class UsuarioDAOC {

    public function validarUsuYPass($usu, $pass) {
        require_once("../dataBase/ConexionDB.php");

        $conexionDB = new ConexionDB("localhost","root", "", "cacproyecto");
        $conexionDB->conectar();

        $sql ="SELECT * FROM usuarios WHERE usuario = '$usu' AND clave='$pass'";
        $conexionDB->ejecutar($sql);

        $existeUsuYPass = $conexionDB->cantFilas() > 0;
 
        if ($existeUsuYPass) {
            return true;
        } else {
            return false;
        }
        
    }

    // 
    /**
     * da de alta usuario en tabla usuarios. 
     * parametro usuario - nombre de usuario es un mail valido
     * parametro pass - contraseña que debe tener mayus, minus y num
     * devuelve true - guarda ok -- false - no guardo
     */

    public function guardarUsuario($usu, $pass) {
        require_once("../dataBase/ConexionDB.php");

        $conexionDB = new ConexionDB("localhost","root", "", "cacproyecto");
        $conexionDB->conectar();

        //todo: validar usu como mail y pass con seguridad

        $sql = "INSERT INTO usuarios ('usuario', 'clave') VALUES ('$usu', '$pass') ";
        
        $conexionDB->ejecutar($sql);
        return $conexionDB->cantFilas() > 0; 
    }

        // obtiene todos los usuarios de la tabla Usuarios de la db. devuelve array de objetos usuario

    public function listarUsuarios() {
        require_once("../dataBase/ConexionDB.php");
        require_once("../model/Usuario.php");

        $conexionDB = new ConexionDB("localhost","root", "", "cacproyecto");
        $conexionDB->conectar();

        $sql = "SELECT * FROM usuarios ";
        
        $result = $conexionDB->ejecutar($sql);

        while ($usu = $result->fetch_assoc()) {
            $usuObj = new Usuario($usu["idusuario"], $usu["usuario"], $usu["clave"] );
           
            $listaUsu[] = $usuObj;
        }

        return $listaUsu;


        
    }

}

?>