<?php
class Conectar
{
    protected $db;
    protected function Conexion()
    {
        try {
            $NAMEDB = 'pw_ii';
            $HOST = 'localhost';
            $USER = 'root';
            $PASSWORD = '';
            $conectar = $this->db = new PDO("mysql:local=$HOST;dbname=$NAMEDB", "$USER", "$PASSWORD");
            return $conectar;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names()
    {
        return $this->db->query("SET NAMES 'utf8'");
    }
}
