<?php
//nosotrossolo vamos a usar datetime (concuerda con lo de Rafa)
//DateTime es una clase. una fecha va a ser un objeto de esa clase
//el localismo eso no entra
//el strftime tampoco lo vamos a ver

//hora
echo "la hora es :" . time();
//tiempo unix en segundos
//segundos desde 1970

//numero de segundos en un mes
//osease los segundos dese hasta ahora hasta dentro de un mes
echo "la hora en un mes :" . strtotime("+1 month");

//fechas : date, DateTime

//con el formato que viene especificado por esa tabla, esa tabla es importante
//dia, mes con letras, año con 2 digitos solo
echo "<br>lafecha es : " . date("d/F/y");
//2 dias numero, dos dias 
//date devuelve la fecha actual

//se puede hacer como con str to time
//asi 11 semanas desde ahora
//objeto fecha 
//FORMA DE CREAR UNA FECHA
$fecha = new DateTime("+11weeks");
echo "<br><br>";
//separados por arrobas
//una cosa es lo qur tengo, otra lo que muestro
//te lo dvueleve como string asi que puedo hacer un echo (de esto, no de $fecha suelto)
//efectovamente los cambias de sitio y cambian de siti
echo "Intento de fecha :" . $fecha->format("d@M@Y");

//OTRA FORMA DE CREAR UNA FECHA,  las dos son objeto no string hasta que no les haces el
//->
//puedo especificar un formato propio
echo "<br>Mi fecha personalizada : ";
//esto sera un objeto
//le esta indicando que es cada cosa aun luego el orden se lo pasara por el forro y lo pondra
//con el por defecto
//parece que aqui no podemos sustituirle las barras por arrobas
$mifecha = Datetime::createFromFormat("d/m/Y","09/07/2018");
//por defecto se crea el tipo americano
var_dump($mifecha);
//ahora si en ese orden y con esos separadores
echo "IFecha em español :" . $mifecha->format("j-n-Y");




//si no damos formato las fechas se mostraran con el parseo de mysql
//Si es tipo Date: año-mes-dia
//Si es DateTime: año:mes-dia h:m:s
