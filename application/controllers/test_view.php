<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test_view extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('User_view/TEST');
	}
	public function testDB() {
    if ($this->db->conn_id) {
            echo "Kết nối CSDL thành công!";
        } else {
            echo "Kết nối CSDL thất bại!";
        }
	}


}

/* End of file test_view.php */
/* Location: ./application/controllers/test_view.php */