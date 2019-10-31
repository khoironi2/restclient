<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Server extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        
    }

    //Menampilkan data user
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $tbl_user = $this->Model_user->getData();
        } else {
            $tbl_user = $this->Model_user->getDataById($id);
        }
        $this->response($tbl_user, 200);
    }

    // mengirim atau menambah data user
    function index_post() {
        $data = array(
                    'nama_lengkap'           => $this->post('nama_lengkap'),
                    'email'          => $this->post('email'),
                    'termcondition' => $this->input->post('term'),
                    'level'          => '2',
                    'status'          => '1',
                    'password'    => password_hash($this->input->post('pass', true), PASSWORD_DEFAULT)   );
        $insert = $this->Model_user->insertUser($data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data user yang telah ada
// public function index_put($dataMahasiswa, $npm)
//   {
//     $val = array(
//       'nama' => $dataMahasiswa['nama'],
//       'kelas' => $dataMahasiswa['kelas'],
//       'tanggalLahir' => $dataMahasiswa['tanggalLahir']
//     );
//     $this->db->where('npm', $npm);
//     $this->db->update('mahasiswa', $val);
//   }
    

    function index_put() {
       $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'nama_lengkap'  => $this->put('nama_lengkap'),
                    'password'    => password_hash($this->put('password', true), PASSWORD_DEFAULT)   );
        
        $this->db->where('id', $id);
        $update = $this->db->update('tbl_user',$data);
        // $update = $this->Model_user->updateData($id, $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

  

    //Menghapus salah satu data user
    function index_delete() {
        $id = $this->delete('id');
       
        $delete = $this->Model_user->deleteData($id);
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Masukan function selanjutnya disini
}
?>