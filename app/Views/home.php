<div class="col-sm">
<br><br>
<a href="<?= site_url('/administracion/nuevo') ?>" class="btn btn-primary" title="Agregar producto nuevo">+ Nuevo</a>
<div class="col-sm">
<br><br>
    <?php if (!empty($products) && is_array($products)): ?>
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
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['nombre'] ?></td>
                    <td><?= $product['sku'] ?></td>
                    <td><?= $product['categoria'] ?></td>
                    <td><?= $product['precio'] ?></td>
                    <td><?= $product['descripcion'] ?></td>
                    <td><?= $product['codigo_de_barras'] ?></td>
                    <td>
                        <a title="Editar producto" class="btn btn-primary"
                           href="<?= site_url('/administracion/editar/' . $product['producto_id']) ?>">
                            Editar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="p-5 mtb-3 ta-center">
            <p>No hay registros.</p>
        </div>
    <?php endif ?>
</div>
</div>
