<?php
    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Productos.php");
    $productos = new Productos();

    $body = json_decode(file_get_contents("php://input"), true);

    switch($_GET["opcion"]){

        case "GetAll":
            $datos=$productos->get_productos();
            echo json_encode($datos);
        break;

        case "GetId":
            $datos=$productos->get_productos_x_id($body["cat_id"]);
            echo json_encode($datos);
        break;

        case "Insert":
            $datos=$productos->insert_productos($body["cat_nom"],$body["cat_obs"]);
            echo json_encode("Insert Correcto");
        break;

        case "Update":
            $datos=$productos->update_productos($body["cat_id"],$body["cat_nom"],$body["cat_obs"]);
            echo json_encode("Update Correcto");
        break;

        case "Delete":
            $datos=$productos->delete_productos($body["cat_id"]);
            echo json_encode("Delete Correcto");
        break;
    }
?>