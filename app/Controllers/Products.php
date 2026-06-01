<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Productos;
use Picqer\Barcode\BarcodeGeneratorSVG;

/** Handles the product listing, CSV export and barcode generation. */
class Products extends BaseController
{
	/** Paginated, sortable, filterable product list. */
	public function index(): string
	{
		$sort     = $this->request->getVar('sort')     ?? 'nombre';
		$dir      = $this->request->getVar('dir')      ?? 'asc';
		$category = (string) ($this->request->getVar('category') ?? '');

		$model      = new Productos();
		$products   = $model->getPaginated(15, $sort, $dir, $category);
		$categories = $model->getCategories();

		return $this->renderLayout('products/index', [
			'title'      => 'Products',
			'products'   => $products,
			'pager'      => $model->pager,
			'categories' => $categories,
			'sort'       => $sort,
			'dir'        => $dir,
			'category'   => $category,
		]);
	}

	/** Streams all active products as a CSV download. */
	public function exportCsv(): \CodeIgniter\HTTP\Response
	{
		$products = (new Productos())->getAllFiltered();

		$rows   = [];
		$rows[] = ['Name', 'SKU', 'Category', 'Price', 'Stock', 'Min Stock', 'Description', 'Barcode'];

		foreach ($products as $p) {
			$rows[] = [
				$p['nombre'],
				$p['sku'],
				$p['categoria'],
				$p['precio'],
				$p['stock'],
				$p['stock_min'],
				$p['descripcion'],
				$p['codigo_de_barras'],
			];
		}

		$csv = implode("\n", array_map(
			fn(array $row) => implode(',', array_map(
				fn($v) => '"' . str_replace('"', '""', (string) $v) . '"',
				$row
			)),
			$rows
		));

		return $this->response
			->setHeader('Content-Type', 'text/csv; charset=UTF-8')
			->setHeader('Content-Disposition', 'attachment; filename="products-' . date('Y-m-d') . '.csv"')
			->setBody($csv);
	}

	/** Renders a print-friendly barcode page for a product. */
	public function barcode(int $id): string
	{
		$product = (new Productos())->getById($id);

		if ($product === null) {
			return $this->renderLayout('products/barcode', [
				'title'   => 'Barcode',
				'product' => null,
				'barcode' => null,
			]);
		}

		$generator = new BarcodeGeneratorSVG();
		$barcode   = $generator->getBarcode(
			$product['codigo_de_barras'],
			$generator::TYPE_CODE_128,
			2,
			80
		);

		return $this->renderLayout('products/barcode', [
			'title'   => 'Barcode — ' . $product['nombre'],
			'product' => $product,
			'barcode' => $barcode,
		]);
	}
}
