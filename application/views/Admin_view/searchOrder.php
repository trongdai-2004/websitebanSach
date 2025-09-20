<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng của tôi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\order_management.css">
     <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="order-page">
    <?php   $this->load->view('components/header_admin') ?>
    <div class="container mt-5 order-page__container">
        <h2 class="mb-4 order-page__title"><i class="fas fa-receipt"></i> Quản lý đơn hàng</h2>

        <form method="get" action="<?php echo base_url('index.php/Admin/searchOrder'); ?>">
    <div class="input-group mb-3 user-page__search">
        <input type="text" name="keyword" class="form-control" placeholder="🔍 Tìm theo tên hoặc số điện thoại ...">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

        <table class="table table-hover order-table">
            <thead class="thead-light order-table__header">
                <tr>
                    <th class="text-center">HỌ VÀ TÊN </th>
                    <th class="text-center">SỐ ĐIỆN THOẠI</th>
                    <th class="text-center">Mã đơn</th>
                    <th class="text-center">Ngày đặt</th>
                    <th class="text-center">Tổng tiền</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
             <?php foreach ($order as $item): ?>
            <tbody class="order-table__body">
                <tr class="order-table__row">
                    <td class="text-center"><?=$item['name']?></td>
                    <td class="text-center"><?=$item['sdt']?></td>
                    <td class="text-center"><?=$item['id']?></td>
                    <td class="text-center"><?=$item['order_date']?></td>
                    <td class="text-center"><?= number_format($item['final_price'], 0, ',', '.') ?>₫
</td>
                    <td class="text-center"><span class="badge badge-success"><?=$item['status']?></span></td>
                    <td class="text-center">
                        <a href="<?php echo base_url().'index.php/Admin/getOrderDetails/'.$item['id']; ?>" class="btn btn-sm btn-info order-table__btn-view">
                            <i class="fas fa-eye"></i> Xem
                        </a>
                    </td>
                </tr>
            </tbody>
             <?php endforeach ?>
        </table>
    </div>
</body>
</html>
