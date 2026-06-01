<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Productos;

class Administracion extends BaseController
{
	/** Displays the edit form for a product. */
	public function editProduct(int $id): string
	{
		$product = (new Productos())->getById($id);

		return $this->renderLayout('administracion/editar', [
			'title'   => 'Edit Product',
			'product' => $product,
		]);
	}

	/** Validates and saves changes to an existing product. */
	public function updateProduct(int $id): \CodeIgniter\HTTP\RedirectResponse
	{
		$input = $this->collectInput();
		$model = new Productos();

		if (! $model->validate($input)) {
			session()->setFlashdata('error', implode(' ', $model->errors()));
			return redirect()->to(site_url('/administracion/editar/' . $id));
		}

		$model->updateById($id, $input);
		session()->setFlashdata('success', 'Product updated successfully.');

		return redirect()->to(site_url('/products'));
	}

	/** Displays the new product form. */
	public function newProduct(): string
	{
		return $this->renderLayout('administracion/nuevo', [
			'title'      => 'New Product',
			'categories' => (new Productos())->getCategories(),
		]);
	}

	/** Validates and saves a new product. */
	public function saveProduct(): \CodeIgniter\HTTP\RedirectResponse
	{
		$input = $this->collectInput();
		$model = new Productos();

		if (! $model->validate($input)) {
			session()->setFlashdata('error', implode(' ', $model->errors()));
			return redirect()->to(site_url('/administracion/nuevo'));
		}

		$model->create($input);
		session()->setFlashdata('success', 'Product created successfully.');

		return redirect()->to(site_url('/products'));
	}

	/** Soft-deletes a product and redirects to the product list. */
	public function deleteProduct(int $id): \CodeIgniter\HTTP\RedirectResponse
	{
		(new Productos())->softDelete($id);
		session()->setFlashdata('success', 'Product deleted successfully.');

		return redirect()->to(site_url('/products'));
	}

	// ─── Private ────────────────────────────────────────────────────────────────

	/** Collects and returns the product form fields from the current POST request. */
	private function collectInput(): array
	{
		return [
			'nombre'           => $this->request->getPost('nombre'),
			'sku'              => $this->request->getPost('sku'),
			'categoria'        => $this->request->getPost('categoria'),
			'precio'           => $this->request->getPost('precio'),
			'descripcion'      => $this->request->getPost('descripcion'),
			'codigo_de_barras' => $this->request->getPost('codigo'),
			'stock'            => $this->request->getPost('stock'),
			'stock_min'        => $this->request->getPost('stock_min'),
		];
	}
}
