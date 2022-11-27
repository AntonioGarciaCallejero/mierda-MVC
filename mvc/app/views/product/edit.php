<h1>Edición de producto</h1>
<!-- nos manda al metodo update de product controller -->
<form method="post" action="/product/update">
<!-- la id que ha recuperado la pone como input hidden porque no la va a cambiar
se queda tal cual la traiamos -->
    <input type="hidden" name="id"
    value="<?php echo $product->id ?>">

<div class="form-group">
    <label>Nombre</label>
    <!-- y esto de form-control? -->
    <input type="text" name="name" class="form-control"
    value="<?php echo $product->name ?>"
    >
</div>
<div class="form-group">
    <label>Price</label>
    <input type="text" name="price" class="form-control"
    value="<?php echo $product->price ?>"
    >
</div>

<!-- vale, lo de value ya puesto te lo pone para que te salga el valor que habia antes
como fecha_compra es un objeto no te sale nada, pero si hacemos lo de ponerle format
ahora es un string y si que nos lo coge -->
<div class="form-group">
    <label>Fecha de Compra</label>
    <input type="text" name="fecha_compra" class="form-control"
    value="<?php echo $product->fecha_compra->format('Y-m-d') ?>"
    >
</div>

<button type="submit" class="btn btn-default">Enviar</button>
</form>