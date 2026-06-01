<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Productos;

class Home extends BaseController
{
	public function index(): string
	{
		return $this->renderLayout('home', [
			'title'    => 'Products',
			'products' => (new Productos())->getAll(),
		]);
	}
}
