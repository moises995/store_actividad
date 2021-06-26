<div class="col-sm">
<br><br>
<a href="/administracion/nuevo" class="btn btn-primary" title="Agregar producto nuevo">+ Nuevo</a>
<div class="col-sm">
<br><br>
    <?php if(!empty($productos) && is_array($productos)): ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Codigo de barras</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($productos as $prodcuto):?>
                <tr>
                    <td><?=$prodcuto['nombre']?></td>
                    <td><?=$prodcuto['sku']?></td>
                    <td><?=$prodcuto['categoria']?></td>
                    <td><?=$prodcuto['precio']?></td>
                    <td><?=$prodcuto['descripcion']?></td>
                    <td><?=$prodcuto['codigo_de_barras']?></td>
                    <td><a title="Editar producto" class="btn btn-primary" href="/administracion/editar/<?=$prodcuto['producto_id']?>">Editar</a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php else : ?>
        <div class="p-5 mtb-3 ta-center">
                <p>
                        No hay registros. <br/>
                </p>
        </div>
    <?php endif ?>
</div>
</div>