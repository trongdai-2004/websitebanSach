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

    
    public function login_google()
{
    $client = new Google_Client();
    $client = new Google_Client();
    $client->setClientId(getenv('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(getenv('GOOGLE_REDIRECT_URI'));

    $client->addScope("email");
    $client->addScope("profile");

    
    if ($this->input->get('code')) {
        $token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));

     
        if (isset($token['error'])) {
            echo "Lỗi khi lấy token: " . $token['error_description'];
            exit;
        }

        
        $client->setAccessToken($token);

        
        $oauth = new Google_Service_Oauth2($client);
        $google_user = $oauth->userinfo->get();

       
        $user = $this->Auth_model->get_user_by_email($google_user->email);
        if (!$user) {
            $this->Auth_model->register($google_user->email, '', $google_user->name);
            $user = $this->Auth_model->get_user_by_email($google_user->email);
        }

        $this->session->set_userdata([
            'user_id'   => $user['id'],
            'username'  => $user['nickname'], // nickname thay vì username
            'role'      => $user['role'] ?? 'user'
        ]);

        redirect('User/indexUser');
    } 
    else {
      
        $auth_url = $client->createAuthUrl();
        redirect($auth_url);
    }
}
    


}



/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */