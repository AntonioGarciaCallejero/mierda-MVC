<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agenda</title>
</head>
<body>
  <!-- un enlace al metodo close() que eliminara las cookies 
  y nos devolvera a la pagina de incio de sesion -->
<h4><a href="?method=close">Cerrar sesión</a></h4>
  <marquee behavior="" direction=""><h1>Bienvenido <?= $_COOKIE['name'] ?>, que Dios le bendiga mucho</h1></marquee>

  <h2>Gestion de contactos Personas</h2>

  <h3>Añadir un Nuevo COntacto Persona</h3>
  <form action="?method=nuevaPersona" method="post">
    <label for="">Nombre  </label>
    <input type="text" name="nombre">
    <br>
    <label for="">Apellidos  </label>
    <input type="text" name="apellidos">
    <br>
    <label for="">Direccion  </label>
    <input type="text" name="direccion">
    <br>
    <label for="">Telefono  </label>
    <input type="text" name="telefono">
    
    <input type="submit" value="login">
  </form>

  <h3>Borrar Persona</h3>
  <form action="?method=borrarPersona" method="post">
    <label for="">Nombre  </label>
    <input type="text" name="nombre">
    <br>
    <input type="submit" value="login">
  </form>

  <h3>Buscar Nombre de Persona para que se Muestren sus datos</h3>
  <form action="?method=showPersona" method="post">
    <label for="">Nombre  </label>
    <input type="text" name="name">
    <br>
    <input type="submit" value="login">
  </form>


  <h3>Actualizar una Persona</h3>
  <form action="?method=actualizarPersona" method="post">
    <label for="">Introduzca el nombre de la persona que desea actualizar </label>
    <input type="text" name="nombreViejo">
    <p>A continuacion introduzca los nuevos datos:</p>
    <br>
    <label for="">Nombre </label>
    <input type="text" name="nombreNuevo">
    <label for="">Apellidos </label>
    <input type="text" name="apellidos">
    <label for="">Direccion </label>
    <input type="text" name="direccion">
    <label for="">Telefono </label>
    <input type="text" name="telefono">
    <input type="submit" value="login">
  </form>

  <h2>Gestion de contactos Empresas</h2>

  <h3>Añadir un Nuevo COntacto Empresa</h3>
  <form action="?method=nuevaEmpresa" method="post">
    <label for="">Nombre  </label>
    <input type="text" name="nombre">
    <br>
    <label for="">Direccion  </label>
    <input type="text" name="direccion">
    <br>
    <label for="">Telefono  </label>
    <input type="text" name="telefono">
    <br>
    <label for="">Emilio  </label>
    <input type="text" name="email">
    
    <input type="submit" value="login">
  </form>

  <h3>Borrar Empresa</h3>
  <form action="?method=borrarEmpresa" method="post">
    <label for="">Nombre  </label>
    <input type="text" name="nombre">
    <br>
    <input type="submit" value="login">
  </form>


  


  <h3>Buscar Nombre de Empresa para que se Muestren sus datos</h3>
  <form action="?method=showEmpresa" method="post">
    <label for="">Nombre  </label>
    <input type="text" name="name">
    <br>
    <input type="submit" value="login">
  </form>


  


  <h3>Actualizar una Empresa</h3>
  <form action="?method=actualizarEmpresa" method="post">
    <label for="">Introduzca el nombre de la empresa que desea actualizar </label>
    <input type="text" name="nombreViejo">
    <p>A continuacion introduzca los nuevos datos:</p>
    <br>
    <label for="">Nombre </label>
    <input type="text" name="nombreNuevo">
    <label for="">Direccion </label>
    <input type="text" name="direccion">
    <label for="">Telefono </label>
    <input type="text" name="telefono">
    <label for="">Email </label>
    <input type="text" name="email">
    <input type="submit" value="login">
  </form>

  <h2>Otros</h2>

  <h3>Subir una imagen de contacto</h3>
  <h3>La imagen debe tener las exstensiones png/jpg/pdf y un tamaño maximo de 5 MB</h3>
  <form action="?method=fichero" method="post" enctype="multipart/form-data">
        <!-- tiene que ir todo dentro del formulario -->
    <p>
        <label for="mifich">Selecciona un fichero </label>
        <!-- el id lo ponemos para el label -->
        <input type="file" name="myfile" id="mifich">
    
    </p>
    <p>
    
        <input type="submit" name="envio" value="Enviar fichero">
    </p>
    <!-- si venimos aqui con el metodo fichero tendremos una flag que nos indicara si 
  la subida se ha realizado correctamente -->
    <?php 
        
        if($_GET["flag"] != null){
          echo $_GET["flag"]? "<p>fichero subido correctamente</p>" : "<p>fallo en la subida</p>";
        }
    
    ?>

</form>






  
  
</body>
</html>