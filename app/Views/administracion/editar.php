<div class="mb-3">
    <a href="<?= site_url('/home') ?>" class="text-decoration-none text-muted">
        <i class="bi bi-arrow-left me-1"></i>Back to Products
    </a>
</div>

<?php if (!empty($product) && is_array($product)): ?>

<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold"><i class="bi bi-pencil me-2 text-primary"></i>Edit Product</h4>
                <span class="text-muted small">ID #<?= esc((string) $product['producto_id']) ?></span>
            </div>
            <div class="card-body p-4">
                <form method="post"
                      action="<?= site_url('/administracion/update/' . $product['producto_id']) ?>"
                      novalidate>

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
                        <div class="col-sm-6">
                            <label for="precio" class="form-label fw-medium">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="precio" name="precio" class="form-control"
                                       value="<?= esc($product['precio']) ?>" required min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="codigo" class="form-label fw-medium">Barcode <span class="text-danger">*</span></label>
                            <input type="text" id="codigo" name="codigo" class="form-control"
                                   value="<?= esc($product['codigo_de_barras']) ?>" required maxlength="255">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="form-label fw-medium">Description <span class="text-danger">*</span></label>
                        <input type="text" id="descripcion" name="descripcion" class="form-control"
                               value="<?= esc($product['descripcion']) ?>" required maxlength="255">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i>Save Changes
                        </button>
                        <a href="<?= site_url('/home') ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>

        <div class="card shadow-sm mt-3 border-danger">
            <div class="card-body p-3 d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 fw-medium text-danger">Danger zone</p>
                    <p class="mb-0 text-muted small">This will deactivate the product. This action cannot be undone.</p>
                </div>
                <a href="<?= site_url('/administracion/delete/' . $product['producto_id']) ?>"
                   class="btn btn-outline-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this product? This cannot be undone.')">
                    <i class="bi bi-trash me-1"></i>Delete Product
                </a>
            </div>
        </div>

    </div>
</div>

<?php else: ?>
    <div class="text-center empty-state">
        <i class="bi bi-question-circle"></i>
        <p class="h5 mb-1">Product not found</p>
        <a href="<?= site_url('/home') ?>" class="btn btn-primary mt-2">Back to Products</a>
    </div>
<?php endif ?>
