<?php namespace App\Models;

use CodeIgniter\Model;

class M_SDAWilayah extends Model{
    protected $table = 'data_sda_wilayah';
    protected $primaryKey = 'id';
    protected $allowedFields;
    protected $protectFields = false;
}