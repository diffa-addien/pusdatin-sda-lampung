<?php namespace App\Models;

use CodeIgniter\Model;

class M_SDAProvinsi extends Model{
    protected $table = 'data_sda_provinsi';
    protected $primaryKey = 'id';
    protected $allowedFields;
    protected $protectFields = false;
}