<?php

namespace App\Controllers;

use App\Models\Modeldosen;

class Dosen extends BaseController
{
    public function index()
    {
        return view('dosen/viewTampildata');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $dsn = new Modeldosen;
            $data = [
                'tampildata' => $dsn->findAll()
            ];
            $msg = [
                'data' => view('dosen/datadosen', $data)
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
                'data' => view('dosen/modaltambah')
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
                'nidn' => [
                    'label' => 'NIDN',
                    'rules' => 'required|is_unique[tb_dosen.nidn]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi dan Tidak Boleh Kosong !!!',
                        'is_unique' => '{field} Yang Dimasukkan Sudah Ada !!!'
                    ]
                ],

                'nama' => [
                    'label' => 'Nama Dosen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi dan Tidak Boleh Kosong !!!'
                    ]
                ],

                'tempat_lahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi dan Tidak Boleh Kosong !!!'
                    ]
                ],

                'tanggal_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi dan Tidak Boleh Kosong !!!'
                    ]
                ],

                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi dan Tidak Boleh Kosong !!!'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nidn' => $validation->getError('nidn'),
                        'nama' => $validation->getError('nama'),
                        'tempat_lahir' => $validation->getError('tempat_lahir'),
                        'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                        'alamat' => $validation->getError('alamat'),
                    ]
                ];
            } else {
            // Jika Benar / Valid
            $simpandata = [
                'nidn' => $this->request->getPost('nidn'),
                'nama_dosen' => $this->request->getPost('nama'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'alamat' => $this->request->getPost('alamat'),
            ];
            $dsn = new Modeldosen;
            $dsn->insert($simpandata);

            $msg = [
                'sukses' => 'Data Dosen Berhasil Disimpan !!!'
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
            $id_dosen = $this->request->getVar('id_dosen');

            $dsn = new Modeldosen;
            $row = $dsn->find($id_dosen);
            $data = [
                // Sebelah Kanan Field Pada Tabel Mahasiswa
                'id_dosen' => $row['id_dosen'],
                'nidn' => $row['nidn'],
                'nama' => $row['nama_dosen'],
                'tempat_lahir' => $row['tempat_lahir'], 
                'tanggal_lahir' => $row['tanggal_lahir'], 
                'alamat' => $row['alamat'] 
            ];
            $msg = [
                'sukses' => view('dosen/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata() 
    {
        if ($this->request->isAJAX()) {
            // Jika Benar / Valid
            $simpandata = [
                'nidn' => $this->request->getPost('nidn'),
                'nama_dosen' => $this->request->getPost('nama'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'alamat' => $this->request->getPost('alamat'),
            ];
            $dsn = new Modeldosen;
            $id_dosen = $this->request->getVar('id_dosen');
            $dsn ->update($id_dosen, $simpandata);

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
            $id_dosen = $this->request->getVar('id_dosen');
            $dsn = new Modeldosen;

            $dsn->delete($id_dosen);

            $msg = [
                'sukses' => 'Data Mahasiswa Berhasil Dihapus !!!'
            ];
            echo json_encode($msg);
        }
    }
}
