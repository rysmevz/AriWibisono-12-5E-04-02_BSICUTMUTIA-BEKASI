<?php
// Dokumentasi Pengerjaan Kelompok
// Nama kelompok : Critical Thinking
// Kelas : 12.5E.04.02
// Ketua : Ari Wibisono - 12170282
// Anggota : Sri Sunarti - 12170113
//         : Ratna Ningsih - 12171640
//

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

    function index_get($id = 0) {
        // Deskripsi Fungsi :
        // ----------------------------------------------------------------------------------
        // Script dibawah ini merupakan implementasi dari metode GET
        // ----------------------------------------------------------------------------------

        // check data apakah kosong -> jika benar get all data member
        if (empty($id)) {
            $member = $this->db->get('member')->result();
        } else {
            // jika data tidak sama dengan kosong , cari data berdasarkan ID
            $this->db->where('id', $id);
            $member = $this->db->get('member')->result();
        }
        // menampilkan data variable member
        $this->response($member, 404);

        //500 error
        //200 success
        //404 not found
    }

    public function index_post()
    {
        // memasukkan type input post ke variabel $data
        $data = $this->input->post();

        // input data member
        $insert = $this->db->insert('member',$data);

        // jika input true maka tampil data
        if($insert == true) {
            $this->response($data, 200);
        }else{
            // jika salah maka tampil status fail
            $this->response(array('status' => 'fail',502));
        }
        //500 error
        //200 success
        //404 not found
    }

    public function index_put($id)
    {
        // mencari type input put ke variabel $data
        $data = $this->put();

        //update data berdasarkan id
        $update = $this->db->update('member', $data, array('id'=>$id));

        // jika update true maka tampil data
        if($update) {
            $this->response($data, 200);
        }else{
            // jika salah maka tampil status fail
            $this->response(array('status' => 'fail',502));
        }
        //500 error
        //200 success
        //404 not found
    }

    public function index_delete($id)
    {
        // delete data member berdasarkan id
        $delete = $this->db->delete('member', array('id'=>$id));

        //jika delete true maka tampil status sukses
        if($delete) {
            $this->response(array('status' => 'sukses'), 200);
        }else{
            //jika delete false maka tampil status fail
            $this->response(array('status' => 'fail',502));
        }
        //500 error
        //200 success
        //404 not found
    }
}
?>
