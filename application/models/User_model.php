<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}


	

	public function getNewProduct()
	{
		$this->db->where('product_type', 'sách mới');
		return $this->db->get('products')->result_array();
	}

	public function getBestSeller()
	{
		$this->db->where('product_type', 'bán chạy nhất');
		return $this->db->get('products')->result_array();
	}
	public function getManga()
	{
		$this->db->where('product_type', 'manga');
		return $this->db->get('products')->result_array();
	}
	public function getLifeSkills()
	{
		$this->db->where('product_type', 'kỹ năng sống');
		return $this->db->get('products')->result_array();
	}
	public function bookDetail($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('products')->row_array();
	}

	public function addCart($user_id, $product_id, $quantity, $added_at, $price)
	{
		$data = [
			'user_id' => $user_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'added_at' => $added_at,
			'price' => $price,
		];
		return $this->db->insert('cart', $data);
	}
	public function getCart($user_id)
	{
		$this->db->select('cart.*, products.product_name, products.price, products.front_image, products.sale');
		$this->db->from('cart');
		$this->db->join('products', 'products.id = cart.product_id');
		$this->db->where('cart.user_id', $user_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function deleteCart($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cart');
	}



	public function informationUser($name, $sdt, $email, $address, $note, $total_price, $discount_price, $final_price, $user_id)
	{
		$data = [

			'name' => $name,
			'sdt' => $sdt,
			'email' => $email,
			'Address' => $address,
			'note' => $note,
			'total_price' => $total_price,
			'discount_price' => $discount_price,
			'final_price' => $final_price,
			'user_id' => $user_id,
		];
		return $this->db->insert('orders', $data);
	}


	public function createOrderWithItems($name, $sdt, $email, $address, $note, $total_price, $discount_price, $final_price, $user_id, $cart_items)
{
    // 1. Thêm đơn hàng
    $order_data = [
        'user_id'        => $user_id,
        'name'           => $name,
        'sdt'            => $sdt,
        'email'          => $email,
        'Address'        => $address,
        'note'           => $note,
        'total_price'    => $total_price,
        'discount_price' => $discount_price,
        'final_price'    => $final_price,
        'order_date'     => date('Y-m-d H:i:s')
    ];
    $this->db->insert('orders', $order_data);
    $order_id = $this->db->insert_id();

    // 2. Thêm sản phẩm vào bảng order_items
    foreach ($cart_items as $item) {
        $price = $item['price'];
        $quantity = $item['quantity'];
        $sale = isset($item['sale']) ? $item['sale'] : 0;
        $product_id = $item['product_id'];
        $total = $price * $quantity;
        $discount = $total * ($sale / 100);
        $final = $total - $discount;

        $item_data = [
            'order_id'       => $order_id,
            'product_id'     => $product_id,
            'quantity'       => $quantity,
            'price'          => $price,
            'sale'           => $sale,
            'total_price'    => $total,
            'discount_price' => $discount,
            'final_price'    => $final
        ];
        $this->db->insert('order_items', $item_data);
    }

    return $order_id;
}


	
public function clearCart($user_id)
{
    $this->db->where('user_id', $user_id);
    $this->db->delete('cart');
}

public function getOrderHistory($user_id)
{
    $this->db->select('o.id AS order_id, o.order_date, o.final_price AS order_total, o.status,
                       GROUP_CONCAT(p.product_name SEPARATOR ", ") AS products');
    $this->db->from('orders o');
    $this->db->join('order_items oi', 'oi.order_id = o.id');
    $this->db->join('products p', 'p.id = oi.product_id');
    $this->db->where('o.user_id', $user_id);
    $this->db->group_by('o.id');
    $this->db->order_by('o.order_date', 'DESC');

    return $this->db->get()->result_array();
}


public function searchProducts($keyword)
{
    if (empty($keyword)) {
        return [];
    }

    $this->db->like('product_name', $keyword);
    return $this->db->get('products')->result_array();
}


public function getCartItem($user_id, $product_id) {
    $this->db->select('cart.quantity, products.price, products.sale');
    $this->db->from('cart');
    $this->db->join('products', 'cart.product_id = products.id');
    $this->db->where('cart.user_id', $user_id);
    $this->db->where('cart.product_id', $product_id);
    return $this->db->get()->row_array();
}


public function updateCartQuantity($user_id, $product_id, $new_quantity) {
    $this->db->where('user_id', $user_id);
    $this->db->where('product_id', $product_id);
    $result = $this->db->update('cart', ['quantity' => $new_quantity]);
    if (!$result) {
        log_message('error', 'Update cart failed for user_id=' . $user_id . ', product_id=' . $product_id);
    }
    return $result;
}
public function getAllCartItems($user_id) {
    $this->db->select('cart.quantity, products.price, products.sale');
    $this->db->from('cart');
    $this->db->join('products', 'cart.product_id = products.id');
    $this->db->where('cart.user_id', $user_id);
    return $this->db->get()->result_array();
}

	public function updataProfile($id, $full_name, $email, $phone_number, $date_of_birth, $avatar, $sex,$address)
	{
		$data = [
			'full_name' => $full_name,
			'email' => $email,
			'phone_number' => $phone_number,
			'date_of_birth' => $date_of_birth,
			'avatar' => $avatar,
			'sex' => $sex,
			'address' => $address,

		];
		$this->db->where('id', $id);
		return $this->db->update('users', $data);
	}
	public function getUserUnreadOrders($userId) {
    return $this->db->where('user_id', $userId)
                    ->where('user_is_read', 0)
                    ->get('orders')
                    ->result_array();
}

public function markUserOrderAsRead($orderId) {
    $this->db->where('id', $orderId)
             ->update('orders', ['user_is_read' => 1]);
}
public function getOrderById($order_id)
{
    return $this->db->where('id', $order_id)->get('orders')->row_array();
}

public function updateOrderStatus($order_id, $status)
{
    $this->db->where('id', $order_id); // ⚡ sửa lại dùng cột id
    return $this->db->update('orders', [
        'status' => $status,
        'user_is_read' => 0
    ]);
}




public function getOrderDetail($order_id, $user_id)
{
    // Lấy thông tin đơn hàng
    $this->db->where('id', $order_id);
    $this->db->where('user_id', $user_id);
    $order = $this->db->get('orders')->row_array();

    if (!$order) {
        return null;
    }

    // Lấy chi tiết sản phẩm của đơn
    $this->db->select('oi.*, p.product_name, p.front_image');
    $this->db->from('order_items oi');
    $this->db->join('products p', 'p.id = oi.product_id');
    $this->db->where('oi.order_id', $order_id);
    $items = $this->db->get()->result_array();

    $order['items'] = $items; // gắn danh sách sản phẩm vào đơn

    return $order;
}












}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */