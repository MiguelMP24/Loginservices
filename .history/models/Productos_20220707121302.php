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
        $sql = "INSERT INTO `producto`(`nombre`, `precio`, `existencias`) VALUES (?,?,?,0);";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $precio);
        $sql->bindValue(3, $exitencias);
        $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        $resultado['estatus'] = false;
        if ($lastInserId != "0") {
            $resultado['id'] = $lastInserId;
            $resultado['estatus'] = true;
        }

        return $resultado;
    }

    public function update_producto($cat_id, $cat_nom, $cat_obs)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_categoria set
                cat_nom = ?,
                cat_obs = ?
                WHERE
                cat_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_nom);
        $sql->bindValue(2, $cat_obs);
        $sql->bindValue(3, $cat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_producto($cat_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_categoria set
                est = '0'
                WHERE
                cat_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
