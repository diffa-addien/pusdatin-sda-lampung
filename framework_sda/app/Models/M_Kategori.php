<?php namespace App\Models;

use CodeIgniter\Model;

class M_Kategori extends Model{
    protected $table = 'kategori_data';
    protected $primaryKey = 'id';
    protected $allowedFields;
    protected $protectFields = false;
}