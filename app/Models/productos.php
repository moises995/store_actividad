<?php namespace App\Models;

use CodeIgniter\Model;

class Productos extends Model
{

    protected $table        =   'productos';
    protected $primarykey   =   'producto_id';
    protected $allowedFields  = ['nombre','sku','categoria','precio','descripcion','codigo_de_barras','activo'];

    public function create_product($data)
    {
        $this->insert($data);
    }
    public function read_products()
    {
        return $this->select('*')
                    ->where('activo is null')
                    ->findall();
    }
    public function read_product($id)
    {
        return $this->select('*')
                    ->where('producto_id',$id)
                    ->where('activo is null')
                    ->findall();
    }
    public function update_product($id,$data)
    {
        $this->set($data)
             ->where('producto_id',$id)
             ->update();
    }
    public function delete_product($id)
    {
        $this->set('activo',1)
             ->where('producto_id',$id)
             ->update();
    }
}
    