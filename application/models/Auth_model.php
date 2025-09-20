<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	public function get_user_by_id($user_id)
	{
		return $this->db->get_where('users', ['id' => $user_id])->row_array();
	}


	public function register($email, $password = null, $nickname = null)
{
    $data = [
        'email' => $email,
        'nickname' => $nickname ?? $email
    ];

    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $data['password'] = null;
    }

    return $this->db->insert('users', $data);
}


	public function login($email, $password)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('users');

		if ($query->num_rows() == 1) {
			$user = $query->row_array();

			// So sánh mật khẩu đã mã hóa
			if (password_verify($password, $user['password'])) {
				return $user; // Trả về mảng
			}
		}

		return false; // Sai email hoặc password
	}
	public function get_user_by_email($email)
{
    return $this->db->get_where('users', ['email' => $email])->row_array();
}

}

/* End of file Auth.php */
/* Location: ./application/models/Auth.php */