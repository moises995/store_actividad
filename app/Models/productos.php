<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Productos
 *
 * Manages the `productos` table. Deletion is logical:
 *   activo = NULL  → active
 *   activo = 1     → deactivated (soft-deleted)
 */
class Productos extends Model
{
	protected $table         = 'productos';
	protected $primaryKey    = 'producto_id';
	protected $returnType    = 'array';
	protected $useTimestamps = false;
	protected $allowedFields = [
		'nombre', 'sku', 'categoria', 'precio', 'descripcion',
		'codigo_de_barras', 'stock', 'stock_min', 'activo',
	];

	protected $validationRules = [
		'nombre'           => 'required|max_length[255]',
		'sku'              => 'required|max_length[25]',
		'categoria'        => 'required|max_length[50]',
		'precio'           => 'required|numeric|greater_than[0]',
		'descripcion'      => 'required|max_length[255]',
		'codigo_de_barras' => 'required|max_length[255]',
		'stock'            => 'required|integer|greater_than_equal_to[0]',
		'stock_min'        => 'required|integer|greater_than_equal_to[0]',
	];

	protected $validationMessages = [
		'nombre'    => ['required' => 'Product name is required.'],
		'sku'       => ['required' => 'SKU is required.'],
		'categoria' => ['required' => 'Category is required.'],
		'precio'    => [
			'required'     => 'Price is required.',
			'numeric'      => 'Price must be a number.',
			'greater_than' => 'Price must be greater than zero.',
		],
		'descripcion'      => ['required' => 'Description is required.'],
		'codigo_de_barras' => ['required' => 'Barcode is required.'],
		'stock'            => ['required' => 'Stock quantity is required.', 'integer' => 'Stock must be a whole number.'],
		'stock_min'        => ['required' => 'Minimum stock threshold is required.'],
	];

	// ─── Queries ────────────────────────────────────────────────────────────────

	/** Returns all active products with optional sort and category filter. */
	public function getAllFiltered(string $sort = 'nombre', string $dir = 'asc', string $category = ''): array
	{
		$allowed = ['nombre', 'sku', 'categoria', 'precio', 'stock'];
		$sort    = in_array($sort, $allowed, true) ? $sort : 'nombre';
		$dir     = strtolower($dir) === 'desc' ? 'DESC' : 'ASC';

		$query = $this->whereNull('activo')->orderBy($sort, $dir);

		if ($category !== '') {
			$query->where('categoria', $category);
		}

		return $query->findAll();
	}

	/** Returns paginated active products. */
	public function getPaginated(int $perPage, string $sort = 'nombre', string $dir = 'asc', string $category = ''): array
	{
		$allowed = ['nombre', 'sku', 'categoria', 'precio', 'stock'];
		$sort    = in_array($sort, $allowed, true) ? $sort : 'nombre';
		$dir     = strtolower($dir) === 'desc' ? 'DESC' : 'ASC';

		$this->whereNull('activo')->orderBy($sort, $dir);

		if ($category !== '') {
			$this->where('categoria', $category);
		}

		return $this->paginate($perPage, 'default');
	}

	/** Returns a single active product by ID, or null if not found. */
	public function getById(int $id): ?array
	{
		$result = $this->whereNull('activo')->where('producto_id', $id)->findAll();
		return $result[0] ?? null;
	}

	/** Returns all products with stock at or below their minimum threshold. */
	public function getLowStock(): array
	{
		return $this->whereNull('activo')
			->where('stock <= stock_min')
			->orderBy('stock', 'ASC')
			->findAll();
	}

	/** Returns distinct category names. */
	public function getCategories(): array
	{
		return $this->db->table('productos')
			->select('categoria')
			->distinct()
			->whereNull('activo')
			->orderBy('categoria', 'ASC')
			->get()
			->getResultArray();
	}

	/**
	 * Returns aggregate stats for the dashboard:
	 *   total, inventory value, low-stock count, category count.
	 */
	public function getStats(): array
	{
		$total = $this->whereNull('activo')->countAllResults();

		$valueRow = $this->db->query(
			'SELECT SUM(precio * stock) AS total_value FROM productos WHERE activo IS NULL'
		)->getRow();

		$lowStock = $this->whereNull('activo')
			->where('stock <= stock_min')
			->countAllResults();

		$catRow = $this->db->query(
			'SELECT COUNT(DISTINCT categoria) AS cat_count FROM productos WHERE activo IS NULL'
		)->getRow();

		return [
			'total'      => $total,
			'value'      => (float) ($valueRow->total_value ?? 0),
			'low_stock'  => $lowStock,
			'categories' => (int) ($catRow->cat_count ?? 0),
		];
	}

	// ─── Mutations ──────────────────────────────────────────────────────────────

	/** Inserts a new product and returns its ID. */
	public function create(array $data): int
	{
		$this->insert($data);
		return $this->insertID();
	}

	/** Updates the given fields of a product by ID. */
	public function updateById(int $id, array $data): void
	{
		$this->set($data)->where('producto_id', $id)->update();
	}

	/** Soft-deletes a product (activo = 1). */
	public function softDelete(int $id): void
	{
		$this->set('activo', 1)->where('producto_id', $id)->update();
	}
}
