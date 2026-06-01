<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Productos;

class Home extends BaseController
{
	public function index(): string
	{
		$model = new Productos();

		return $this->renderLayout('home', [
			'title'    => 'Menu Principal',
			'products' => $model->getAll(),
		]);
	}
}
