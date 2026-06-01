<?php
$stockStatusColor = function(array $p): string {
    if ($p['stock'] === 0)                return 'danger';
    if ($p['stock'] <= $p['stock_min'])   return 'warning';
    return 'success';
};
$stockLabel = function(array $p): string {
    if ($p['stock'] === 0)              return 'Out of Stock';
    if ($p['stock'] <= $p['stock_min']) return 'Low Stock';
    return 'In Stock';
};
?>

<h1 class="h3 fw-bold mb-4">Dashboard</h1>

<!-- Metric Cards -->
<div class="row g-3 mb-4">

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?= esc((string) $stats['total']) ?></div>
                    <div class="text-muted small">Total Products</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">$<?= number_format($stats['value'], 2) ?></div>
                    <div class="text-muted small">Inventory Value</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?= esc((string) $stats['low_stock']) ?></div>
                    <div class="text-muted small">Low Stock Alerts</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="bi bi-tags"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?= esc((string) $stats['categories']) ?></div>
                    <div class="text-muted small">Categories</div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Low Stock Alerts -->
<?php if (!empty($lowStock)): ?>
<div class="card mb-4">
    <div class="card-header bg-white py-3 d-flex align-items-center gap-2">
        <i class="bi bi-exclamation-triangle-fill text-warning"></i>
        <span class="fw-semibold">Low Stock Alerts</span>
        <span class="badge bg-warning text-dark ms-1"><?= count($lowStock) ?></span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Min</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lowStock as $p): ?>
                <tr>
                    <td class="fw-medium"><?= esc($p['nombre']) ?></td>
                    <td><code><?= esc($p['sku']) ?></code></td>
                    <td><?= esc($p['categoria']) ?></td>
                    <td class="fw-semibold text-<?= $p['stock'] === 0 ? 'danger' : 'warning' ?>">
                        <?= esc((string) $p['stock']) ?>
                    </td>
                    <td class="text-muted"><?= esc((string) $p['stock_min']) ?></td>
                    <td>
                        <span class="badge stock-badge bg-<?= $stockStatusColor($p) ?>">
                            <?= $stockLabel($p) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= site_url('/administracion/editar/' . $p['producto_id']) ?>"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<div class="card mb-4">
    <div class="card-body py-4 text-center text-muted">
        <i class="bi bi-check-circle-fill text-success fs-4 d-block mb-2"></i>
        All products are well stocked.
    </div>
</div>
<?php endif ?>

<!-- Quick Actions -->
<div class="row g-3">
    <div class="col-sm-4">
        <a href="<?= site_url('/products') ?>" class="card p-3 text-decoration-none text-dark">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-grid fs-4 text-primary"></i>
                <span class="fw-medium">View all products</span>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <a href="<?= site_url('/administracion/nuevo') ?>" class="card p-3 text-decoration-none text-dark">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-plus-circle fs-4 text-success"></i>
                <span class="fw-medium">Add a product</span>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <a href="<?= site_url('/products/export') ?>" class="card p-3 text-decoration-none text-dark">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-download fs-4 text-secondary"></i>
                <span class="fw-medium">Export inventory CSV</span>
            </div>
        </a>
    </div>
</div>
