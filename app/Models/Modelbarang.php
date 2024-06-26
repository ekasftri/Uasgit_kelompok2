<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbarang extends Model
{
   protected $table = 'handphone';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['kode_barang', 'nama', 'merk', 'warna'];

   protected $useAutoIncrement = true;

   
}
