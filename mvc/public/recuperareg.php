<?php
//recuperar registros con sentencias preparadas
//en demo tenemos una base de datos
//las password deben ir cifradas ver como ¿algo de hash?


class Login{
    //compararlo con el otro ejemplo de sentencias preparadas
    //se puede definir privado publico esto como queramos
    //inicializar las variables incluso a null
    //no es imprescindible que se llamen igual que los campos aunqu es recomendable
    //sino hay atributos nos los creara en la clase en la que volquemos y se llamaran igual que las
    //columnas
    //esto es un ejemplo de recuperar filas
    protected $nombreusu = null;

    protected $password = null;


    //recuperar filas:
    //los mismos pasos que una sentencia preparada pero añade uno mas que seria recuperar los registros
    /*
    1- preparar la consulta/sentencia -> prepare
    2- establecer el modo de recuperacion: FETCH_CLASS, FETCH_ASSOC
    3- ejecutar la consultar -> execute
    4 Recuperar los registros: fetch (un registro ) / fetchAll(devuelve todos los registros)
    */ 
    //EN FIND DE PRODUCT TENEMOS UN EJEMPLO BINDEADO

    //devolvera todas las filas de la tabla
    //hostname en dockercompose.yml
    public static function all(){
        //cambiarlo a un fichero de configuracion esto normalmente estaria ahi
        $dsn = "mysql:host=db;dbname=demo";
        $usuario ="dbuser";
        $password = "secret";

        try{
            //nueva conexion con los parametros
            $db = new PDO($dsn, $usuario, $password);
            
            //nivel de excepcion
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //esto es una cadena
            $sql = "SELECT * FROM credenciales";

            $sentencia = $db->prepare($sql); //prepara un objeto setencia preparo la sentencia/consulta
            //establece la forma de recuperacion de la sentencia sql
            //recuperar como columna/clase/objeto, vamos a elegir clase
            //como segundo argumento la clase a la que quiero pasar los registros
            //ASI PARA MUCHOS

            $sentencia->setFetchMode(PDO::FETCH_CLASS,"Login");
            //modo fetch_class y la ckase a la que quiero volcar los resultados
            //o Login:: class
            //devuelve una nueva instancia de la clase mapeando las columnas a los atributos de la clase
            
            //o Login::Class
            //nos queda ejecutarlo
            $sentencia->execute();
            //y me queda el punto 4 que es recuperar los registros
            //y recorremos el resultset de sentencia con este fetch, 
            //este es un resultset que entiendo que a cada iteracion igualara $obj a un objeto de la clase login 
            //con los atributos iguales a los campos del registro que toque
            //y asi los recorrer todos (1a forma)
            //uno solo fetch sin bucle, varios fetch con bucle
            // while($obj = $sentencia->fetch()){
            //     //como puedo tener varios registros recorro la tabla
            //     //cada registro va a ser un bjeto
            //     // print_r($obj);// a ver que hay dentro
            //     echo "<br>NOMBRE : " . $obj->nombreusu;
            //     echo "<br>CONTRASEÑA : " . $obj->password;
            //     //para cosas dinamicas ->, para estaticos ::
            // }
                //ASI PARA MUCHOS
            //resultset vs array de objetos
                //como me va a devolver todos me va a devolver un array de objetos

                //he comentado para probar el fetchAll---->array de objetos
                //fetchall me devuelve un array de objetos porque je utiklizdado fetchClass
                //esto es equivalente al set fetchmode solo que lo tenemos que igualar a una variable y despues lo recorremos
            $credenciales = $sentencia->fetchAll(PDO::FETCH_CLASS,"Login");//todos los registros
            //un array de objetos y lo recorro asi
            foreach($credenciales as $credencial){
                echo "<br>NOMBRE : " . $credencial->nombreusu;
                echo "<br>CONTRASEÑA : " . $credencial->password;
            }
        }catch (PDOException $e){
            echo "<br>Error conexion : " . $e->getMessage();
        }
    }
}
//ahora hay que ver el ejemplo de mvcRafa
//por no hacer otro fichero llamo a la clase auqui mismo

echo "<h2>Recuperando registros</h2>";
//esto seria ya el controller
// llamarias a la vista apropiada para mostrar los registros
//los indices son los atributos de la clase que en este caso se corresponde con las columnas de la tabla 
//en este caso las mierdas que tenemos ahi son objetos
Login::all();
//entiendo que llamariamos al controlador y a este metodo y el paso 4 te lo mostraria en un vista
//o quiza algo parecido instanciando resultadosa en variables y mostrandotelas no se
//bueno no porque supongo que si solo quisieras un registro como resultado ya apañarias la consulta
//para que fuera asi