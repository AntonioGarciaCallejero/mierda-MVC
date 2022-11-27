<?php
    namespace Dwes\Galaxias;
    //lo namespace se pueden direccionar de 3 maneras
    //acceso no cualificado, cuali
    // el namespace debe ser la siguiente instruccion a php
    //como estoyt hablando de namespace la primera en mayuscula
    //barra hacia la izda como la de windows

    //estan mierdas estan en el fichero no en la clase
    //estan al mismo nivel que la clase en el namespace
    const RADIO = 1.25; //millone de años luz

    function observar($mensaje){
        echo "<br>Estoy mirando a la galaxia " . $mensaje;
    }


class Galaxia{

    function __construct()
    {
        $this->nacimiento();
    }

    function nacimiento(){
        echo "<br>Soy una nueva galaxia";
    }

    static function  muerte(){
        echo "<br>Me destruyo!!";
    }

    function __toString()
    {
        //cuando haga un echo del objeto saldra esto
        return "esto son galaxias superiores";
    }

}