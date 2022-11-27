<?php
namespace App\Models;
//los datos de la base de datos y los metodos que los manejan aqui

//esto es para cuando usemos PDO, hay q1ue ponerlo noserporque
use PDO;
//esto es para no tener que escribir la ruta namespace cada vez que usemos la clase Model
use Core\Model;

//ESTO IMPORTANTE
//use en namespaces:
//use const Dwes\PI; para constantes echo PI;
//use function Dwes\avisa; para funciones avisa();
//use Dwes\Prueba para clases, Prueba es una clase $prueba = new Prueba(); $prueba->probando();

//esto es desde el punto de vista de public
require_once '../core/Model.php';
//Fichero que simula el modelo con datos

//lo de que te crea un atributo con el nombre de cada campo si no los creas tu
class Product extends Model{
    

    function __construct(){
        //le decimos que lo busque en el namespace raiz
        //¿porque es el namespace raiz?
        //entiendo quesde de donde cuelgan los namespaces, el nivel mas raiz
        //hacemos un objeto fecha dicendo que lo que hemos recuperado como fecha de la base
        //lo uno son yars, lo otro meses lo otro days para que los coja y haga el objeto
        //y ese atributo convertido en objeto remplazara al atributo orginal
        //esto pasara con cada objeto de esta clase que devuelva la consulta
        //(cada vez que leemos un registro con fetch o fetchAll)
        $this->fecha_compra = \DateTime::createFromFormat('Y-m-d', $this->fecha_compra);
    }

    //uno que me devuelva todos los productos y uno que me devuelva un producto en particular
    //escribir fun
    //tabular
    //devuelve todos
    public static  function all()
    {
        $db = Product::db();
        //a ver como lo ha hecho el
        $sql = 'SELECT * FROM products';
        $sentencia = $db->prepare($sql);
        //el prepararla nos devuelve un objeto sentencia
        
        
        $sentencia->execute();
   
        //a veces hay que poner el namespace para que funcione con las comillas
        //sino asi Product::class
        $products = $sentencia->fetchAll(PDO::FETCH_CLASS, "\App\Models\Product");
        //esto nos devuelve un array de objetos products que instanciamos en products
        return $products;
    }

    //devolver un producto en particular 
    //find es estatico, con un id la consulta y el fetch te devuelve un objeto
    //de la clase producto
    public static function find($id)
    {   
        //el metodo find iba a devolver un objeto de la clase producto con el id
        $db = Product::db();
        //asi con interrogantes y numeros
        //o con bindParam o con BindValue
        $stmt = $db->prepare('SELECT * FROM products WHERE id = :id');
        //aqui podria cambiar el tipo de bindeada
        $stmt->execute(array(':id' => $id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, Product::class);
        //o asi
        $product = $stmt->fetch();
        //o con esto dentro del parentesis
        //PDO::FETCH_CLASS
        //para 1 solo sin bucle
        //para varios con bucle
        
        
        return $product;
        
    

    }
    //el metodo insert de los objetos producto
    public function insert()
{
    //crea una conexion a la base de datos y prepara y ejecuta una sentencia con los valores
    //de los atributos de ese objeto almacenandolos en la base de datos
    //ahora si est a llamando a algo estatico de la clase Product(aunque realmente pertenece a
    //la clase de la que hereda Rroduct)
    $db = Product::db();
    $stmt = $db->prepare('INSERT INTO products(name, price, fecha_compra) VALUES(:name, :price, :fecha_compra)');
    
    $stmt->bindValue(':name', $this->name);
    $stmt->bindValue(':price', $this->price);
    $stmt->bindValue(':fecha_compra', $this->fecha_compra);
    return $stmt->execute();
}

public function delete()
{
    $db = Product::db();
    $stmt = $db->prepare('DELETE FROM products WHERE id = :id');
    //delete con el id del objeto producto a cuyo metodo estamos accediendo
    $stmt->bindValue(':id', $this->id);
    //devuelve true o false segun el exito de la sentencia
    return $stmt->execute();
}

    public function save()
{
    $db = Product::db();
    $stmt = $db->prepare('UPDATE products SET name = :name, price = :price, fecha_compra = :fecha_compra WHERE id = :id');
    
    $stmt->bindValue(':id', $this->id);
    $stmt->bindValue(':name', $this->name);
    $stmt->bindValue(':price', $this->price);
    $stmt->bindValue(':fecha_compra', $this->fecha_compra);
    
    return $stmt->execute();
}

}//fin clase