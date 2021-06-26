<?php

namespace App\Controllers;

use App\Models\Productos;

class Home extends BaseController
{
	public function index()
	{
		$model = new Productos();

		$data = array(
			'title'     =>   'Menu Principal',
			'productos'	=>	 $model->read_products()
		);

		echo view('@shell/html_top',$data);
		echo view('home',$data);
		echo view('@shell/html_bottom');
	}
}
