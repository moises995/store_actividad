<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Productos
 *
 * Gestiona la tabla `productos`. El borrado es lógico:
 * activo = NULL → activo; activo = 1 → desactivado.
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

	/** Devuelve todos los productos activos. */
	public function getAll(): array
	{
		return $this->whereNull('activo')->findAll();
	}

	/** Devuelve un producto activo por ID. */
	public function getById(int $id): ?array
	{
		$result = $this->whereNull('activo')->where('producto_id', $id)->findAll();
		return $result[0] ?? null;
	}

	/** Crea un nuevo producto. */
	public function create(array $data): int
	{
		$this->insert($data);
		return $this->insertID();
	}

	/** Actualiza los campos de un producto por ID. */
	public function updateById(int $id, array $data): void
	{
		$this->set($data)->where('producto_id', $id)->update();
	}

	/** Borrado lógico: marca el producto como inactivo (activo = 1). */
	public function softDelete(int $id): void
	{
		$this->set('activo', 1)->where('producto_id', $id)->update();
	}
}
