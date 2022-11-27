<h1>Alta de Producto</h1>

<!-- el formulario insert va a mandar al metodo store de ProductController -->
<form method="post" action="/product/store">


<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="name" class="form-control">
</div>
<div class="form-group">
    <label>Precio</label>
    <input type="text" name="price" class="form-control">
</div>
<div class="form-group">
    <label>Fecha de Compra</label>
    <input type="text" name="fecha_compra" class="form-control">
</div>
<button type="submit" class="btn btn-default">Enviar</button>
</form>