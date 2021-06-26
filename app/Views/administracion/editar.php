<div class="col-3">
    <div class="col-sm">
        <br><br>
        <a  class="btn btn-dark" href="<?= site_url('/home')?>"><- Volver</a>
        <h1>Edición de producto</h1>
        <?php if(!empty($producto) && is_array($producto)): ?>
            <div>
                <form class="fgeneral" method="post" action="<?= site_url('Administracion/update/').$producto['producto_id']?>">
                    <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" required value='<?=$producto['nombre']?>'>
                                <br><br>
                                <label>SKU</label>
                                <input type="text" name="sku" required value='<?=$producto['sku']?>'>
                                <br><br>
                                <label>Categoría</label>
                                <input type="text" name="categoria" required value='<?=$producto['categoria']?>'>
                                <br><br>
                                <label>Precio</label>
                                <input type="text" name="precio" required value='<?=$producto['precio']?>'>
                                <br><br>
                                <label>Descripción</label>
                                <input name="descripcion" required value='<?=$producto['descripcion']?>'>
                                <br><br>
                                <label>Codigo de Barras</label>
                                <input type="text" name="codigo" required value='<?=$producto['codigo_de_barras']?>'>
                                <br><br>
                                <input  class="btn btn-primary" type="submit" class="gbutton" value="Guardar" name="submit"/>
                    </div>
                </form>
            </div>
            <a href="<?= site_url('Administracion/delete/').$producto['producto_id']?>">Eliminar producto</a>
            <?php else : ?>
            <div class="p-5 mtb-3 ta-center">
                    <p>
                            No hay registros. <br/>
                    </p>
            </div>
        <?php endif ?>
    </div>
</div>

