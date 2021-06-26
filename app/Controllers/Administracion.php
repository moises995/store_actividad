<?php

namespace App\Controllers;

use App\Models\Productos;

class Administracion extends BaseController
{
	public function editar()
	{
		$model = new Productos();
        $url=explode("/",$_SERVER["REQUEST_URI"]);
		$data = array(
			'title'     =>   'Edicion de productos',
			'producto'	=>	 $model->read_product($url[3])[0]
		);

		echo view('@shell/html_top',$data);
        echo view('administracion/editar',$data);
		echo view('@shell/html_bottom');
	}
    public function update()
    {
        $model = new Productos();
        $url=explode("/",$_SERVER["REQUEST_URI"]);
        $request = \Config\Services::request();
        $datos=['nombre'          => $request->getVar('nombre'),
                'sku'             => $request->getVar('sku'),
                'categoria'       => $request->getVar('categoria'),
                'precio'          => $request->getVar('precio'),
                'descripcion'     => $request->getVar('descripcion'),
                'codigo_de_barras'=> $request->getVar('codigo')];   
        $model->update_product($url[4],$datos);
        return redirect()->to(site_url('/home'));
    }
    public function nuevo()
    {
        $data = array(
			'title'     =>   'Nuevo de producto'
		);

		echo view('@shell/html_top',$data);
        echo view('administracion/nuevo');
		echo view('@shell/html_bottom');
    }
    public function guardar()
    {
        $model = new Productos();
        $request = \Config\Services::request();
        $datos=['nombre'          => $request->getVar('nombre'),
                'sku'             => $request->getVar('sku'),
                'categoria'       => $request->getVar('categoria'),
                'precio'          => $request->getVar('precio'),
                'descripcion'     => $request->getVar('descripcion'),
                'codigo_de_barras'=> $request->getVar('codigo')];   
        $model->create_product($datos);
        return redirect()->to(site_url('/home'));   
    }
    public function delete(){
        $model = new Productos();
        $url=explode("/",$_SERVER["REQUEST_URI"]); 
        $model->delete_product($url[4]);
        return redirect()->to(site_url('/home'));
    }
}
