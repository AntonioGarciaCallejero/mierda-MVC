<?php

class App
{
  public function run()
  {
    if (isset($_GET['method'])) {
      $method = $_GET['method'];
    } else {
      //el metodo por defecto aqui seria login que es donde vamos a empezar
      $method = 'login';
    }
  
    $this->$method();      
  }

  //muestra la vista login si existe 
  public function login()
  {
    //si existe la cookie, el login me muestra home
    if (isset($_COOKIE['name']) && isset($_COOKIE['password'])) {
      header('Location: ?method=home');
      return;
    }
    //si no existe, me muestra la pagina de login
    include('views/login.php');
  }

  //en este metodo venimos del formulario, comprobamos que exista el usuario en la base de datos
  //y si es asi verificamos la contraseña introducida con el almacenado en la base
  //si son correctos almacenamos usuario y contraseña en una cookie y nos vamos a home
  public function auth()
  {
    //recoger datos POST
    if (isset($_POST['name'])) {
      $name = $_POST['name'];
      $contrasegna = $_POST['password'];
    } else {
      
      header('Location: ?method=login');
      return;
    }
    
    
  //-----------------------------------------------------------------------------
  $dsn = "mysql:dbname=agenda;host=db";
  $usuario = "root";
  $password = "password";
  
  
  
  try {
      //nueva conexion con la base de datos conesos parametros
      $db = new PDO($dsn, $usuario, $password);
      //establece el nivel de errorr que muestra la conexion
      //hace que la conexion tenga como atributo ese nivel de error 
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    $stmt = $db->prepare('SELECT * FROM credenciales WHERE usuario = :name');
    $stmt->execute(array(':name' => $name));
    $stmt->setFetchMode(PDO::FETCH_CLASS, App::class);
    $resultado = $stmt->fetch(PDO::FETCH_CLASS);

    
//FUNCIONA

      

      
      
      


  } catch (PDOException $e) {
      echo "Error producido al conectar: " . $e->getMessage();
  
  }
  //sigue funcionando aqui
  //hacemos la verificiacion
  
  


//esta dandonos false esto, porque?
  if (
    $name == $resultado->usuario && password_verify($contrasegna, $resultado->password )
  ) {

    
    setcookie('name', $name, time() + 60*60*2);
    setcookie('contrasegna', $contrasegna, time() + 60*60*2);
    header('Location: ?method=home');
  } else {
    //redireccion a ind3ex.php que esta al mismo nivel que nosotros con 
    //¿ruta relativa?
    header('Location: ?method=login');
    return;
  }
    
    
   //--------------------------------------------------------------------------------- 
    
    
  }

  //este metodo lee los datos del xml y los almacena en un tabla empresas y otra personas
  //luego te te muestra la vista home
  public function home()
  {
    //si no existe la cookie, home te devuelve al login
    if (!isset($_COOKIE['name']) || !isset($_COOKIE['contrasegna']) ) {
      header('Location: ?method=login');
      return;
    }
    //-------------------AQui   VAMOS A LEER EL XML Y METERLO EN LA BASE
    
    
    
    $datos = simplexml_load_file("Ficheros XML en PHP-20221020/agenda.xml");
    
    //de esa
    //usamos una sentencia xpath para lograr el resultado deseado
    //ahora tenemos un array de objetos con los atributos
    $personas = $datos->xpath("//contacto[@tipo = 'persona']");
    
    $empresas = $datos->xpath("//contacto[@tipo = 'empresa']");
    
    

    $dsn = "mysql:dbname=agenda;host=db";
    $usuario = "root";
    $password = "password";
    //vale, esto ira dentro de un try catch
    foreach ($personas as $persona) {
        //ahora usaremos los prepared statements
        
        $nombre = $persona->nombre;
        $apellidos = $persona->apellidos;
        $direccion = $persona->direccion;
        $telefono = $persona->telefono;
        //---------------------------------------------------------------------------
        try {
          //nueva conexion con la base de datos conesos parametros
          $db = new PDO($dsn, $usuario, $password);
          //establece el nivel de errorr que muestra la conexion
          //hace que la conexion tenga como atributo ese nivel de error 
          $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          
          $sentencia = $db->prepare("INSERT INTO personas (nombre,apellidos,direccion,telefono) VALUES (? , ?, ?, ?) ");
          
          
          
          
          
          
          
          $sentencia->bindParam(1,$nombre);
          $sentencia->bindParam(2,$apellidos);
          $sentencia->bindParam(3,$direccion);
          $sentencia->bindParam(4,$telefono);
           
          $sentencia->execute(); //ejecutamos la sentencia asi porque ya estan bindeados
      
          
      
      
      
      } catch (PDOException $e) {
          echo "Error producido al conectar: " . $e->getMessage();
      
      }
        //---------------------------------------------------------------------------

    }

    //LASEMPRESAS-------------------------------------------------------------------------------
    foreach ($empresas as $empresa) {
      //ahora usaremos los prepared statements
      
      $nombre = $empresa->nombre;
      $direccion = $empresa->direccion;
      $telefono = $empresa->telefono;
      $email = $empresa->email;
      //---------------------------------------------------------------------------
      try {
        //nueva conexion con la base de datos conesos parametros
        $db = new PDO($dsn, $usuario, $password);
        //establece el nivel de errorr que muestra la conexion
        //hace que la conexion tenga como atributo ese nivel de error 
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         
        $sentencia = $db->prepare("INSERT INTO empresas (nombre,direccion,telefono,email) VALUES (? , ?, ?, ?) ");
        
        
        $sentencia->bindParam(1,$nombre);
        $sentencia->bindParam(2,$direccion);
        $sentencia->bindParam(3,$telefono);
        $sentencia->bindParam(4,$email);
         
        $sentencia->execute(); //ejecutamos la sentencia asi porque ya estan bindeados
    
        
    
    
    
      }
      catch (PDOException $e) {
          echo "Error producido al conectar: " . $e->getMessage();
      
      }
      //---------------------------------------------------------------------------

    }

    //y te muestra la pagina home
    include('views/home.php');
  }

  //-------------------------------------------------------------------------------------------------
  //este metodo recibe los datos del formulario de la vista home y los almacena en la base
  //de datos como una persona
  public function nuevaPersona(){
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    //ahora el prepared statement

    $dsn = "mysql:dbname=agenda;host=db";
    $usuario = "root";
    $password = "password";

    try {
      //nueva conexion con la base de datos conesos parametros
      $db = new PDO($dsn, $usuario, $password);
      //establece el nivel de errorr que muestra la conexion
      //hace que la conexion tenga como atributo ese nivel de error 
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $sentencia = $db->prepare("INSERT INTO personas (nombre,apellidos,direccion,telefono) VALUES (? , ?, ?, ?) ");
      
      $sentencia->bindParam(1,$nombre);
      $sentencia->bindParam(2,$apellidos);
      $sentencia->bindParam(3,$direccion);
      $sentencia->bindParam(4,$telefono);
       
      $sentencia->execute(); //ejecutamos la sentencia asi porque ya estan bindeados
  
      
  
  
  
    } catch (PDOException $e) {
        echo "Error producido al conectar: " . $e->getMessage();
    
    }
    //si sacas cosas por html ya no puedes hacer header 
    header('Location: index.php?method=home');

  }//fin de nuevaPersona

  //idem con empresa
  public function nuevaEmpresa(){
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    //ahora el prepared statement

    $dsn = "mysql:dbname=agenda;host=db";
    $usuario = "root";
    $password = "password";

    try {
      //nueva conexion con la base de datos conesos parametros
      $db = new PDO($dsn, $usuario, $password);
      //establece el nivel de errorr que muestra la conexion
      //hace que la conexion tenga como atributo ese nivel de error 
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $sentencia = $db->prepare("INSERT INTO empresas (nombre,direccion,telefono,email) VALUES (? , ?, ?, ?) ");
       
      
      
      
      $sentencia->bindParam(1,$nombre);
      $sentencia->bindParam(2,$direccion);
      $sentencia->bindParam(3,$telefono);
      $sentencia->bindParam(4,$email);
  
      $sentencia->execute(); //ejecutamos la sentencia asi porque ya estan bindeados
  
      
  
  
  
    } catch (PDOException $e) {
        echo "Error producido al conectar: " . $e->getMessage();
    
    }
    //si sacas cosas por html ya no puedes hacer header 
    header('Location: index.php?method=home');

  }

  //este borra todos los registro de una persona en la tabla persona
  public function borrarPersona(){
    $nombre = $_POST["nombre"];
    
    //ahora el prepared statement

    $dsn = "mysql:dbname=agenda;host=db";
    $usuario = "root";
    $password = "password";

    try {
      //nueva conexion con la base de datos conesos parametros
      $db = new PDO($dsn, $usuario, $password);
      //establece el nivel de errorr que muestra la conexion
      //hace que la conexion tenga como atributo ese nivel de error 
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $sentencia = $db->prepare("DELETE FROM personas WHERE nombre=?");
      
      
      
      
      
      
      
      $sentencia->bindParam(1,$nombre);
      
 
      $sentencia->execute(); //ejecutamos la sentencia asi porque ya estan bindeados
  
      
  
  
  
    } catch (PDOException $e) {
        echo "Error producido al conectar: " . $e->getMessage();
    
    }
    //si sacas cosas por html ya no puedes hacer header 
    header('Location: index.php?method=home');

  }

  //idem con empresa
  public function borrarEmpresa(){
    $nombre = $_POST["nombre"];
    
    //ahora el prepared statement

    $dsn = "mysql:dbname=agenda;host=db";
    $usuario = "root";
    $password = "password";

    try {
      //nueva conexion con la base de datos conesos parametros
      $db = new PDO($dsn, $usuario, $password);
      //establece el nivel de errorr que muestra la conexion
      //hace que la conexion tenga como atributo ese nivel de error 
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $sentencia = $db->prepare("DELETE FROM empresas WHERE nombre=?");
      
      
      
      
      
      
      //bindparam lo asocio con dospuntos nombre
      $sentencia->bindParam(1,$nombre);
      
  
      $sentencia->execute(); //ejecutamos la sentencia asi porque ya estan bindeados
  
      
  
  
  
    } catch (PDOException $e) {
        echo "Error producido al conectar: " . $e->getMessage();
    
    }
    //si sacas cosas por html ya no puedes hacer header 
    header('Location: index.php?method=home');

  }



  ///este metodo una persona y lo usara internamente el metodo show()
  public function findPersona($name){
    
    $dsn = "mysql:dbname=agenda;host=db";
    $usuario = "root";
    $password = "password";
    
    
    
    try {
        //nueva conexion con la base de datos conesos parametros
        $db = new PDO($dsn, $usuario, $password);
        //establece el nivel de errorr que muestra la conexion
        //hace que la conexion tenga como atributo ese nivel de error 
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      
      $stmt = $db->prepare('SELECT  * FROM personas WHERE nombre = :name');
      $stmt->execute(array(':name' => $name));
      $stmt->setFetchMode(PDO::FETCH_CLASS, App::class);
      $persona = $stmt->fetch(PDO::FETCH_CLASS);
      
      return $persona;
  
      
  //FUNCIONA
  
        
  
        
        
        
  
  
    } catch (PDOException $e) {
        echo "Error producido al conectar: " . $e->getMessage();
    
    }
    

  }
  

  //lo siguiente sera un metodo show que recuperara los datos de find y llamara 
  //a una vista para mostrarlos

  //usa el metodo find para recuperar una persona de la base de datos y muestra sus datos
  //con la vista show
  public function showPersona(){
    

    $persona = $this->findPersona($_POST["name"]);

    
    

    
    
    require('views/showPersona.php'); 
  }


  //idem con empresa
  public function findEmpresa($name){
    
    $dsn = "mysql:dbname=agenda;host=db";
    $usuario = "root";
    $password = "password";
    
    
     
    
    try {
        //nueva conexion con la base de datos conesos parametros
        $db = new PDO($dsn, $usuario, $password);
        //establece el nivel de errorr que muestra la conexion
        //hace que la conexion tenga como atributo ese nivel de error 
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      
      $stmt = $db->prepare('SELECT  * FROM empresas WHERE nombre = :name');
      $stmt->execute(array(':name' => $name));
      $stmt->setFetchMode(PDO::FETCH_CLASS, App::class);
      $empresa = $stmt->fetch(PDO::FETCH_CLASS);
      
      return $empresa;
  
      
  //FUNCIONA
  
        
  
        
        
        
  
  
    } catch (PDOException $e) {
        echo "Error producido al conectar: " . $e->getMessage();
    
    }
    

  }


  //idem con empresa
  public function showEmpresa(){
    

    $empresa = $this->findEmpresa($_POST["name"]);

    
    

    
    
    require('views/showEmpresa.php'); 
  }


  //actualiza los datos de las filas que concuerden con el nombre introducido
  public function actualizarPersona(){

    
    $dsn = "mysql:dbname=agenda;host=db";
    $usuario = "root";
    $password = "password";
    
    
     
    
    try {
        //nueva conexion con la base de datos conesos parametros
        $db = new PDO($dsn, $usuario, $password);
        //establece el nivel de errorr que muestra la conexion
        //hace que la conexion tenga como atributo ese nivel de error 
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $nombreNuevo = $_POST["nombreNuevo"];
      
      $apellidos = $_POST["apellidos"];
      
      $direccion = $_POST["direccion"];
      
      $telefono = $_POST["telefono"];
      
      $nombreViejo = $_POST["nombreViejo"];
      
      
      //--------------------------------------------------------------------------
      
      $sentencia = $db->prepare("UPDATE personas SET nombre = ?, apellidos= ?, direccion= ?, telefono= ?    WHERE nombre = ?;");
          
          
          
          
          
          
      
      $sentencia->bindParam(1,$nombreNuevo);
      $sentencia->bindParam(2,$apellidos);
      $sentencia->bindParam(3,$direccion);
      $sentencia->bindParam(4,$telefono);
      $sentencia->bindParam(5,$nombreViejo);

  
      $sentencia->execute();
      
  
      
  //FUNCIONA
  
        
  
        
        
        
  
  
    } catch (PDOException $e) {
        echo "Error producido al conectar: " . $e->getMessage();
    
    }
    

  
  }

  //idem con empresa
  public function actualizarEmpresa(){
  
    
    $dsn = "mysql:dbname=agenda;host=db";
    $usuario = "root";
    $password = "password";
    
    
     
    
    try {
        //nueva conexion con la base de datos conesos parametros
        $db = new PDO($dsn, $usuario, $password);
        //establece el nivel de errorr que muestra la conexion
        //hace que la conexion tenga como atributo ese nivel de error 
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      $nombreNuevo = $_POST["nombreNuevo"];
      
      $direccion = $_POST["direccion"];
      
      $telefono = $_POST["telefono"];
      
      $email = $_POST["email"];
      
      $nombreViejo = $_POST["nombreViejo"];
      
      
      //--------------------------------------------------------------------------
      
      $sentencia = $db->prepare("UPDATE empresas SET nombre = ?, direccion= ?, telefono= ?, email= ?    WHERE nombre = ?;");
          
          
          
          
          
          
      
      $sentencia->bindParam(1,$nombreNuevo);
      $sentencia->bindParam(2,$direccion);
      $sentencia->bindParam(3,$telefono);
      $sentencia->bindParam(4,$email);
      $sentencia->bindParam(5,$nombreViejo);


  
      $sentencia->execute();
      
  
      
  //FUNCIONA
  
        
  
        
        
        
  
  
    } catch (PDOException $e) {
        echo "Error producido al conectar: " . $e->getMessage();
    
    }
    

  
  }



//--------------------------------------------------------------------------------------------------
  

  //subimos un fichero a traves de un formulario, devolvera un mensaje informando
  //del exito o el fracaso de la operacion 
  public function fichero(){

    
        //$_FILES es un array de arrays
        //cada fichero seria un array dentro de el, con sus caracteristicas como elementos
        
        //si el fichero cumple las condiciones del enunciado
        if(  ($_FILES["myfile"]["type"] == "image/jpg" || $_FILES["myfile"]["type"] == "image/png"
        ||  $_FILES["myfile"]["type"] == "application/pdf") && $_FILES["myfile"]["size"] <= 5242800  )
        { 


          

          //lo subimos
          $destino = "uploads/" . $_FILES["myfile"]["name"];
          //tmp_name
          $flag = move_uploaded_file($_FILES["myfile"]["tmp_name"], $destino);
          
         

        }
        else{
          $flag= 0;
        }
        //por alguna razon el flag = false no se envia bien en el GET
        //bueno, se envia como o 1 cuando es true, o como nada cuando es false
        //y el como nada el operador ternario no me lo coge
        //asi que he puesto que sea 0 en vez de false y a  correr
        header("Location: index.php?method=home&flag=$flag");



        
        

  }


  //este elimina todas las cookies y te redirige a login
  public function close()
  {
    
    
    setcookie('name', '',  1);
    setcookie('password', '',  1);
    header('Location: index.php?method=login');
  }
}
