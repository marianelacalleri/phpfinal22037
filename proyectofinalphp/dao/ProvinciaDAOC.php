<?php

class ProvinciaDAOC {
    public function getProvinciaXID($id) {
        require_once("../dataBase/ConexionDB.php");
        require_once("../model/Provincia.php");
        require_once("../dao/ProvinciaDAOC.php"); 

        $conexionDB = new ConexionDB("localhost","root", "", "cacproyecto");
        $conexionDB->conectar();

        $sql = "SELECT * FROM provincias WHERE idprovincia=$id";
        
        $result = $conexionDB->ejecutar($sql);

        $provDAO = new ProvinciaDAOC();

        while ($prov = $result->fetch_assoc()) {
            $provincia = $provDAO; 

            $provObj = new Provincia($prov["idprovincia"], $prov["nombre"], "");
           
           // $listaProv[] = $locObj;
        }

        return $provObj;
    }

    public function listarProvincias(){
        return null;
    }
}


?>