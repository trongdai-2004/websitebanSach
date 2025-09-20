<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title>Quản lý sản phẩm</title>
        <link rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="product-management.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_product_view.css">
    </head>
    <body class="product-page">
    <?php   $this->load->view('components/header_admin') ?>
        <div class="container mt-4 product-page__container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="product-page__title">
                    <i class="fas fa-users-cog"></i> QUẢN LÝ SẢN PHẨM
                </h2>
                <a href="<?php echo base_url(); ?>index.php/Admin/addProduct"
                    class="btn btn-success product-page__add-btn">
                    <i class="fas fa-plus-circle"></i> Thêm sản phẩm
                </a>

            </div>
             <form method="GET" action="<?= base_url('index.php/Admin/searchProduct') ?>">
            <div class="input-group mb-3 product-page__search">
                <input type="text" name="keyword" class="form-control"
                    placeholder="🔍 Tìm tên hoặc mô tả..." />
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

            <table class="table table-hover product-table">
                <thead class="product-table__thead">
                    <tr class="product-table__header">
                        <th class="text-center">Ảnh</th>
                        <th class="text-center">Tên</th>
                        <th class="text-center">Giá gốc</th>
                        <th class="text-center">Giá khuyến mãi</th>
                        <th class="text-center">Trạng Thái</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($product as $item): ?>
                        
                   <input type="hidden" name="product_id" value="<?= $item['id']; ?>">
                    <tr class="product-table__row">
                        <td><img src="<?= $item['front_image']; ?>"
                                alt="Ảnh sản phẩm"
                                class="product-table__image"></td>
                        <td><strong><?= $item['product_name']; ?></strong></td>
                        <td><?= number_format((float)$item['price'], 0, ',', '.') . ' đ'; ?>
                                                                                            </td>
                        <td><strong><?= number_format(
        $item['price'] - ($item['price'] * $item['sale'] / 100),
        0,
        ',',
        '.'
    ) . ' ₫'; ?>
</strong></td>

                        <td><span class="badge badge-success">Còn
                                hàng</span></td>
                        <td class="product-table__actions">
                            <a href="<?php echo base_url().'index.php/Admin/getInformationProduct/'.$item['id'];?>"
                                class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Xem
                            </a>

                            <a href="<?php echo base_url().'index.php/Admin/editProduct/'.$item['id'];?>"
                                class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="<?php echo base_url().'index.php/Admin/deleteProduct/'.$item['id'];?>" class="btn btn-danger btn-sm"
                                onclick="return confirmDelete();">
                                <i class="fas fa-trash-alt"></i>
                            </a>

                            <script>
    function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xoá sản phẩm này?");
    }
</script>
                        </td>
                    </tr>
                     <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </body>
</html>
