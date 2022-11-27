<?php
    // crear web en la que seleecciones entre 3 idiomas: (radiobutton?) el expañol, ingles y alleman 
    // y selecciones una marca de coche perferida y muestre el siguiente mensaje
    
    // Bienvenido querido usuario.
    // Welcome dear user.
    
    
    // y la marca de coche seleccionada.
    
    
    // Esta informacion se debe guardar en cookies y luego recuperar la informacion
    // Si no se slecciona idioma por defecto sera español

    //header() y setcookie() tienen que ir antes del body


    if(isset($_POST["envio"])){
        if(!empty($_POST["idioma"]) && !isset($_COOKIE["idioma"])){
            //verificar que la variable no este vacia
            setcookie("idioma", $_POST["idioma"], time()+3600);
        }
        //si tengo esas mierdas establecidas y la cookie no existe
        if (!empty($_POST["marca"]) && !isset($_COOKIE["marca"])) {
            setcookie("marca", $_POST["marca"], time()+3600);
        }
        //establece las dos cookie yte redirige
        //lo podriahacer todo en una sola cookie

        if (!empty($_POST["idioma"]) && !empty($_POST["marca"])) {
            //redirige automaticamente al llegar hasta esta instruccion 
            header("Location: visualizaopciones.php");
            exit(); //die() normalmente despues de las redirecciones tambien se pone esto
            //hace que no se ejecute nada mas
        }
        //por si alguien inyecta una cookie e intenta venir directamente a verificaidioma
    }else{
        //como medida de seguridad si no vengo de un post
        //borrare las cookie y redigire al inicio idioma.html
        //las cookies que yo pueda haber metido a mano se las tiene que cargar y redirigirme a inicio
        setcookie("idioma", '', time() -7200);
        setcookie("marca", '', time() -7200);
        header("Location: idioma.html");
        //esto es para que quien cargue la pagina a mano no pueda hacer diabluras
        exit();


    }