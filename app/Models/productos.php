<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Productos
 *
 * Manages the `productos` table. Deletion is logical:
 *   activo = NULL  → active product
 *   activo = 1     → deactivated product
 */
class Productos extends Model
{
	protected $table         = 'productos';
	protected $primaryKey    = 'producto_id';
	protected $returnType    = 'array';
	protected $useTimestamps = false;
	protected $allowedFields = [
		'nombre', 'sku', 'categoria', 'precio',
		'descripcion', 'codigo_de_barras', 'activo',
	];

	protected $validationRules = [
		'nombre'           => 'required|max_length[255]',
		'sku'              => 'required|max_length[25]',
		'categoria'        => 'required|max_length[50]',
		'precio'           => 'required|numeric|greater_than[0]',
		'descripcion'      => 'required|max_length[255]',
		'codigo_de_barras' => 'required|max_length[255]',
	];

	protected $validationMessages = [
		'nombre'           => ['required' => 'Product name is required.'],
		'sku'              => ['required' => 'SKU is required.'],
		'categoria'        => ['required' => 'Category is required.'],
		'precio'           => [
			'required'     => 'Price is required.',
			'numeric'      => 'Price must be a number.',
			'greater_than' => 'Price must be greater than zero.',
		],
		'descripcion'      => ['required' => 'Description is required.'],
		'codigo_de_barras' => ['required' => 'Barcode is required.'],
	];

	/** Returns all active products. */
	public function getAll(): array
	{
		return $this->whereNull('activo')->findAll();
	}

	/** Returns a single active product by ID, or null if not found. */
	public function getById(int $id): ?array
	{
		$result = $this->whereNull('activo')->where('producto_id', $id)->findAll();
		return $result[0] ?? null;
	}

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

	/** Soft-deletes a product by setting activo = 1. */
	public function softDelete(int $id): void
	{
		$this->set('activo', 1)->where('producto_id', $id)->update();
	}
}
