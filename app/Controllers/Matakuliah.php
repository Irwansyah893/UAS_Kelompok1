<?php

namespace App\Controllers;

use App\Models\ModelMatakuliah;

class Matakuliah extends BaseController
{
    public function index()
    {
        return view('matakuliah/viewTampildata');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $mkl = new ModelMatakuliah;
            $data = [
                'tampildata' => $mkl->findAll()
            ];
            $msg = [
                'data' => view('matakuliah/datamatakuliah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses !!!');
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('matakuliah/modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses !!!');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kode' => [
                    'label' => 'Kode Matakuliah',
                    'rules' => 'required|is_unique[tb_matkul.kode_matkul]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi dan Tidak Boleh Kosong !!!',
                        'is_unique' => '{field} Yang Dimasukkan Sudah Ada !!!'
                    ]
                ],

                'nama' => [
                    'label' => 'Nama Matakuliah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi dan Tidak Boleh Kosong !!!'
                    ]
                ],

                'nama_dosen' => [
                    'label' => 'Nama Dosen Pengampu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi dan Tidak Boleh Kosong !!!'
                    ]
                ],

                'sks' => [
                    'label' => 'SKS',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi dan Tidak Boleh Kosong !!!'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kode_matkul' => $validation->getError('kode'),
                        'nama_matkul' => $validation->getError('nama'),
                        'nama_dosen' => $validation->getError('nama_dosen'),
                        'sks' => $validation->getError('sks'),
                    ]
                ];
            } else {
            // Jika Benar / Valid
            $simpandata = [
                'kode_matkul' => $this->request->getPost('kode'),
                'nama_matkul' => $this->request->getPost('nama'),
                'nama_dosen' => $this->request->getPost('nama_dosen'),
                'sks' => $this->request->getPost('sks'),
            ];
            $mkl = new ModelMatakuliah;
            $mkl->insert($simpandata);

            $msg = [
                'sukses' => 'Data Matakuliah Berhasil Disimpan !!!'
            ];
            }
            echo json_encode($msg);
        }
        else {
            exit('Maaf Permintaan Tidak Dapat Diproses!!');
        }
    }

    public function formedit() 
    {
        if ($this->request->isAJAX()) {
            $id_matkul = $this->request->getVar('id_matkul');

            $mkl = new ModelMatakuliah;
            $row = $mkl->find($id_matkul);
            $data = [
                // Sebelah Kanan Field Pada Tabel Mahasiswa
                'id_matkul' => $row['id_matkul'],
                'kode' => $row['kode_matkul'],
                'nama' => $row['nama_matkul'],
                'nama_dosen' => $row['nama_dosen'], 
                'sks' => $row['sks'],
            ];
            $msg = [
                'sukses' => view('matakuliah/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata() 
    {
        if ($this->request->isAJAX()) {
            // Jika Benar / Valid
            $simpandata = [
                'kode_matkul' => $this->request->getPost('kode'),
                'nama_matkul' => $this->request->getPost('nama'),
                'nama_dosen' => $this->request->getPost('nama_dosen'),
                'sks' => $this->request->getPost('sks'),
            ];
            $mkl = new ModelMatakuliah;
            $id_matkul = $this->request->getVar('id_matkul');
            $mkl ->update($id_matkul, $simpandata);

            $msg = [
                'sukses' => 'Data Mahasiswa Berhasil Diubah !!!'
            ];
            echo json_encode($msg);
        }
        else {
            exit('Maaf Permintaan Tidak Dapat Diproses!!');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_matkul = $this->request->getVar('id_matkul');
            $mkl = new ModelMatakuliah;

            $mkl->delete($id_matkul);

            $msg = [
                'sukses' => 'Data Mahasiswa Berhasil Dihapus !!!'
            ];
            echo json_encode($msg);
        }
    }

}
