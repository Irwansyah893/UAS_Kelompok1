<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMatakuliah extends Model
{
    protected $table            = 'tb_matkul';
    protected $primaryKey       = 'id_matkul';

    protected $useAutoIncrement = true;
    
    // Field yang Wajib Di isi
    protected $allowedFields = ['kode_matkul', 'nama_matkul', 'nama_dosen', 'sks', 'tanggal_entry'];
}
