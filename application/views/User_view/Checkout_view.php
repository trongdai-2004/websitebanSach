<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thanh Toán - BookOra</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\view_checkout.css">
</head>
 <?php   $this->load->view('components/header') ?>
<body class="checkout">
   <form class="login-form" action="<?php echo base_url() .'index.php/User/addOrders'?>" method="post" enctype="multipart/form-data">
  <div class="checkout__container">
    <div class="row">
       
      <!-- Cột trái -->
      <div class="col-md-8">
        <div class="checkout__methods">
          <h5 class="checkout__section-title">CHỌN PHƯƠNG THỨC THANH TOÁN</h5>
          <div class="checkout__method-btn">Tài khoản ngân hàng <i class="fas fa-angle-right"></i></div>
          <div class="checkout__method-btn">Ví điện tử Momo <img src="<?php echo base_url(); ?>public\images\momo.png" alt="Momo"></div>
          <div class="checkout__method-btn">Ví Zalo Pay <img src="<?php echo base_url(); ?>public\images\zalopay.png" alt="ZaloPay"></div>
          <div class="checkout__method-btn">Thanh toán khi nhận hàng <i class="fas fa-angle-right"></i></div>
        </div>

        <div class="checkout__info">
          <h5 class="checkout__section-title">THÔNG TIN NGƯỜI NHẬN</h5>

          <div class="checkout__field">
            <label>Họ và tên</label>
            <input type="text" name="name" value="<?= isset($userProfile['full_name']) ? $userProfile['full_name'] : 'Khách'; ?>" class="form-control" placeholder="Nhập họ và tên" required>
          </div>

          <div class="checkout__field">
            <label>Số điện thoại</label>
            <input type="text" name="sdt" value="<?= isset($userProfile['phone_number']) ? $userProfile['phone_number'] : ''; ?>" class="form-control" placeholder="Nhập số điện thoại"required>
          </div>

          <div class="checkout__field">
            <label>Email</label>
            <input type="email" name="email" value="<?= isset($userProfile['email']) ? $userProfile['email'] : ''; ?>" class="form-control" placeholder="Nhập email" required>
          </div>

        
          <div class="checkout__field">
            <label>Địa chỉ</label>
            <input type="text" class="form-control" value="<?= isset($userProfile['address']) ? $userProfile['address'] : ''; ?>" name="address" placeholder="Nhập địa chỉ cụ thể" required>
          </div>

          <div class="checkout__field">
            <label>Ghi chú</label>
            <textarea class="form-control" name="note" placeholder="Nhập nội dung..."></textarea>
          </div>
        </div>
      </div>

      <!-- Cột phải -->
      <div class="col-md-4">
        <div class="checkout__summary">
          <h5 class="checkout__section-title">THÔNG TIN ĐƠN HÀNG</h5>


          <div class="checkout__summary-row">
            <span>Tạm tính:</span>
            <strong><?= number_format($total_price, 0, ',', '.') ?> đ
</strong>
          </div>

          <div class="checkout__summary-row">
            <span>Giảm giá:</span>
            <strong><?= number_format($discount_price, 0, ',', '.') . 'đ'?></strong>
          </div>

          <div class="checkout__summary-row">
            <span>Phí ship:</span>
            <strong>20,000đ</strong>
          </div>

          <div class="checkout__note">
            Phí ship tính theo đơn và không giới hạn số lượng sách
          </div>

          <div class="checkout__summary-row checkout__total">
            <span>Thành tiền:</span>
            <strong><?= number_format($final_price, 0, ',', '.') . 'đ'?></strong>
          </div>

          <p class="checkout__terms">
            Bằng việc nhấn thanh toán, bạn đồng ý với 
            <a href="#">Các điều khoản khách hàng</a>
          </p>
           
          <button class="checkout__btn">Đặt hàng</button>
        </form>
        </div>
      </div>

    </div>
  </div>
</form>
</body>
<?php   $this->load->view('components/footer') ?>
</html>
