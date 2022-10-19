<?php
class Productos extends Conectar
{
    public function get_producto()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM producto;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'id' => (int)$d->id, 'nombre' => $d->nombre,
                'precio' => $d->precio, 'existencias' => (int)$d->existencias
            ];
        }
        return $Array;
    }

    public function get_productos_x_id($producto_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM producto WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $producto_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'id' => (int)$resultado->id, 'nombre' => $resultado->nombre,
            'precio' => $resultado->precio, 'existencias' => (int)$resultado->existencias
        ] : [];
        return $Array;
    }

    public function insert_producto($nombre, $precio, $exitencias)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `producto`(`nombre`, `precio`, `existencias`) VALUES (?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $precio);
        $sql->bindValue(3, $exitencias);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = $lastInserId;
        }
        return $resultado;
    }

    public function update_producto($id, $nombre, $precio, $exitencias)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `producto` SET `nombre`= ?, `precio`= ?, `existencias`= ? WHERE ed id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $precio);
        $sql->bindValue(3, $exitencias);
        $sql->bindValue(4, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_producto($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `producto` WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }
}
