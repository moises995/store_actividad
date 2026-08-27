<div class="mb-3">
    <a href="<?= site_url('/products') ?>" class="text-decoration-none text-muted">
        <i class="bi bi-arrow-left me-1"></i>Back to Products
    </a>
</div>

<?php if (!empty($product) && is_array($product)): ?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">

        <div class="card mb-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold"><i class="bi bi-pencil me-2 text-primary"></i>Edit Product</h4>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">ID #<?= esc((string) $product['producto_id']) ?></span>
                    <a href="<?= site_url('/products/barcode/' . $product['producto_id']) ?>"
                       class="btn btn-outline-secondary btn-sm" target="_blank">
                        <i class="bi bi-upc-scan me-1"></i>Barcode
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="post"
                      action="<?= site_url('/administracion/update/' . $product['producto_id']) ?>"
                      novalidate>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-medium">Name <span class="text-danger">*</span></label>
                        <input type="text" id="nombre" name="nombre" class="form-control"
                               value="<?= esc($product['nombre']) ?>" required maxlength="255">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="sku" class="form-label fw-medium">SKU <span class="text-danger">*</span></label>
                            <input type="text" id="sku" name="sku" class="form-control"
                                   value="<?= esc($product['sku']) ?>" required maxlength="25">
                        </div>
                        <div class="col-sm-6">
                            <label for="categoria" class="form-label fw-medium">Category <span class="text-danger">*</span></label>
                            <input type="text" id="categoria" name="categoria" class="form-control"
                                   value="<?= esc($product['categoria']) ?>" required maxlength="50">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-4">
                            <label for="precio" class="form-label fw-medium">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="precio" name="precio" class="form-control"
                                       value="<?= esc($product['precio']) ?>" required min="0.01" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="stock" class="form-label fw-medium">Stock <span class="text-danger">*</span></label>
                            <input type="number" id="stock" name="stock" class="form-control"
                                   value="<?= esc((string) $product['stock']) ?>" required min="0">
                        </div>
                        <div class="col-sm-4">
                            <label for="stock_min" class="form-label fw-medium">Min Stock <span class="text-danger">*</span></label>
                            <input type="number" id="stock_min" name="stock_min" class="form-control"
                                   value="<?= esc((string) $product['stock_min']) ?>" required min="0">
                            <div class="form-text">Low-stock alert threshold</div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <label for="codigo" class="form-label fw-medium">Barcode <span class="text-danger">*</span></label>
                            <input type="text" id="codigo" name="codigo" class="form-control"
                                   value="<?= esc($product['codigo_de_barras']) ?>" required maxlength="255">
                        </div>
                        <div class="col-sm-6">
                            <label for="descripcion" class="form-label fw-medium">Description <span class="text-danger">*</span></label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control"
                                   value="<?= esc($product['descripcion']) ?>" required maxlength="255">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i>Save Changes
                        </button>
                        <a href="<?= site_url('/products') ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>

        <!-- Danger zone -->
        <div class="card border-danger">
            <div class="card-body p-3 d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 fw-medium text-danger">Danger zone</p>
                    <p class="mb-0 text-muted small">Deactivates this product. It will no longer appear in the list.</p>
                </div>
                <form method="post"
                      action="<?= site_url('/administracion/delete/' . $product['producto_id']) ?>"
                      onsubmit="return confirm('Delete <?= esc($product['nombre'], 'js') ?>? This cannot be undone.')">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash me-1"></i>Delete
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php else: ?>
<div class="text-center empty-state">
    <i class="bi bi-question-circle"></i>
    <p class="h5 mt-2 mb-1">Product not found</p>
    <a href="<?= site_url('/products') ?>" class="btn btn-primary mt-2">Back to Products</a>
</div>
<?php endif ?>
