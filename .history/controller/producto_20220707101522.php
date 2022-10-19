<?php
header('Content-Type: application/json');

require_once("../config/conexion.php");
require_once("../models/Productos.php");
$productos = new Productos();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $productos->get_producto();
        $Array = [];
        foreach ($datos as $d) {
            $Array[] = ['id' => (int)$d->id, 'nombre' => $d->nombre, 'precio' => $d->precio, 'existencias' => (int)$d->existencias];
        }
        echo json_encode($Array);
        break;

    case "GetId":
        $datos = $productos->get_productos_x_id($body["cat_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $productos->insert_producto($body["cat_nom"], $body["cat_obs"]);
        echo json_encode("Insert Correcto");
        break;

    case "Update":
        $datos = $productos->update_producto($body["cat_id"], $body["cat_nom"], $body["cat_obs"]);
        echo json_encode("Update Correcto");
        break;

    case "Delete":
        $datos = $productos->delete_producto($body["cat_id"]);
        echo json_encode("Delete Correcto");
        break;
}
