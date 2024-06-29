<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeldosen extends Model
{
    protected $table            = 'tb_dosen';
    protected $primaryKey       = 'id_dosen';

    protected $useAutoIncrement = true;
    
    // Field yang Wajib Di isi
    protected $allowedFields = ['nidn', 'nama_dosen', 'tempat_lahir', 'tanggal_lahir', 'alamat'];
}
