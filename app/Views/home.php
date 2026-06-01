<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0 fw-bold">Products</h1>
    <a href="<?= site_url('/administracion/nuevo') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add Product
    </a>
</div>

<?php if (!empty($products) && is_array($products)): ?>

    <div class="row g-3 mb-3">
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" id="searchInput" class="form-control border-start-0 ps-0"
                       placeholder="Search by name, SKU or category…">
            </div>
        </div>
        <div class="col-auto d-flex align-items-center product-count">
            <span id="productCount"><?= count($products) ?></span>&nbsp;product<?= count($products) !== 1 ? 's' : '' ?>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="productsTable">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Barcode</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="fw-medium"><?= esc($product['nombre']) ?></td>
                        <td><code><?= esc($product['sku']) ?></code></td>
                        <td>
                            <span class="badge rounded-pill bg-secondary badge-category">
                                <?= esc($product['categoria']) ?>
                            </span>
                        </td>
                        <td class="fw-semibold">$<?= number_format((float) $product['precio'], 2) ?></td>
                        <td class="text-muted" style="max-width:220px">
                            <span title="<?= esc($product['descripcion']) ?>">
                                <?= esc(mb_strimwidth($product['descripcion'], 0, 45, '…')) ?>
                            </span>
                        </td>
                        <td><small><?= esc($product['codigo_de_barras']) ?></small></td>
                        <td class="text-center">
                            <a href="<?= site_url('/administracion/editar/' . $product['producto_id']) ?>"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    (() => {
        const input   = document.getElementById('searchInput');
        const counter = document.getElementById('productCount');
        const rows    = document.querySelectorAll('#productsTable tbody tr');

        input.addEventListener('input', () => {
            const q = input.value.toLowerCase().trim();
            let visible = 0;
            rows.forEach(row => {
                const match = row.textContent.toLowerCase().includes(q);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            counter.textContent = visible;
        });
    })();
    </script>

<?php else: ?>
    <div class="text-center empty-state">
        <i class="bi bi-box-seam"></i>
        <p class="h5 mb-1">No products yet</p>
        <p class="mb-3 text-muted">Get started by adding your first product.</p>
        <a href="<?= site_url('/administracion/nuevo') ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Add Product
        </a>
    </div>
<?php endif ?>
