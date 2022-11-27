<?php
    if(isset($_COOKIE["idioma"]) && isset($_COOKIE["marca"])){
        //existen cookies
        $idioma = $_COOKIE["idioma"];
        $marca = $_COOKIE["marca"];

        $mensajeidio = "";
        $mensajecoche = "";
        //dependiendo de lo que haya en idioma elegiremos una mierda u otra
        switch($idioma){
            case "es":
                $mensajeidio = "Bienvenido, querido usuario";
                $mensajecoche = "Tu marca de coche favorita es :";
            break;
            case "en":
                $mensajeidio = "Welcome dear user.";
                $mensajecoche = "Your favourite car brand is : ";
            break;

            case "de":
                $mensajeidio = "Wilcomen lieber beutzner.";
                $mensajecoche = "du hams du hams du hamster : ";
            break;
            default:
            //aqui es lo de que por defecto se mostrara español
            $mensajeidio = "Bienvenido, querido usuario";
            $mensajecoche = "Tu marca de coche favorita es :";
        }

        //y luego mostraremos concatenados
        $mensajecoche = $mensajecoche . $marca;

        echo "<h2>" . $mensajeidio . "</h2>";
        echo "<h2>" . $mensajecoche . "</h2>";
    }else{
        //no existen cookies
        //esto lo ha quitado porque si no tengo cookies no tiene sentido anularlas aunque lo podria dejar
        //(las dos primeras lineas)
        setcookie("idioma", '', time() -7200);
        setcookie("marca", '', time() -7200);
        //como no hay cookies te sale esto
        echo "<h3>Debe seleccionar algunos datos </h3>";
        echo "<a href=\"idoma.html\">Volver al inicio</a>";
    }