<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_viewProduct_view.css?v=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css">
</head>
<body>
          <?php   $this->load->view('components/header_admin') ?>
<div class="admin-sidebar">
        <div class="admin-sidebar__logo">
            <img src="<?php echo base_url(); ?>public\images\logo.png" alt="Logo" class="admin-sidebar__logo-img">
            <span class="admin-sidebar__logo-text">BookOra</span>
        </div>

        <div class="dashboard-summary">
            <div class="dashboard-summary__row">
                <a href="dashboard.html" class="admin-sidebar__link admin-sidebar__link--active">
                    <i class="fas fa-chart-line admin-sidebar__icon"></i> Dashboard
                </a>
                <a href="<?php echo base_url(); ?>index.php/Admin/getAllProduct" class="admin-sidebar__link">
                    <i class="fas fa-box admin-sidebar__icon"></i> Quản lý sản phẩm
                </a>

                <a href="#" class="admin-sidebar__link">
                    <i class="fas fa-industry admin-sidebar__icon"></i> Quản lý người dùng
                </a>
                <a href="#" class="admin-sidebar__link">
                    <i class="fas fa-star admin-sidebar__icon"></i> Quản lý đơn hàng
                </a>
                <a href="#" class="admin-sidebar__link">
                    <i class="fas fa-home admin-sidebar__icon"></i> Về trang chủ
                </a>
            </div>
        </div>
    </div>
<div class="view-product container mt-5 p-4 bg-light rounded shadow-sm">
    <div class="row ">

        <div class="col-md-4 text-center view-product__image-wrapper">
            <p>HÌNH MẶT TRƯỚC SÁCH</p>
            <img src="<?= $item['front_image']?>" alt="Doremon" class="img-fluid rounded shadow view-product__image">
        </div>

        <div class="col-md-4 text-center view-product__image-wrapper">
            <p>HÌNH MẶT SAU SÁCH</p>
            <img src="<?= $item['back_image']?>" alt="Doremon" class="img-fluid rounded shadow view-product__image">
        </div>
        <div class="col-md-4 view-product__info">
            <h3 class="text-primary font-weight-bold mb-4 view-product__title">
                <i class="fas fa-info-circle"></i> Thông tin sản phẩm
            </h3>

            <ul class="list-unstyled mb-4 view-product__details">
                <li><strong>Tên sản phẩm:</strong> <?= $item['product_name']?></li>
                <li><strong>Giá:</strong> <span class="text-danger font-weight-bold"><?= number_format((float)$item['price'], 0, ',', '.') . ' ₫'; ?>
</span></li>
                <li><strong>Giá Khuyến mãi:</strong> <span class="text-danger font-weight-bold"><?= number_format(
    $item['price'] - ($item['price'] * $item['sale'] / 100),
    0,
    ',',
    '.'
) . ' đ'; ?>
</span></li>
                <li><strong>Loại sản phẩm:</strong> <?= $item['product_type']?></li>

                <li><strong>Tên tác giả:</strong> <?= $item['author']?></li>

                <li><strong>Kích thước :</strong> <?= $item['framework']?></li>
                <li><strong>Số trang :</strong> <?= $item['number_of_pages']?></li>
                <li><strong>Định dạng :</strong> <?= $item['format']?></li>
                <li><strong>Trọng lượng:</strong> <?= $item['weight']?></li>
                <li><strong>Thuộc bộ sách:</strong> <?= $item['book_series']?></li>
                     
                <li><strong>Khuyến mãi:</strong> <?= $item['sale']?>%</li>

                <li><strong>Số lượng:</strong> 5</li>
            </ul>
            <div class="view-product__description mb-4">
                <h5 class="font-weight-bold">Mô tả sản phẩm:</h5>
                <div class="border rounded bg-white p-3">
                    <p><?= $item['book_description']?></p>
                </div>
            </div>

            <a href="<?php echo base_url(); ?>index.php/Admin/getAllProduct" class="btn btn-outline-secondary view-product__back">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
