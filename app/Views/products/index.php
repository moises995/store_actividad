<?php
$sortUrl = function(string $col) use ($sort, $dir, $category): string {
    $newDir = ($sort === $col && $dir === 'asc') ? 'desc' : 'asc';
    return site_url('/products?' . http_build_query([
        'sort'     => $col,
        'dir'      => $newDir,
        'category' => $category,
    ]));
};
$sortIcon = function(string $col) use ($sort, $dir): string {
    if ($sort !== $col) return '<i class="bi bi-chevron-expand sort-icon"></i>';
    $icon = $dir === 'asc' ? 'bi-chevron-up' : 'bi-chevron-down';
    return "<i class=\"bi {$icon} sort-icon active\"></i>";
};
$stockColor = function(array $p): string {
    if ($p['stock'] === 0)              return 'danger';
    if ($p['stock'] <= $p['stock_min']) return 'warning';
    return 'success';
};
$stockLabel = function(array $p): string {
    if ($p['stock'] === 0)              return 'Out of Stock';
    if ($p['stock'] <= $p['stock_min']) return 'Low Stock';
    return 'In Stock';
};
?>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h1 class="h3 mb-0 fw-bold">Products</h1>
    <a href="<?= site_url('/administracion/nuevo') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add Product
    </a>
</div>

<!-- Filter bar -->
<form method="get" action="<?= site_url('/products') ?>" class="row g-2 mb-3 align-items-center">
    <div class="col-sm-auto">
        <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= esc($cat['categoria']) ?>"
                    <?= $category === $cat['categoria'] ? 'selected' : '' ?>>
                    <?= esc($cat['categoria']) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <input type="hidden" name="sort" value="<?= esc($sort) ?>">
    <input type="hidden" name="dir"  value="<?= esc($dir) ?>">
    <?php if ($category): ?>
        <div class="col-sm-auto">
            <a href="<?= site_url('/products') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-x me-1"></i>Clear filter
            </a>
        </div>
    <?php endif ?>
    <div class="col-sm-auto ms-auto">
        <a href="<?= site_url('/products/export') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-download me-1"></i>Export CSV
        </a>
    </div>
</form>

<?php if (!empty($products)): ?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th><a href="<?= $sortUrl('nombre') ?>" class="sort-link">
                        Name <?= $sortIcon('nombre') ?></a></th>
                    <th><a href="<?= $sortUrl('sku') ?>" class="sort-link">
                        SKU <?= $sortIcon('sku') ?></a></th>
                    <th><a href="<?= $sortUrl('categoria') ?>" class="sort-link">
                        Category <?= $sortIcon('categoria') ?></a></th>
                    <th><a href="<?= $sortUrl('precio') ?>" class="sort-link">
                        Price <?= $sortIcon('precio') ?></a></th>
                    <th><a href="<?= $sortUrl('stock') ?>" class="sort-link">
                        Stock <?= $sortIcon('stock') ?></a></th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td class="fw-medium"><?= esc($product['nombre']) ?></td>
                    <td><code><?= esc($product['sku']) ?></code></td>
                    <td>
                        <a href="<?= site_url('/products?' . http_build_query(['category' => $product['categoria']])) ?>"
                           class="badge rounded-pill bg-secondary text-decoration-none">
                            <?= esc($product['categoria']) ?>
                        </a>
                    </td>
                    <td class="fw-semibold">$<?= number_format((float) $product['precio'], 2) ?></td>
                    <td>
                        <span class="badge stock-badge bg-<?= $stockColor($product) ?>">
                            <?= $stockLabel($product) ?>
                        </span>
                        <small class="text-muted ms-1"><?= esc((string) $product['stock']) ?></small>
                    </td>
                    <td class="text-muted" style="max-width:200px">
                        <span title="<?= esc($product['descripcion']) ?>">
                            <?= esc(mb_strimwidth($product['descripcion'], 0, 40, '…')) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="<?= site_url('/administracion/editar/' . $product['producto_id']) ?>"
                               class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= site_url('/products/barcode/' . $product['producto_id']) ?>"
                               class="btn btn-sm btn-outline-secondary" title="Print barcode" target="_blank">
                                <i class="bi bi-upc-scan"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<?php if ($pager): ?>
    <div class="d-flex justify-content-center mt-3">
        <?= $pager->links('default', 'bootstrap_5') ?>
    </div>
<?php endif ?>

<?php else: ?>
<div class="text-center empty-state">
    <i class="bi bi-box-seam"></i>
    <p class="h5 mt-2 mb-1">No products found</p>
    <?php if ($category): ?>
        <p class="text-muted mb-3">No products in category "<?= esc($category) ?>".</p>
        <a href="<?= site_url('/products') ?>" class="btn btn-outline-secondary me-2">Clear filter</a>
    <?php else: ?>
        <p class="text-muted mb-3">Get started by adding your first product.</p>
    <?php endif ?>
    <a href="<?= site_url('/administracion/nuevo') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add Product
    </a>
</div>
<?php endif ?>
