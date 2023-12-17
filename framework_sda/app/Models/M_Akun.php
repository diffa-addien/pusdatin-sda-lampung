<?php namespace App\Models;

use CodeIgniter\Model;

class M_Akun extends Model{
    protected $table = 'akun';
    protected $primaryKey = 'username';
    protected $allowedFields;
    protected $protectFields = false;

    // Bekas Tutorial Migrate
    // protected $returnType = 'App\Entities\KodeWilayah';
    // protected $useTimestamps = false;
}