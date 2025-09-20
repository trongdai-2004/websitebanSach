<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết người dùng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css">
     <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\user_management.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="user-page">
 <?php   $this->load->view('components/header_admin') ?>

    <div class="container mt-4 user-page__container">
    <h2 class="mb-4 user-page__title">
        <i class="fas fa-user"></i> Thông tin người dùng
    </h2>
    <div class="card mb-4">
        <div class="card-body d-flex align-items-center">
            <img src="<?= $user['avatar'] ?>" alt="Avatar" class="rounded-circle mr-4" width="100" height="100">
            <div>
                <p><strong>Họ tên:</strong> <?= $user['full_name'] ?></p>
                <p><strong>Email:</strong> <?= $user['email'] ?></p>
                <p><strong>Số điện thoại:</strong> <?= $user['phone_number'] ?></p>
                <p><strong>Ngày sinh:</strong> <?= $user['date_of_birth'] ?> </p>
                <p><strong>Giới tính:</strong> <?= $user['sex'] ?></p>
            </div>
        </div>
    </div>

    <?php foreach ($orders as $order_id => $order): ?>
        <h4 class="mb-3">Đơn hàng #<?= $order_id ?> - <?= $order['order_date'] ?></h4>
        <table class="table table-bordered table-hover">
            <thead style="background-color: #d9f0ff;">
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá sau giảm (VNĐ)</th>
                    <th>Ngày mua</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1; ?>
                <?php foreach ($order['items'] as $item): ?>
                    <tr>
                        <td><?= $stt++ ?></td>
                        <td><?= $item['product_name'] ?></td>
                        <td><img src="<?= $item['front_image'] ?>" alt="Ảnh" width="60"></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['final_price']) ?> VND</td>
                        <td><?= $order['order_date'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>

    <a href="<?= base_url('index.php/Admin/getInformationUser') ?>" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

    </div>
</body>
</html>
