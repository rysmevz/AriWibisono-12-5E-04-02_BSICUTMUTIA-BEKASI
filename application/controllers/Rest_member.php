<?php
/**
 * Dokumentasi Pengerjaan Kelompok
 * Nama Kelompok : Stay Alone
 * Kelas : 12.5E.04
 * Ketua : Ari Wibisono - 12170272
 * Anggota : NULL
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;
class Rest_member extends REST_Controller {
    // Fungsi Construct adalah function yang pertama kali di jalankan pada sebuah controller
    // Biasanya di gunakan untuk validation session/variable dari class sebuah program
    function __construct($config = 'rest'){
        // Construct disini memiliki variabel config mengecek apakah variable rest atau tidak
        parent::__construct($config);
        // if config true load database to get connection
        $this->load->database();
    }

    function index_get() {
        // Deskripsi Fungsi :
        // ----------------------------------------------------------------------------------
        // Script dibawah ini merupakan implementasi dari metode GET
        // ----------------------------------------------------------------------------------

        // get id variable data
        $id = $this->get('id');
        // checked data is null -> get all data result member
        if ($id == '') {
            $member = $this->db->get('member')->result();
        } else {
            // else data is not null , search data by id
            $this->db->where('id', $id);
            $member = $this->db->get('member')->result();
        }
        // response member for send data to json for can use client programming
        $this->response($member, 404);

        //500 error
        //200 success
        //404 not found
    }

    public function index_post()
    {
        $input = $this->input->post();
        $insert = $this->db->insert('member',$input);
        if($insert) {
            $this->response($input, 200);
        }else{
            $this->response(array('status' => 'fail',502));
        }
    }

    public function index_put($id)
    {
        $data = $this->put();
        $update = $this->db->update('member', $data, array('id'=>$id));

        if($update) {
            $this->response($data, 200);
        }else{
            $this->response(array('status' => 'fail',502));
        }
    }

    public function index_delete($id)
    {
        $delete = $this->db->delete('member', array('id'=>$id));

        if($delete) {
            $this->response(array('status' => 'sukses'), 200);
        }else{
            $this->response(array('status' => 'fail',502));
        }
    }
}
?>
