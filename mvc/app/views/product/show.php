

<h1>Detalle del Producto <?php echo $product->id ?></h1>

<ul>
    <li><strong>Id: </strong><?php echo $product->id ?></li>
    <li><strong>Nombre: </strong><?php echo $product->name ?></li>
    <li><strong>Type_id: </strong><?php echo $product->type_id ?></li>
    <li><strong>Precio: </strong><?php echo $product->price ?></li>
    <!-- ahora la fecha es un objeto y si hacemos esto accedemos a su  atributo como
    string con este formato -->
    <li><strong>F. compra: </strong><?php echo $product->fecha_compra->format('Y-m-d') ?></li>
</ul>