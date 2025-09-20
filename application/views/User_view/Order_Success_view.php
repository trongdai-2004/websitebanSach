<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đặt hàng thành công</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/view_order.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>



<body class="order">
<?php $this->load->view('components/header') ?>
  <div class="order__container">
    <h5 class="order__title">ĐẶT HÀNG THÀNH CÔNG</h5>
    <p class="order__message">
      Cảm ơn bạn đã đặt hàng tại <strong>BookOra</strong>
    </p>
    <p class="order__total">
      Tổng tiền thanh toán: <span class="order-success__price"><?= number_format($final_price, 0, ',', '.') . 'đ'?></span>
    </p>
   
    <p class="order__info">
      Để xem lịch sử mua hàng vui lòng 
      <a href="<?= base_url('index.php/User/profile'); ?>" class="order__link">Xem tại đây</a>
    </p>

    <hr class="order__divider">

    <p class="order__support">
      Để được hỗ trợ vui lòng gọi vào hotline 
      <a href="tel:19001348" class="order__hotline"> 0977 799 305</a>
    </p>
  </div>
<?php $this->load->view('components/footer') ?>
</body>
</html>
