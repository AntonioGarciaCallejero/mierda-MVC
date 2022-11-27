<?php
//conexion de php a una base de datos

//en que rama lo hicimos el ejemeplo bases
//porque no me funsiona lo otro
//dbname es el nombre de la tabla
//hay que darle el nombre de la base de datos en dbname
//el nombre de la tabla se indicara en la consulta
$dsn = "mysql:dbname=agenda;host=db";
$usuario = "dbuser";
$password = "secret";

//pelear
//buscar ejemplo
//caña
//conexion a bases de datos?
//

/*1 Perparar la consulta ->prepare  
 2 vincular los datos bindParam / bindValue 2 formas
 3 ejecutar la sentencia -> execute();(query, exec) recomendado exec
 es mas seguro */

try {
    //nueva conexion con la base de datos conesos parametros
    $db = new PDO($dsn, $usuario, $password);
    //establece el nivel de errorr que muestra la conexion
    //hace que la conexion tenga como atributo ese nivel de error 
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //prepara la sentencia con eso que devuelve un objeto sentencia
    //preparacion por nombre
    //como lo hariamos con clave valor (con bindParam o con array asociativo)
    // $sentencia = $db->prepare("INSERT INTO credenciales (nombreusu,password) VALUES (:nombre,:clave) ");
    
    //como lo hariamos con numeros y bindParam o con array indexado
    //preparacion por pisicion

    //vamos a recuperar los valores de contraseña y usuario que nos interesan
    //pero oh shit no se recuperar valores sueltos bien con sentencias preparadas
    //a lo mejor mirar lo de rafa
    //podemos recuperar 
    $sentencia = $db->prepare("INSERT INTO credenciales (nombreusu,password) VALUES (? , ?) ");
    
    
    
    
    
    $nombre = "Alicia";
    $clave1 = "Sombrero";
    //bindparam lo asocio dcon dospuntos nombre
    $sentencia->bindParam(1,$nombre);
    $sentencia->bindParam(2,$clave1); //no tiene porque corresponder el nombre de la variable con la variable dinamica
//el 1 es el primero interrogante, el dos el segundo

//preparacion + ejecucion : execute(array)
//ejemplo en los apuntes
//en este caso no hay ningun bind
//stmt->execute(array('nombre'->....pollas)) en los apuntes


    // $sentencia->bindValue(":nombre",$nombre);
    // $sentencia->bindValue(":clave",$clave1);
    //bindValue parecido a bindParam pero se queda con el valor, no es un apuntador, aunque lo redefina le da igual
    //consultas que se van a usar muchas veces bindParam(por ejemplo un bucle)
    //pocas veces bindValue

    //es un apuntador a la variable el bindparam si las sobrescribo va a coger las ultimas
    //apunta
    // $nombre = "Pedro";
    // $clave1 = "789";
    $sentencia->execute(); //ejecutamos la sentencia asi porque ya estan bindeados

    echo "<h2>Exito</h2>";

//ctrl click para ir al origen de las cosas

} catch (PDOException $e) {
    echo "Error producido al conectar: " . $e->getMessage();

}
//en la tabla demo ahora tengo una mierda nueva credenciales