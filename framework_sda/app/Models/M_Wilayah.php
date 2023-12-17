<?php namespace App\Models;

use CodeIgniter\Model;

class M_Wilayah extends Model{
    protected $table = 'wilayah';
    protected $primaryKey = 'id';
    protected $allowedFields;
    protected $protectFields = false;
}