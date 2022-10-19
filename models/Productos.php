<?php
class Productos extends Conectar
{
    public function get_producto()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM acceso;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'id' => (int)$d->id, 'nombre' => $d->nombre,
                 'correo' => $d->correo,
                'contrasena' => $d->contrasena
            ];
        }
        return $Array;
    }



    public function get_productos_x_id($producto_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `acceso` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $producto_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'id' => (int)$resultado->id, 
            'nombre' => $resultado->nombre, 'correo' => $resultado->correo,
            'contrasena' => $resultado->contrasena
            
        ] : [];
        return $Array;
    }



    public function update_producto($id, $nombre, $correo, $contrasena)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `acceso` SET `imagen`= ?, `marca`= ?, `modelo`= ? , `anio`= ? , `precioventa`= ? , `cantidad` = ? WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $correo);
        $sql->bindValue(3, $contrasena);
        $sql->bindValue(4, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_producto($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `acceso` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function login($correo, $contrasena){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `acceso` WHERE correo = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $correo);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        if(password_verify($contrasena, $resultado->contrasena)){
            return true;
        }else {
            return false;
        }
        
    }

    public function insert_producto($nombre, $correo, $contrasena)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `acceso`(`nombre`, `correo`, `contrasena`) VALUES (?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $correo);
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql->bindValue(3, $contrasena);

        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }
}



