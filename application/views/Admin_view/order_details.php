<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\order_details.css?=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="order-details-page">
    <?php   $this->load->view('components/header_admin') ?>
    <div class="container mt-5 order-details__container">
        <h2 class="mb-4"><i class="fas fa-file-invoice"></i> Chi tiết đơn hàng: <span class="text-primary">ORD12345</span></h2>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Ngày đặt:</strong> <?=$order['order_date']?></p>
                <p><strong>Khách hàng:</strong><?=$order['name']?></p>
                <p><strong>Địa chỉ:</strong> <?=$order['Address']?></p>
                <p><strong>Trạng thái:</strong> <span class="badge badge-warning"><?=$order['status']?></span></p>
            </div>
        </div>

        <h4 class="mb-3">Sản phẩm đã đặt</h4>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                      <?php foreach ($items as $index => $item): ?>
                    <td><?= $item['product_name'] ?></td>
                    <td><?= number_format($item['price'], 0, ',', '.') ?> đ
</td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['final_price'], 0, ',', '.') ?> đ</td>

                </tr> <?php endforeach; ?>

            </tbody>
        </table>

        <div class="text-right mt-4">
            <h5><strong>Tổng cộng: <span class="text-danger"><?= number_format($item['final_price'], 0, ',', '.') ?> đ</span></strong></h5>
        </div>

        <div class="mt-4">
            <a href="<?php echo base_url(); ?>index.php/Admin/getOrder" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <a href="<?php echo base_url().'index.php/Admin/editOrder/'.$order['id']; ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Cập nhật đơn hàng
            </a>
        </div>
    </div>
</body>
</html>
