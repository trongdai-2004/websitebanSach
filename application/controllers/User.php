<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
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

        $data['user'] = $this->user;
        $newProduct = $this->User_model->getNewProduct();
        $data['new_product'] = $newProduct;

        $bestSeller = $this->User_model->getBestSeller();
        $data['best_seller'] = $bestSeller;

        $manga = $this->User_model->getManga();
        $data['manga'] = $manga;

        $lifeSkills = $this->User_model->getLifeSkills();
        $data['life_skills'] = $lifeSkills;

    

     
        $this->load->view('welcome_message', $data);
    }

    public function order_detail()
    {
        $user_id = $this->session->userdata('user_id');
        $cart = $this->User_model->getCart($user_id);
        $data['cart'] = $cart;
        $data['user'] = $this->user;
        $this->load->view('User_view/Cart_view', $data);
    }


    public function profile()
    {
        $user_id = $this->session->userdata('user_id');
        $user = null;
        if (!$user_id) {
            redirect('Auth/login');
        }


        $user = $this->Auth_model->get_user_by_id($user_id);
        if (!$user) {
            show_error('Không tìm thấy người dùng với ID: ' . $user_id);
        }

        $data['user'] = $user;
        $data['orders'] = $this->User_model->getOrderHistory($user_id);

        $this->load->view('User_view/Profile_view', $data);
    }
    public function indexUser()
    {

        $data['user'] = $this->user;
        $newProduct = $this->User_model->getNewProduct();
        $data['new_product'] = $newProduct;

        $bestSeller = $this->User_model->getBestSeller();
        $data['best_seller'] = $bestSeller;

        $manga = $this->User_model->getManga();
        $data['manga'] = $manga;

        $lifeSkills = $this->User_model->getLifeSkills();
        $data['life_skills'] = $lifeSkills;

        $this->load->view('User_view/Index_User_view', $data);
        
    }

    

    public function bookDetail($id)
    {
        $data['user'] = $this->user;
        $productByID = $this->User_model->bookDetail($id);
        $data['product_id'] = $productByID;
        $data['product'] = $this->User_model->get_product($id);
        $data['reviews'] = $this->User_model->get_reviews($id);
        $data['average_rating'] = $this->User_model->get_average_rating($id);
        $this->load->view('User_view/Book_Details_view', $data);
    }
    public function addCart()
    {

        $user_id = $this->session->userdata('user_id');
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity') ?? 1;
        $added_at = date('Y-m-d H:i:s');
        $price = $this->input->post('price');
        $this->User_model->addCart($user_id, $product_id, $quantity, $added_at, $price);
        redirect('User/Cart');
    }
    public function Cart()
    {  
        $user_id = $this->session->userdata('user_id');
        $cart = $this->User_model->getCart($user_id);
        $data['cart'] = $cart;
        $data['user'] = $this->user;
        $this->load->view('User_view/Cart_view', $data);
    }

    public function deleteCart($id)
    {
        $this->User_model->deleteCart($id);
        redirect('User/Cart');
    }
    public function informationCart()
    {
        $this->session->set_userdata([
            'total_price' => $this->input->post('total_price'),
            'discount_price' => $this->input->post('discount_price'),
            'final_price' => $this->input->post('final_price'),
        ]);
        redirect('User/inputUser');
    }
    public function inputUser()
    {
        $data['total_price'] = $this->session->userdata('total_price');
        $data['discount_price'] = $this->session->userdata('discount_price');
        $data['final_price'] = $this->session->userdata('final_price');
        $user_id = $this->session->userdata('user_id');
        $userProfile = $this->Auth_model->get_user_by_id($user_id);
        $data['userProfile'] = $userProfile;
        $data['user'] = $this->user;


        $user_id = $this->session->userdata('user_id');
        $this->load->view('User_view/Checkout_view', $data);
    }
    public function addOrders()
{
    $name = $this->input->post('name');
    $sdt = $this->input->post('sdt');
    $email = $this->input->post('email');
    $address = $this->input->post('address');
    $note = $this->input->post('note');

    $total_price    = $this->session->userdata('total_price');
    $discount_price = $this->session->userdata('discount_price');
    $final_price    = $this->session->userdata('final_price');
    $user_id        = $this->session->userdata('user_id');

   
    $cart_items = $this->User_model->getCart($user_id); // lấy từ bảng cart

    
    $order_id = $this->User_model->createOrderWithItems($name, $sdt, $email, $address, $note, $total_price, $discount_price, $final_price, $user_id, $cart_items);

  
    $this->User_model->clearCart($user_id);

    // Load view hiển thị kết quả
    $data['user'] = $this->user;
    $data['order_id'] = $order_id;
    $data['cart_items'] = $cart_items;
    $data['total_price'] = $total_price;
    $data['discount_price'] = $discount_price;
    $data['final_price'] = $final_price;

    $this->load->view('User_view/Order_Success_view', $data);
}

    public function about()
    {
        $data['user'] = $this->user;
        $this->load->view('User_view/About_view', $data);
    }

    public function search()
{
    $keyword = $this->input->get('keyword');
    $data['results'] = $this->User_model->searchProducts($keyword);
    $data['user'] = $this->user;
    $this->load->view('User_view/Search_view', $data);
}



public function updateCartQuantity() {
    $product_id = $this->input->post('id');
    $action = $this->input->post('action');
    $user_id = $this->session->userdata('user_id');

    if (!$user_id || !$product_id || !$action) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing data']);
        exit;
    }

    $item = $this->User_model->getCartItem($user_id, $product_id);

    if (!$item) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Item not found']);
        exit;
    }

    $new_quantity = $item['quantity'];
    if ($action === 'increase') {
        $new_quantity++;
    } elseif ($action === 'decrease' && $new_quantity > 1) {
        $new_quantity--;
    }

    $update_result = $this->User_model->updateCartQuantity($user_id, $product_id, $new_quantity);

    if (!$update_result) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Update failed']);
        exit;
    }

   
    $item = $this->User_model->getCartItem($user_id, $product_id);

    $item_total = $item['price'] * $item['quantity'] * (1 - $item['sale']/100);

    $all_cart = $this->User_model->getAllCartItems($user_id);
    if (!$all_cart) $all_cart = [];

    $tong_tam_tinh = 0;
    $tong_giam_gia = 0;
    foreach ($all_cart as $sp) {
        $total = $sp['price'] * $sp['quantity'];
        $discount = $total * $sp['sale'] / 100;

        $tong_tam_tinh += $total;
        $tong_giam_gia += $discount;
    }

    $tong_thanh_toan = $tong_tam_tinh - $tong_giam_gia;

    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'new_quantity' => $new_quantity,
        'item_total_price' => number_format($item_total, 0, ',', '.') . 'đ',
        'summary_total' => number_format($tong_tam_tinh, 0, ',', '.') . 'đ',
        'summary_discount' => number_format($tong_giam_gia, 0, ',', '.') . 'đ',
        'summary_final' => number_format($tong_thanh_toan, 0, ',', '.') . 'đ'
    ]);
    exit;
}

   public function updataProfile()
    {

        $id = $this->input->post('id');
        $full_name = $this->input->post('full_name');
        $email = $this->input->post('email');
        if (empty($email)) {
            $user = $this->db->get_where('users', ['id' => $id])->row();
            $email = $user->email;
        }
        $address = $this->input->post('address');
        $phone_number = $this->input->post('phone_number');
        $date_of_birth = $this->input->post('date_of_birth');
        $sex = $this->input->post('sex');

        $target_dir = "public/images/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["avatar"]["tmp_name"]);
            if ($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                // echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            // echo "Sorry, đã có 1 file trùng tên trong ổ cứng .";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["avatar"]["size"] > 50000000) {
            // echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            // echo "Sorry, chỉ chấp nhận file ảnh .";
            $uploadOk = 0;
        }


        if ($uploadOk == 0) {
            // echo "Sorry, lỗi file chưa được upload.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                // echo "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }
        // $avatar = base_url(). "public/images/".$_FILES["avatar"]["name"];
        $avatar = $_FILES["avatar"]["name"];

        if ($avatar) {

            $avatar = base_url() . "public/images/" . $_FILES["avatar"]["name"];
        } else {
            $avatar = $this->input->post('avatar2');
        }

        $this->User_model->updataProfile($id, $full_name, $email, $phone_number, $date_of_birth, $avatar, $sex,$address);
        redirect('User/profile');
    }
    
    public function checkOrderStatus($userId) {
    $orders = $this->User_model->getUserUnreadOrders($userId);
    if (!empty($orders)) {
        echo json_encode([
            'status' => 'success',
            'orders' => $orders
        ]);
    } else {
        echo json_encode(['status' => 'none']);
    }
}

public function markUserOrderRead($orderId) {
    $this->User_model->markUserOrderAsRead($orderId);
    echo json_encode(['status' => 'ok']);
}
public function cancelOrder($order_id)
{
    // Lấy thông tin đơn hàng
    $order = $this->User_model->getOrderById($order_id);

    // Kiểm tra trạng thái
    if ($order && trim(strtolower($order['status'])) == 'chờ xác nhận') {
        $this->User_model->updateOrderStatus($order_id, 'Đã hủy');
        $this->session->set_flashdata('message', 'Đơn hàng đã được hủy thành công!');
    } else {
        $this->session->set_flashdata('error', 'Đơn hàng không thể hủy ở trạng thái hiện tại!');
    }

    redirect('User/profile');
}



public function viewOrder($order_id)
{
   $user_id = $this->session->userdata('user_id');
    $data['order'] = $this->User_model->getOrderDetail($order_id, $user_id);
        $data['user'] = $this->user;

    if (!$data['order']) {
        $this->session->set_flashdata('error', 'Đơn hàng không tồn tại hoặc bạn không có quyền xem!');
        redirect('User/profile');
    }

    $this->load->view('User_view/order_detail', $data);
}






public function add_review($product_id) {
    $data = [
        'product_id' => $product_id,
        'user_id'    => $this->input->post('user_id'),
        'rating'     => $this->input->post('rating'),
        'comment'    => $this->input->post('comment'),
        'created_at' => date('Y-m-d H:i:s')
    ];

    $this->User_model->insert_review($data);

    redirect('User/bookDetail/'.$product_id);
}












}

/* End of file User.php */
/* Location: ./application/controllers/User.php */