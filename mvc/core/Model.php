<?php
namespace Core;

require_once '../config/db.php';
use const Config\DSN;
use const Config\USER;
use const Config\PASSWORD;

//necesario para referirnos a ella(ponerlo donde haga falta)
use PDO;
/**
*
*/
class Model
{   
    //y aqui crea una conexion usando esas constantes
    protected static function db()
    {
        try {
            $db = new PDO(DSN, USER, PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // se arregla al ponerle una contrabarra 
            //porque esa clase la tiene que coger del namespace raiz, no del de mi aplicacion
        } catch (\PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
        return $db;
    }
}