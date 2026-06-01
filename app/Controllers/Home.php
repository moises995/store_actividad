<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Productos;

/** Dashboard — aggregate metrics and low-stock alerts. */
class Home extends BaseController
{
	public function index(): string
	{
		$model = new Productos();

		return $this->renderLayout('dashboard', [
			'title'    => 'Dashboard',
			'stats'    => $model->getStats(),
			'lowStock' => $model->getLowStock(),
		]);
	}
}
