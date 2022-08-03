<?php
$id = $_POST['id']; 
$nombre = $_POST["firstName"];
$apellido = $_POST["lastName"];
$usuario = $_POST['username'];
$mail = $_POST['email'];
$lugarentrega = $_POST['address'];
$idLocalidad = $_POST['country'];
$idProvincia = $_POST['state'];
$codpostal = $_POST['zip'];
$formadepago = $_POST['paymentMethod'];
$tarjtitular = $_POST['cc-name'];
$tarjnumero = $_POST['cc-number'];
$tarjvto = $_POST['cc-expiration'];
$tarjclave = $_POST['cc-cvv'];

require_once("../model/Pedido.php");
require_once("../model/Localidad.php");
require_once("../model/Provincia.php");
require_once("../dao/PedidoDAO.php");

$provincia = new Provincia($idProvincia, null);
$localidad = new Localidad($idLocalidad, null, $provincia);


$pedido = new Pedido($id, $nombre, $apellido, $usuario, $mail, $lugarentrega, $localidad, $codpostal, $formadepago, $tarjtitular, $tarjnumero, $tarjvto, $tarjclave); 

//var_dump($pedido);

$pedidoDAO = new PedidoDAO();
$insertOK = $pedidoDAO->editarPedido($pedido); 

if ($insertOK) {
    header("Location: ../view/mensajeOk.php");
    exit;
} else {
    header("Location: ../view/mensajeError.php");
    exit;
}

?>