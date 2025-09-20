<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
	}

	public function index() {}
	public function indexAdmin()
	{
		$this->load->view('Admin_view/admin_index_view');
	}

	public function getAllProduct()
	{
		$product = $this->Admin_model->getAllProduct();
		$data['product'] = $product;
		$this->load->view('Admin_view/admin_product_view',$data);
	}
	 public function searchProduct()
{
    $keyword = $this->input->get('keyword');

    $data['results'] = $this->Admin_model->searchProduct($keyword);
    $this->load->view('Admin_view/Admin_SearchProduct_view', $data);
}




	public function addProduct()
{
    if ($this->input->method() === 'post') {
        
        $product_name = $this->input->post('product_name');
        $price = $this->input->post('price');
        $product_type = $this->input->post('product_type');
        $author = $this->input->post('author');
        $framework = $this->input->post('framework');
        $number_of_pages = $this->input->post('number_of_pages');
        $format = $this->input->post('format');
        $weight = $this->input->post('weight');
        $book_series = $this->input->post('book_series');
        $sale = $this->input->post('sale');
        $book_description = $this->input->post('book_description');

        
        $front_image = '';
        if (!empty($_FILES['front_image']['name'])) {
            $front_image = 'public/images/' . $_FILES['front_image']['name'];
            move_uploaded_file($_FILES['front_image']['tmp_name'], $front_image);
            $front_image = base_url($front_image);
        }

       
        $back_image = '';
        if (!empty($_FILES['back_image']['name'])) {
            $back_image = 'public/images/' . $_FILES['back_image']['name'];
            move_uploaded_file($_FILES['back_image']['tmp_name'], $back_image);
            $back_image = base_url($back_image);
        }

       
        $this->Admin_model->addProduct($product_name, $price, $product_type, $author, $framework, $number_of_pages, $format, $weight, $book_series, $sale, $book_description, $front_image, $back_image);

        
        $this->session->set_flashdata('message', 'Thêm sản phẩm thành công!');
        redirect('Admin/getAllProduct');
    } else {
        
        $this->load->view('Admin_view/admin_addProduct_view');
    }
}
    public function getInformationProduct($id)
    {
       
        $product = $this->Admin_model->getInformationProduct($id);
        $data['item'] = $product;
        $this->load->view('Admin_view/admin_viewProduct_view', $data);
    }
    public function deleteProduct($id)
    {
        $delete = $this->Admin_model->deleteProductByid($id);
        if ($delete){
             redirect('Admin/getAllProduct');
        }
    }


    public function editProduct($id)
    {
        $product = $this->Admin_model->getInformationProduct($id);
        $data['item'] = $product;
        $this->load->view('Admin_view/admin_editProduct_view', $data);

    }
   

    public function getInformationUser()
    {
       $information = $this->Admin_model->getInformationUser();
       $data['information'] = $information;
       $this->load->view('Admin_view/user_management', $data);
    }

  public function getInformationUserByID($id)
{
    $information = $this->Admin_model->getInformationUserByID($id);

    if (!empty($information)) {
        $data['user'] = [
            'full_name' => $information[0]['full_name'],
            'avatar' => $information[0]['avatar'],
            'email' => $information[0]['email'],
            'phone_number' => $information[0]['phone_number'],
            'date_of_birth' => $information[0]['date_of_birth'],
            'sex' => $information[0]['sex']
        ];

        $data['orders'] = [];

        foreach ($information as $row) {
            $order_id = $row['order_id'];
            if (!isset($data['orders'][$order_id])) {
                $data['orders'][$order_id] = [
                    'order_date' => $row['order_date'],
                    'total' => $row['order_total'],
                    'final' => $row['order_final'],
                    'discount' => $row['order_discount'],
                    'status' => $row['status'],
                    'note' => $row['note'],
                    'items' => []
                ];
            }

            if (!empty($row['product_id'])) {
                $data['orders'][$order_id]['items'][] = [
                    'product_name' => $row['product_name'],
                    'quantity' => $row['quantity'],
                    'price' => $row['price'],
                    'sale' => $row['sale'],
                    'final_price' => $row['item_final'],
                    'front_image' => $row['front_image']
                ];
            }
        }

    } else {
        $data['user'] = [];
        $data['orders'] = [];
    }

    $this->load->view('Admin_view/user_details', $data);
}

    public function getOrder()
    {
        $order = $this->Admin_model->getOrder();
        $data['order'] = $order;

        $this->load->view('Admin_view/order_management', $data);
    }
  public function getOrderDetails($id)
{
    $orderDetails = $this->Admin_model->getOrderDetails($id);

    if (!empty($orderDetails)) {
        $data['order'] = [
            'id'             => $orderDetails[0]['id'], 
            'name'           => $orderDetails[0]['name'],
            'email'          => $orderDetails[0]['email'],
            'sdt'            => $orderDetails[0]['sdt'],
            'Address'        => $orderDetails[0]['address'],
            'order_date'     => $orderDetails[0]['order_date'],
            'status'         => $orderDetails[0]['status'],
            'total_price'    => $orderDetails[0]['total_price'],
            'discount_price' => $orderDetails[0]['discount_price'],
            'final_price'    => $orderDetails[0]['final_price'],
            'note'           => $orderDetails[0]['note']
        ];

        $data['items'] = [];

        foreach ($orderDetails as $item) {
            $data['items'][] = [
                'product_name'     => $item['product_name'],
                'front_image'      => $item['front_image'],
                'quantity'         => $item['quantity'],
                'price'            => $item['price'],
                'sale'             => $item['sale'],
                'final_price'      => $item['item_final_price'],
            ];
        }
    } else {
        $data['order'] = [];
        $data['items'] = [];
    }

    $this->load->view('Admin_view/order_details', $data);
}


    public function editOrder($id)
    {

        $editOrder = $this->Admin_model->editOrder($id);
        $data['editOrder'] = $editOrder;
        $this->load->view('Admin_view/order_edit',$data);
    }
    public function updateOrder()
{
    $id = $this->input->post('id');
    $status = $this->input->post('status');

    $this->Admin_model->updateOrderStatus($id, $status);

    $this->session->set_flashdata('message', 'Cập nhật trạng thái thành công!');
    redirect('Admin/getOrder');
}


    public function dashboard()
    {
        $totalProduct = $this->Admin_model->total_products();
        $data['totalProduct'] =  $totalProduct;
        $totalUser = $this->Admin_model->totalUser();
        $data['totalUser'] =  $totalUser;
        $totalOrder = $this->Admin_model->totalOrder();
        $data['totalOrder'] =  $totalOrder;
        $revenueData = $this->Admin_model->getRevenueByMonth();

        $labels = [];
        $values = [];

        foreach ($revenueData as $row) {
        $labels[] = 'T' . $row['month'];
        $values[] = round($row['revenue'] / 1000000, 2); 
    }
    $data['labels'] = $labels;
    $data['values'] = $values;




        $this->load->view('Admin_view/admin_index_view', $data);

    }
    public function searchUser()
{

    $keyword = $this->input->get('keyword');      
    $data['users'] = $this->Admin_model->searchUserByKeyword($keyword);
    $this->load->view('Admin_view/searchUser', $data);
}
    public function searchOrder()
    {
        $keyword = $this->input->get('keyword');
        $data['order'] = $this->Admin_model->searchOrder($keyword);
        $this->load->view('Admin_view/searchOrder', $data);

    }
    // API check đơn hàng mới
public function checkNewOrders() {
    $orders = $this->Admin_model->getUnreadOrders();
    if (!empty($orders)) {
        echo json_encode([
            'status' => 'success',
            'orders' => $orders
        ]);
    } else {
        echo json_encode(['status' => 'none']);
    }
}

// API đánh dấu đơn hàng đã đọc
public function markOrderRead($id) {
    $this->Admin_model->markOrderAsRead($id);
    echo json_encode(['status' => 'ok']);
}

 public function updateProduct()
    {
        $id = $this->input->post('id');
        $product_name = $this->input->post('product_name');
        $price = $this->input->post('price');
        $product_type = $this->input->post('product_type');
        $author = $this->input->post('author');
        $framework = $this->input->post('framework');
        $number_of_pages = $this->input->post('number_of_pages');
        $format = $this->input->post('format');
        $weight = $this->input->post('weight');
        $book_series = $this->input->post('book_series');
        $sale = $this->input->post('sale');
        $book_description = $this->input->post('book_description');
        $old_front_image = $this->input->post('old_front_image');
        $old_back_image = $this->input->post('old_back_image');

        
        $front_image = '';
        if (!empty($_FILES['front_image']['name'])) {
            $front_image = 'public/images/' . $_FILES['front_image']['name'];
            move_uploaded_file($_FILES['front_image']['tmp_name'], $front_image);
            $front_image = base_url($front_image);
        }else{
             $front_image = $old_front_image;
        }

       
        $back_image = '';
        if (!empty($_FILES['back_image']['name'])) {
            $back_image = 'public/images/' . $_FILES['back_image']['name'];
            move_uploaded_file($_FILES['back_image']['tmp_name'], $back_image);
            $back_image = base_url($back_image);
        }else{
             $back_image = $old_back_image;
        }

        $update = $this->Admin_model->updateProduct($id, $product_name, $price, $product_type, $author, $framework, $number_of_pages, $format,$weight,$book_series,$sale,$book_description,$front_image,$back_image);
        redirect('Admin/getAllProduct');
    }
   




 








}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */