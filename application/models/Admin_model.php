<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getAllProduct()
	{
		return $this->db->get('products')->result_array();
	}
	public function searchProduct($keyword)
	{
    if (empty($keyword)) {
        return [];
    }

    $this->db->like('product_name', $keyword);
    return $this->db->get('products')->result_array();
	}

public function addProduct($product_name, $price, $product_type, $author, $framework, $number_of_pages, $format,$weight,$book_series,$sale,$book_description,$front_image,$back_image)
{
	$data = [
			'product_name' => $product_name,
			'price' => $price,
			'product_type' => $product_type,
			'author' => $author,
			'framework' => $framework,
			'number_of_pages' => $number_of_pages,
			'format' => $format,
			'weight' => $weight,
			'book_series' => $book_series,
			'sale' => $sale,
			'book_description' => $book_description,
			'front_image' => $front_image,
			'back_image' => $back_image,
		];
		
		return $this->db->insert('products', $data);

}

	public function getInformationProduct($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('products')->row_array();
	}
	public function deleteProductByid($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('products');
	}
	

	public function getInformationUser()
	{
		 return $this->db->get('users')->result_array();
	}
	public function getInformationUserByID($user_id)
{
    $this->db->select('
        users.full_name,
        users.avatar,
        users.email,
        users.phone_number,
        users.date_of_birth,
        users.sex,

        orders.id as order_id,
        orders.order_date,
        orders.total_price as order_total,
        orders.final_price as order_final,
        orders.discount_price as order_discount,
        orders.status,
        orders.note,

        order_items.product_id,
        order_items.quantity,
        order_items.price,
        order_items.sale,
        order_items.final_price as item_final,

        products.product_name,
        products.front_image
    ');
    $this->db->from('users');
    $this->db->join('orders', 'orders.user_id = users.id', 'left');
    $this->db->join('order_items', 'order_items.order_id = orders.id', 'left');
    $this->db->join('products', 'products.id = order_items.product_id', 'left');
    $this->db->where('users.id', $user_id); // lọc theo user

    return $this->db->get()->result_array();
}
	public function getOrder()
	{
		return $this->db->get('orders')->result_array();
	}

	public function getOrderDetails($order_id)
{
    $this->db->select('
    	orders.id,
        orders.name,
        orders.email,
        orders.sdt,
        orders.Address AS address,
        orders.total_price,
        orders.discount_price,
        orders.final_price,
        orders.order_date,
        orders.note,
        orders.status,

        products.product_name,
        products.front_image,

        order_items.quantity,
        order_items.price,
        order_items.sale,
        order_items.final_price AS item_final_price
    ');
    $this->db->from('orders');
    $this->db->join('order_items', 'order_items.order_id = orders.id', 'left');
    $this->db->join('products', 'products.id = order_items.product_id', 'left');
    $this->db->where('orders.id', $order_id);

    return $this->db->get()->result_array();
}

	public function editOrder($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('orders')->row_array();
	}
	public function updateOrderStatus($id, $status)
{
    $data = [
        'status' => $status,
        'user_is_read' => 0  // reset cho user biết có trạng thái mới
    ];
    $this->db->where('id', $id);
    return $this->db->update('orders', $data);
}


	public function total_products()
	{
		return $this->db->count_all('products');
	}
	public function totalUser()
	{
		return $this->db->count_all('users');
	}
	public function totalOrder()
	{
		return $this->db->count_all('orders');
	}

	 public function getRevenueByMonth()
    {
        $this->db->select('MONTH(order_date) AS month, SUM(final_price) AS revenue');
        $this->db->from('orders');
        $this->db->where('status', 'Đã giao'); 
        $this->db->group_by('MONTH(order_date)');
        $this->db->order_by('MONTH(order_date)');

        return $this->db->get()->result_array();
    }
    public function searchUserByKeyword($keyword)
{
    $this->db->like('nickname', $keyword);
    $this->db->or_like('email', $keyword);   
    return $this->db->get('users')->result_array();
}
	public function searchOrder($keyword)
	{
		$this->db->like('name',$keyword);
		$this->db->or_like('sdt',$keyword);
		return $this->db->get('orders')->result_array();
	}

	// Lấy tất cả đơn hàng chưa đọc
public function getUnreadOrders() {
    $this->db->where('is_read', 0);
    $this->db->order_by('order_date', 'DESC');
    return $this->db->get('orders')->result_array();
}

// Đánh dấu đã đọc
public function markOrderAsRead($id) {
    $this->db->where('id', $id);
    return $this->db->update('orders', ['is_read' => 1]);
}

public function updateProduct($id, $product_name, $price, $product_type, $author, $framework, $number_of_pages, $format,$weight,$book_series,$sale,$book_description,$front_image,$back_image)
	{
		$data = [
			'product_name' => $product_name,
			'price' => $price,
			'product_type' => $product_type,
			'author' => $author,
			'framework' => $framework,
			'number_of_pages' => $number_of_pages,
			'format' => $format,
			'weight' => $weight,
			'book_series' => $book_series,
			'sale' => $sale,
			'book_description' => $book_description,
			'front_image' => $front_image,
			'back_image' => $back_image,
		];
		$this->db->where('id', $id);
		return $this->db->update('products', $data);
	}

	






}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */