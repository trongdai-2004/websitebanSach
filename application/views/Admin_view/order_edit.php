<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật trạng thái đơn hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\order_details.css?=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="order-edit-page">

<body class="order-details-page">
     <?php   $this->load->view('components/header_admin') ?>
    <div class="container mt-5 order-edit__container">
        <h2 class="mb-4"><i class="fas fa-edit"></i> Cập nhật trạng thái đơn hàng: <span class="text-primary">ORD12345</span></h2>

        <form method="post" action="<?= base_url('index.php/Admin/updateOrder') ?>">
    <input type="hidden" name="id" value="<?= $editOrder['id'] ?>">

    <div class="form-group">
        <label>Khách hàng</label>
        <input type="text" class="form-control" value="<?= $editOrder['name'] ?>" readonly>
    </div>

    <div class="form-group">
        <label>Ngày đặt</label>
        <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($editOrder['order_date'])) ?>" readonly>
    </div>

    <div class="form-group">
        <label>Địa chỉ giao hàng</label>
        <textarea class="form-control" rows="3" readonly><?= $editOrder['Address'] ?></textarea>
    </div>

    <div class="form-group">
        <label>Trạng thái đơn hàng</label>
       <select class="form-control" id="status" name="status">
    <option value="Đang xử lý" <?= $editOrder['status'] == 'Đang xử lý' ? 'selected' : '' ?>>Đang xử lý</option>
    <option value="Đã xác nhận" <?= $editOrder['status'] == 'Đã xác nhận' ? 'selected' : '' ?>>Đã xác nhận</option>
    <option value="Đang giao" <?= $editOrder['status'] == 'Đang giao' ? 'selected' : '' ?>>Đang giao</option>
    <option value="Đã giao" <?= $editOrder['status'] == 'Đã giao' ? 'selected' : '' ?>>Đã giao</option>
    <option value="Đã huỷ" <?= $editOrder['status'] == 'Đã huỷ' ? 'selected' : '' ?>>Đã huỷ</option>
</select>
    </div>

    <div class="form-group text-right">
        <a href="<?= base_url('index.php/Admin/getOrder') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Cập nhật trạng thái
        </button>
    </div>
</form>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const statusSelect = document.getElementById('status');

    const statusOrder = {
        "Đang xử lý": 1,
        "Đã xác nhận": 2,
        "Đang giao": 3,
        "Đã giao": 4,
        "Đã huỷ": 5
    };

    const currentStatus = statusSelect.value;
    const currentRank = statusOrder[currentStatus];

    // Cho phép hiển thị trạng thái hiện tại, trạng thái kế tiếp và "Đã huỷ"
    Array.from(statusSelect.options).forEach(option => {
        const optionRank = statusOrder[option.value];

        const isSame = optionRank === currentRank;
        const isNext = optionRank === currentRank + 1;
        const isCancel = option.value === "Đã huỷ";

        if (!(isSame || isNext || isCancel)) {
            option.remove();
        }
    });

    // Nếu trạng thái đã là "Đã giao" hoặc "Đã huỷ" thì không cho chọn nữa
    if (currentStatus === "Đã giao" || currentStatus === "Đã huỷ") {
        statusSelect.disabled = true;
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
        }
    }
});
</script>



</body>
</html>
