<?php namespace App\Models;

use CodeIgniter\Model;

class M_ProfilSistem extends Model{
    protected $table = 'profil_sistem';
    protected $primaryKey = 'id';
    protected $allowedFields;
    protected $protectFields = false;
}