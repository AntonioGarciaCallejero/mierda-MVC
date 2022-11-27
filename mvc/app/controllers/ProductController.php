<?php
    namespace App\Controllers;
    //o le pones el namespace cada vez que lo uses o lo pones aqui asi una vez
    use App\Models\Product;
 
    
// EL CONTROLADOR ESPECIFICO

require_once "../app/models/Product.php";


//a pesar de los namespaces hay que requerirlo, y ahora esta en otro sitio, ¿puede ser eso?

class ProductController
{

    
    function __construct()
    {
       
    }

    
    function index(){
        
        $products = Product::all();
        //tenemos el array de productos
        //y una vista en la que lo recorremos mostrandolo
        
        require('../app/views/product/index.php');
        
    }

    //un controlador no tiene sacar echos, tiene que invocar a las vistas
    //y que muestren ellas cosas
    public function show($args)
{
    //hace eso porque lo que nos viene es un array, efectivamente
    //args es un array, tomamos el id con uno de estos métodos
    //o asi
    // $id = (int) $args[0];
    //probemos a pasarle el id como int luego
    //el args seria para pasarle varios parametros

    //es un metodo 
    
    //o asi
    // $id = $args[0];
    //hasta aqui llegamos bien
    //o asi
    $id = $args[0];
    //podriamos poner directamente $args[0] en el find()
    $product = Product::find($id);

    require('../app/views/product/show.php');        
}

//-----------------------------NUEVOS METODOS
public function create()
{
    require '../app/views/product/create.php';
}

public function store()
{

    //esto es como si formulario nos lo pasase por  $_POST
    //aunque es interesante lo de que fusiona $_COOKIE, $_POST y $_GET
    //instancia un nuevo objeto producto
    //les da a sus atributos el valor de la mierda que vendra del formulario
    //y ejecuta el metodo insert del producto(veremos)
    //el metodo store va a instanciar un objeto producto con los valores del formulario
    $product = new Product();
    $product->name = $_REQUEST['name'];
    $product->price = $_REQUEST['price'];
    $product->fecha_compra = $_REQUEST['fecha_compra'];
    //seguir adelante
    //y deese objeto producto va a llamar el metodo insert
    $product->insert();
    //llega hasta aqui e inserta los penes sin fallar
    header('Location:/product');
}

//edit va a recibir el id como parametro
//y va a usar el metodo find que le devolvera un objeto con ese id y los datos de la consulta
//despues mostrara la vista edit
public function edit($arguments)
{
    $id = (int) $arguments[0];
    $product = Product::find($id);
    require '../app/views/product/edit.php';
    //recupera un producto y llama a vista edit
    
}
//ibamos por aqui


public function update()
{
    //esto coge lo que viene del formulario edit
    //y lo usa para actualizar el objeto que recupera con la id que le viene del edit
    //y despues usa el metodo save de ese objeto lo que guarda sus datos(que ahora son los nuevos)
    //en la base de datos
    $id = $_REQUEST['id'];
    $product = Product::find($id);
    $product->name = $_REQUEST['name'];
    $product->price = $_REQUEST['price'];
    $product->fecha_compra = $_REQUEST['fecha_compra'];
    //va coger los datos del formulario, los va a meter en el objeto y lo va a mandar al metodo
    //save que los guardara en la base de datos updateandeo
    $product->save();
    //y ahora nos vamosa al ProductController y como no hay metodo sera el por defecto
    header('Location:/product');
}

//delete en el controlador
//aqui llega el parametro de la url
public function delete($arguments)
{
    //usa el id para sacar un objeto product y despues se lo pasa 
    //al delete del modelo que lo borra de la base de datos(usando solo el id, no haria falta mas en verdad)
  $id = (int) $arguments[0];
  $product = Product::find($id);
  //va a coger un producto con el id y va a usar en él el metodo delete del modelo
  $product->delete();
  header('Location:/product');
}




}//fin clase
