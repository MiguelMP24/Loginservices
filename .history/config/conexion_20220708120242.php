<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST');
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
