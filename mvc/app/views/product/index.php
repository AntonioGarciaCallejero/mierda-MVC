<h1>Lista de productos</h1>

<table class="table table-striped table-hover">
  <tr>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Fecha de Compra</th>
  </tr>
  
  <!-- y recorro el array -->
  <?php foreach ($products as $key => $product) { ?>
    <tr>
    <td><?php echo $product->name ?></td>
    <td><?php echo $product->price ?></td>
    <td><?php echo $product->fecha_compra->format('Y-m-d') ?></td>
    <td>
      <!-- lo que no esta  funcionando pues es esto al parecer -->
      <a href="/product/show/<?php echo $product->id ?>" class="btn btn-primary">Ver <?php echo $product->id ?> </a>
      <a href="/product/edit/<?php echo $product->id ?>" class="btn btn-primary">Editar <?php echo $product->id ?></a>
      <a href="/product/delete/<?php echo $product->id ?>" class="btn btn-primary">Borrar <?php echo $product->id ?></a>
    </td>
    </tr>
    <!-- esto era la forma esta raruna de cerrar cosas el bucle yel trozo de php al mismo tiempo -->
  <?php } ?>
</table>

<a href="/product/create" class="btn btn-primary">Click Aqui para insertar Nuevo Producto</a>