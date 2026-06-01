<?php if ($product === null): ?>
<div class="text-center empty-state">
    <i class="bi bi-upc-scan"></i>
    <p class="h5 mt-2">Product not found</p>
    <a href="<?= site_url('/products') ?>" class="btn btn-primary mt-2">Back to Products</a>
</div>
<?php else: ?>

<style>
    @media print {
        .navbar, .container > .alert, .no-print { display: none !important; }
        .barcode-card { box-shadow: none; border: 1px solid #ccc; }
        body { background: white; }
    }
</style>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-5">

        <div class="d-flex justify-content-between align-items-center mb-3 no-print">
            <a href="<?= site_url('/products') ?>" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left me-1"></i>Back to Products
            </a>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-printer me-1"></i>Print
            </button>
        </div>

        <div class="card barcode-card text-center p-4">
            <p class="fw-bold fs-5 mb-1"><?= esc($product['nombre']) ?></p>
            <p class="text-muted mb-3"><code><?= esc($product['sku']) ?></code>
                &nbsp;·&nbsp; $<?= number_format((float) $product['precio'], 2) ?>
            </p>
            <div class="d-flex justify-content-center mb-2">
                <?= $barcode ?>
            </div>
            <small class="text-muted"><?= esc($product['codigo_de_barras']) ?></small>
        </div>

    </div>
</div>
<?php endif ?>
