<div class="col-3">
    <div class="col-sm">
        <br><br>
        <a  class="btn btn-dark" href="<?= site_url('/home')?>"><- Volver</a>
        <h1>Nuevo Producto</h1>
        <form class="fgeneral" method="post" action="<?= site_url('Administracion/guardar/')?>">
            <label>Nombre</label>
            <input type="text" name="nombre" required>
            <br><br>
            <label>SKU</label>
            <input type="text" name="sku"  required>
            <br><br>
            <label>Categoría</label>
            <input type="text" name="categoria"  required>
            <br><br>
            <label>Precio</label>
            <input type="text" name="precio" required>
            <br><br>
            <label>Descripción</label>
            <input name="descripcion" required >
            <br><br>
            <label>Codigo de Barras</label>
            <input type="text" name="codigo"  required>
            <br><br>
            <input type="submit" class="btn btn-primary" value="Guardar" name="submit"/>
        </form>
    </div>
</div>