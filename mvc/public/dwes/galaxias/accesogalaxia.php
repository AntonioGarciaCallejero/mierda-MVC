<?php

//namespace lo primero despues de php
    namespace Dwes\Galaxias;
//ese seria el namespace de este fichero
 
//las cosas magicas suelen llevar guiones delante
    echo "<br> Namespace actual : " . __NAMESPACE__;


/*
no rayarse con esto
DIreccionamiento namespace:
1Sin direccionamient
al mismo nivel que el fichero que voy a requerir
2dirccionamiento relativo
3direccionamiento absoluto

*/ 
//vale aqui si que puedo usar las rutas con normalidad porque estoy dentro de public
//include o require
include "galaxia1.php";
include "pegaso/pegaso.php";
//creo que el include require lo hacemos igual, los namespaces son para que no haya colisiones

//alias de constantes
use const \Dwes\Galaxias\RADIO as RGALAX;
use const \Dwes\Galaxias\Pegaso\RADIO as RPEGASO;

//SE PUEDEN HACER ALIAS A NIVEL DE ELEMENTO O DE NAMESPACE(noseque coño significa eso,
//pero me importa una mierda)

//cuando traemos varios RADIOs de distintos sitios hay que usar el ALIAS
//o solo te coge el ultimo use que hayas hecho
//no, la clase no porque si fuera asi tendria que indicar antes el namespace Pegaso tambie
//esto es un alias de la ruta deL namespace Pegaso
//en este caso no esta useando una clase, esta useando una ruta de namespace
use \Dwes\Galaxias\Pegaso as CABALLITO;

//esto es que cuando estamos dentro del mismo namespace podemos usar las cosas
//solo nombrandolas, sin ponerles ruta namespace
//mismo namespace es en la misma carpeta como si estuvieran flotando ahi todos los elementos
//porque que esten en distintos ficheros no cuenta para los namspaces
echo "<h2>Sin direccionamiento</h2>";
//necesito incluir el fichero con el que voy a trabajr
echo "<br>Radio de la galaxia : " . RADIO;
//esto de debajo es un ejemplo del alias
 //y asi le indicamos que queremos coger el RADIO  que se encuentra en la ruta
 //del namespace Pegaso  

echo "<br>Radio ULTIMO : " . CABALLITO\RADIO;
$gl = new Galaxia();
Galaxia::muerte();


//el namespace indica carpetas, no ficheros
//y por ultimo, el elemento que queremos usar, de cualquiera de los ficheros que hay dentro de ese namespace
//si hubiera dos funciones o constantes iguales o lo que fuera habria que diferenciarlas en 2
//namespaces distintos dentro de su nivel(o idicar la clase?nose)

//IMPORTANTE
//FORMAS DE USEAR LAS MIERDAS
// use const Dwes\PI; //OJO use const
// echo PI;

// use function Dwes\avisa; //OJO use function
// avisa();

//OJO CON ESTA porque aqui esta usando una clase pero
// podria confundirse con una ruta de namespace, lo distinguiremos por
//por la ruta y los nombre
// use Dwes\Prueba;  //OJO use (nada más)
// $prueba = new Prueba();
// $prueba->probando();

//--------------------------------------------------------------------------------

echo "<h2>Direccionamiento Relativo</h2>";
//navego a partir de mi ubicacion actual

//me estoy moviendo a partir de donde se encuentra este fichero

//desdee mi ubicacion actual
//necesito incluir el fichero con el que voy a trabajr
//estoy en el nivel donde esta pegaso ques un nivel mas, asi que le digo que se vaya a Pegaso
//y uso las mierdas
//estoy en el nivel en el que se encuentra el namespace/(carpeta en este caso tambie) Pegaso
//asi que le digo que vaya por ahi y coja la constante RADIO (direccionamiento relativo)
echo "<br>Radio de la galaxia : " . Pegaso\RADIO;
//lo mismo pero uso el metodo observar
Pegaso\observar("Pegaso");

//nueva instancia de la clase Galaxia que sencuentra en el namespace Pegaso(direccionamiento relativo)
//no deberia hacer falta esta linea para hacer lo de debajo, nose
$gl = new Pegaso\Galaxia(); //esto lo hago para que al ejecutar el constructo se ejecute
//la funcion echo que es un atributo mostrando el mensaje
//y no hace falta, no tienen nada que ver lo uno con lo otro
//acceso a elemento estatico
Pegaso\Galaxia::muerte();
//desde donde estoy (en alguna parte de los namespaces) voy a donde esta la wea
//referencia a la clase Galaxia (que no fichero) dentro del namespace Pegaso
//y acceso a su metodo estatico muerte()




//desde raiz del servidor web que es public
//navego a partir de mi ubicacion actual

//me estoy moviendo a partir de donde se encuentra este fichero

//desde el driectori o raiz del servidor web
//entiendo que la raiz del namespace es la carpeta de la que cuelga el primer nodo
//de todo el entramado del namespace
//necesito incluir el fichero con el que voy a trabajr
//(esto lo he puesto varias veces pero eso, que el namespace no sustituye a include/require sino que es una
//forma de envitar colisiones)
echo "<h2>Direccionamiento Absoluto</h2>";
//parece que el namespace no te indicia el fichero, solo el directorio (para eso esta el include/require)
echo "<br>Radio de la galaxia : " . \Dwes\Galaxias\Pegaso\RADIO;
\Dwes\Galaxias\Pegaso\observar("Pegaso");
//direccionamiento absoluto, pues desde el namespace raiz

$gl = new \Dwes\Galaxias\Pegaso\Galaxia();
\Dwes\Galaxias\Pegaso\Galaxia::muerte();
//lo otro que habia por ahi eraq ponerle un alias a una ruta de namespace para abreviar
//esto es que haces asi el use este
//y ya no te hace falta poner el namespace entero cada vez que llames al radio
//solo te hace falta poner RADIO
 use const \Dwes\Galaxias\Pegaso\RADIO;
echo "<br> radio es " . RADIO;


use function \Dwes\Galaxias\Pegaso\observar;
//aqui esta useando la clase Galaxia
//que esta dentro del fichero galaxia1
//para que veas que hace referemcia ala clase, no al fichero
use \Dwes\Galaxias\Galaxia;

echo "<br>el radio es : " .RADIO;
echo "<br>el radio es : " . observar("Otra galaxia");
echo "<br>objeto de galaxia generico: " . new Galaxia();


//Apodar namespace -> alias
//la clase Galaxia de un namespace como Seiya
use \Dwes\Galaxias\Pegaso\Galaxia as Seiya;
//y la clase Galaxia de otro namespacve como Galaxus
use \Dwes\Galaxias\Galaxia as Galaxus;
//y asi podemos usar 2 clases Galaxia de 2 requires(ubicaciones) distintas
//sinque colisiones por llamarse igual y sin tener que ponerles el tocho del namespace


echo "<br><br>";
$pg = new Seiya();
$glc = new Galaxus();

// Seiya\observar("Observando a Seiya);
// Galaxus\observar("Observando a Galaxus");