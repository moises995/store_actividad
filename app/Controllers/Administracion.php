<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Productos;

class Administracion extends BaseController
{
	/** Muestra el formulario de edición de un producto. */
	public function editProduct(int $id): string
	{
		$model   = new Productos();
		$product = $model->getById($id);

		return $this->renderLayout('administracion/editar', [
			'title'   => 'Edición de producto',
			'product' => $product,
		]);
	}

	/** Procesa el formulario de edición y actualiza el producto. */
	public function updateProduct(int $id): \CodeIgniter\HTTP\RedirectResponse
	{
		$model = new Productos();

		$model->updateById($id, [
			'nombre'           => $this->request->getVar('nombre'),
			'sku'              => $this->request->getVar('sku'),
			'categoria'        => $this->request->getVar('categoria'),
			'precio'           => $this->request->getVar('precio'),
			'descripcion'      => $this->request->getVar('descripcion'),
			'codigo_de_barras' => $this->request->getVar('codigo'),
		]);

		return redirect()->to(site_url('/home'));
	}

	/** Muestra el formulario para crear un nuevo producto. */
	public function newProduct(): string
	{
		return $this->renderLayout('administracion/nuevo', [
			'title' => 'Nuevo producto',
		]);
	}

	/** Procesa el formulario de creación y guarda el producto. */
	public function saveProduct(): \CodeIgniter\HTTP\RedirectResponse
	{
		$model = new Productos();

		$model->create([
			'nombre'           => $this->request->getVar('nombre'),
			'sku'              => $this->request->getVar('sku'),
			'categoria'        => $this->request->getVar('categoria'),
			'precio'           => $this->request->getVar('precio'),
			'descripcion'      => $this->request->getVar('descripcion'),
			'codigo_de_barras' => $this->request->getVar('codigo'),
		]);

		return redirect()->to(site_url('/home'));
	}

	/** Desactiva lógicamente un producto. */
	public function deleteProduct(int $id): \CodeIgniter\HTTP\RedirectResponse
	{
		$model = new Productos();
		$model->softDelete($id);

		return redirect()->to(site_url('/home'));
	}
}
