<?php
// //start llama al controlador y le pasa el metodo apropiado
// //ver apuntes dibujito
//     //nexo de union entre el cliente y el controlador
//     //lo llamaremos controlador frontal, pero lo acabaremos llamando enrutador
//     echo "<h2>Contenido PRIVADO</h2>";

//     // /recurso/metodo/parametro mas que paginas
//     // recurso: controladores
//     // la accion se va a corresponder con los metodos del controlador-> show(), find()
//     //y los posibles parametros que tenga este metodos find -> id de producto

//     //esto es para pronar
//     //clases con require_once
//     require_once "../Controller.php";

//     $app = new Controller();

//     //defino variable de peticion en la url 

//     //1- recoger el metodo que pasancomo parametrro  y si no especifican ninguno cargar el metodo home
//     if(isset($_GET["method"])){
//         $method = $_GET["method"]; //show, find, create, update...
       
//     }else{
//         $method = "home";
//     }

//     //2 - verificar que el metodo introducido existe.
//     if(method_exists($app, $method)){
//         $app->$method();
//     }else{
//         //la cabecera http lo que devuelve
//         //codigo de respuesta de la cabecera http
//         //tambien se podria hacer con header
//         http_response_code(404);
//         die("Metodo no encontrado"); //exit;
//     }

//recurso/accion/parametro asi va a ser mi url o lo que es lo mismo controlador metodo parametro

    // require_once "core/App.php";
    //creo que cambiaba esto
    //ver si funciona asi, que mas hay que cambiar
    //quitar los namespaces
    //asi desde index, desde start sin el ..
    // require_once "..core/App.php";
    require_once "core/App.php";

    
    //en este caso daria igual con que sin la rpimera contrbarra porque estamos en la raiz ya (ruta relativa)
    //ante la duda usar rutas relativas
    $app = new \Core\App();







    
  
    