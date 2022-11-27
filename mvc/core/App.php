<?php
    namespace Core;
    //esto es el enrutador de controladores
    //no poner comentarios antes del namespace

class  App{

      
    //poner que cierran los cierres de llaves


    // si no la url no especifica ningun controlador (recurso) => asingo uno por defecto => home
    // si no la url no especifica ningun metodo => asigno por defecto : index
    function __construct()
    {
        //http://mvc.local/product/show => http://mvc.local/index.php?url=product/show
        //ahora url va a ser una variable
        //si esta definida pues la asigno
        if (isset ($_GET["url"]) && !empty($_GET["url"])) {
            $url = $_GET["url"];
        }
        else{
        // si no la url no especifica ningun controlador (recurso) => asingo uno por defecto => home    
            $url = "home";
        }
        //imprimir variables para encontra errores, var_dump() y usar die() para que solo ejecute hasta ahi
        //un poco como el debugger
        //  /product/show a este array de argumentos le va a llgar esto tengo que trocearlo de forma que 
        //quede asi
        // product: recurso; show: accion; 5: parametro
        //explode para separarlos, trocea una cadena en subcadenas mediante un caracter separador
        //controlador, metodo, parametro
        // /product/show/5 -> product: recurso; show: accion; 5: parametro
        //parte por el cararter pero el caracter lo mantiene
        //con trim lo quita de delante y detras
        // el trim te quita ese caracter del principio y del final
        //mirar que hace
        //tendre barraproduct, barrashwo y y barramierdas, con el trim me aseguro de eliminar las
        //barras y me deja las palabras 
        //le especificas el caracter que quieres que te quite del principio y del final
        $arguments = explode('/', trim($url, '/')); //devuelve un array
        //arrayshift quita el primer elemento del array
        $controllerName = array_shift($arguments); //esto sera product ProductController a partir de ahora todos 
        //nuestros controladores se llamaran asi
        //te convierte el primer caracter de una cadena en mayuscula
        $controllerName = ucwords($controllerName) . "Controller";
        //ya tengo mi nombre de controlador preparado, pero sigo teniendo cosas en el array
        if(count($arguments)){
            //si a este array le quedan elementos, si el numero de elementos es mayor que cero
            //es que el siguiente elemento es el metodo
            $method = array_shift($arguments); //show
        }
        else{
            //asigno un metodo por defecto sino
            $method = "index";
        }

        //voy a cargar el controlador. ProductController.php
        //le pongo ruta para que no me lo cree dentro de core
        
        
        
        $file = "../app/controllers/$controllerName.php";
        //ahora tengo que verificcar que ese fichero existe
        if(file_exists($file)){
            //si existe lo cargo
            require_once $file; //importo el fichero si existe
        }else{
            //si no existe lanzo un errro
            http_response_code(404);
            die("No encontrado");
        }

        //homecontroller esta dentro de un namespace asi que haroa tengo que ponerlo asi
        

        //hay que ponerlo asi o no te deja 
        //esto era porque no puedes hacer new namespace + nombre de la clase (mas abajo)
        $controllerName = "\\App\\Controllers\\$controllerName";
        // echo $controllerName;
    
                //esta es la clase mas dificil repasar asaco esto
        //existe el metodo en el controlador?
        //como el constructor es vacio puede ir con parentesis o sin parentesis
        //para usar sus metodos hay que crear unobjeto controller
        $controllerObject = new  $controllerName; //objeto de la clase que contiene esa variable
        //lo mismo que si pongo new ProductController no se si esto es con mayuscula o si mayuscula
        
        //compruebo que en ese objeto controller existe el metodo
        if(method_exists($controllerObject, $method)) {
            //si el metodo existe tengo que llamarlo con los parametros si los hubiera
            //arguments es el array donde he metido la url troceadita, si quedara algo serian los parametros
            //AHORA YA SABEMOS QUE ARGUMENTS ES UN ARRAY
            $controllerObject->$method($arguments);  //metodo ok-> lo invoco 
                        //si es vacio lo llamara sin argumentos
        }
        else{
            http_response_code(404);
            die("No encontrado");
        }

        //repasar esto un monton y la estructura entenderlo
        //parte la url y hace cosas con los pedazos
        


    }
    
}
