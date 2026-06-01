<div class="mb-3 no-print">
    <a href="<?= site_url('/products') ?>" class="text-decoration-none text-muted">
        <i class="bi bi-arrow-left me-1"></i>Back to Products
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold"><i class="bi bi-plus-circle me-2 text-primary"></i>New Product</h4>
            </div>
            <div class="card-body p-4">
                <form method="post" action="<?= site_url('/administracion/guardar') ?>" novalidate>

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-medium">Name <span class="text-danger">*</span></label>
                        <input type="text" id="nombre" name="nombre" class="form-control"
                               placeholder="e.g. Blue Shirt Medium" required maxlength="255">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="sku" class="form-label fw-medium">SKU <span class="text-danger">*</span></label>
                            <input type="text" id="sku" name="sku" class="form-control"
                                   placeholder="e.g. blk-shirt-m" required maxlength="25">
                        </div>
                        <div class="col-sm-6">
                            <label for="categoria" class="form-label fw-medium">Category <span class="text-danger">*</span></label>
                            <input type="text" id="categoria" name="categoria" class="form-control"
                                   placeholder="e.g. Clothing" required maxlength="50"
                                   list="categoryList">
                            <datalist id="categoryList">
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= esc($cat['categoria']) ?>">
                                <?php endforeach ?>
                            </datalist>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-4">
                            <label for="precio" class="form-label fw-medium">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="precio" name="precio" class="form-control"
                                       placeholder="0.00" required min="0.01" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="stock" class="form-label fw-medium">Stock <span class="text-danger">*</span></label>
                            <input type="number" id="stock" name="stock" class="form-control"
                                   placeholder="0" required min="0" value="0">
                        </div>
                        <div class="col-sm-4">
                            <label for="stock_min" class="form-label fw-medium">Min Stock <span class="text-danger">*</span></label>
                            <input type="number" id="stock_min" name="stock_min" class="form-control"
                                   placeholder="5" required min="0" value="5">
                            <div class="form-text">Low-stock alert threshold</div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <label for="codigo" class="form-label fw-medium">Barcode <span class="text-danger">*</span></label>
                            <input type="text" id="codigo" name="codigo" class="form-control"
                                   placeholder="e.g. 9876543210" required maxlength="255">
                        </div>
                        <div class="col-sm-6">
                            <label for="descripcion" class="form-label fw-medium">Description <span class="text-danger">*</span></label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control"
                                   placeholder="Short product description" required maxlength="255">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i>Save Product
                        </button>
                        <a href="<?= site_url('/products') ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
