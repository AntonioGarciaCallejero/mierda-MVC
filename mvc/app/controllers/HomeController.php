<?php
 namespace App\Controllers; 
 //esto lo jodia todo noseporque
 //los require no se quitan
     
// el controlador especifico
//un controlador para cada mierda en vez de uno solo para todas que es el que hemos deprecateado
//app cargara un controlador y en el controlador estaran los metodos
class HomeController
{   
    //en home y login ya no voy a cargar productos, mostrare una vista diferente
    // un controlador no tiene porque sacar echos, llama a las vistas 
    //esto reemplazaria a controller.php
    //seria llamar a diferentes vistas enn cada controladror
    
    function __construct()
    {
        // echo "<br>Constructor clase HOMECONTROLLER";
        
    }

    //index y show van a remplazar a los de controller de mvc00
    function index(){
        echo "<br>Dentro index de HOMECONTROLLER";
        //metodo home de Controller de mvc00
        //habria que modificarlos
        //el require lanza un error al no funcionar y nos viene bien saberlo
        //porque esto es asi, no entiendo como funciona esta ruta, preguntar
        //imagino que porque segun la traza de la ejecucion y las llamadas estaremos en otro sitio
        // require "../views/home.php"; asi estaba antes cuando las views estaban en otro lado
        //cambiar la ruta de las views en los metodos
        //funciona, entonces estoy o en index o en app?
        //en controllers no estas, porque te sales fuera y seleccionas app
        
        require "../app/views/home.php";


    }

    function show(){
        echo "<br>Dentro de show de HOMECONTROLLER";
        //metodo show de Controller mvc00
    }

////miniejercicio crear 2 nuevos login y home dentro de controllers
//si no hay metodo asigno index
//si no hay controlador asigno home 
}//fin clase