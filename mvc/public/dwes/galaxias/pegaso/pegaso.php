<?php
    namespace Dwes\Galaxias\Pegaso;
    //lo namespace se pueden direccionar de 3 maneras
    //acceso no cualificado, cuali
    // el namespace debe ser la siguiente instruccion a php
    //como estoyt hablando de namespace la primera en mayuscula
    //barra hacia la izda como la de windows

//puedo tener clases y funciones que se llamen igual porque pertenece nadiferente namespace
    const RADIO = 0.75; //millone de años luz

    function observar($mensaje){
        echo "<br>Estoy DIRIGIENDOME a la galaxia " . $mensaje;
    }


class Galaxia{

    function __construct()
    {
        $this->nacimiento();
    }

    function nacimiento(){
        echo "<br>Soy una GALAXIA NUEVA";
    }

    static function  muerte(){
        echo "<br>Me ESTOY DESTRUYENDO!!";
    }
    
    

}