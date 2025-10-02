<?php if (! defined('BASEPATH')) exit('No direct script access allowed');


class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $this->user = $this->Auth_model->get_user_by_id($user_id);
        } else {
            $this->user = null;
        }
    }

    public function index() {
        redirect('Auth/login'); 
    }


    public function loadRegister()
    {
        $this->load->view('Auth_view/Register_view');
    }

    public function register()
    {

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $nickname = $this->input->post('nickname');
        $this->load->model('Auth_model');

        $message = $this->Auth_model->register($email, $password, $nickname);
        if ($message) {

            $this->load->view('Auth_view/Login_view');
        } else {

            redirect('Auth/register'); // nếu bạn có trang form đăng ký riêng
        }
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->Auth_model->login($email, $password);

        if ($user) {

            $this->session->set_userdata([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ]);

            // Phân quyền chuyển hướng
            if ($user['role'] == 'admin') {
                redirect('Admin/dashboard');
            } else {
                redirect('User/indexUser');
            }
        } else {
            $this->session->set_flashdata('error', 'Sai tài khoản hoặc mật khẩu');
        }

        $data['user'] = $this->user;
        $this->load->view('Auth_view/Login_view', $data);
    }
    


}



/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */