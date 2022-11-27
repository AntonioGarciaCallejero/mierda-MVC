<?php
    namespace App\Controllers;
// el controlador especifico
class LoginController
{

    //esto reemplazaria a controller.php
    function __construct()
    {
        echo "<br>Constructor clase LOGINCONTROLLER";
    }

    //index y show van a remplazar a los de controller de mvc00
    function index(){
        echo "<br>Dentro index de LOGINCONTROLLER";
        //metodo home de Controller de mvc00
        //habria que modificarlos
    }

    function show(){
        echo "<br>Dentro de show de LOGINCONTROLLER";
        //metodo show de Controller mvc00
    }

////miniejercicio crear 2 nuevos login y home dentro de controllers
//si no hay metodo asigno index
//si no hay controlador asigno home 
}//fin clase