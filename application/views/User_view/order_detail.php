<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<?php $this->load->view('components/header'); ?> 
<div class="backgrou">
<body class="bg-light">

<div class="container ">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Chi tiết đơn hàng #<?= $order['id'] ?></h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Ngày đặt:</strong> <?= $order['order_date'] ?></p>
                    <p>
                        <strong>Trạng thái:</strong> 
                        <?php if ($order['status'] == 'chờ xác nhận'): ?>
                            <span class="badge badge-warning">Chờ xác nhận</span>
                        <?php elseif ($order['status'] == 'đã hủy'): ?>
                            <span class="badge badge-danger">Đã hủy</span>
                        <?php else: ?>
                            <span class="badge badge-success"><?= $order['status'] ?></span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-md-6 text-md-right">
                    
                </div>
            </div>

            <h5 class="mb-3">Danh sách sản phẩm</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Giảm giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order['items'] as $item): ?>
                        <tr>
                            <td><img src="<?= $item['front_image'] ?>" width="60" class="img-thumbnail"></td>
                            <td><?= $item['product_name'] ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                            <td><?= $item['sale'] ?>%</td>
                            <td class="text-danger font-weight-bold">
                                <?= number_format($item['final_price'], 0, ',', '.') ?> đ
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="<?= base_url('index.php/User/profile') ?>" class="btn btn-secondary btn-next">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    .backgrou{
        background-color: #B5DCE8;
        padding-top: 20px;
        padding-bottom: 20px;

    }
   
</style>
  <?php $this->load->view('components/footer') ?>

<!-- FontAwesome icons + Bootstrap JS -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
