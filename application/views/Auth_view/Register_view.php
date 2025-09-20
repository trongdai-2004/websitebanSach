<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký - Bookora</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4.6 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\view_login.css">
</head>

<body class="login-page">

  <!-- Tiêu đề chào mừng -->
  <div class="login-page__welcome">
    CHÀO MỪNG BẠN ĐẾN VỚI BOOKORA
  </div>

  <!-- Overlay + khung form -->
  <div class="login-page__overlay">
    <div class="login-box">

      <!-- Nút đóng -->
      <div class="login-box__close">
        <button type="button" class="login-box__btn-close">&times;</button>
      </div>

      <!-- Tiêu đề -->
      <h2 class="login-box__title">Đăng ký</h2>

      <!-- Form -->

    <form class="login-form" action="<?php echo base_url() .'index.php/Auth/register'?>" method="post" enctype="multipart/form-data">

        <!-- Email -->
        <div class="form-group login-form__group">
          <label for="reg-email">Email</label>
          <input type="email" name ="email" class="form-control login-form__input" id="reg-email" placeholder="Nhập email" required>
        </div>

        <!-- Mật khẩu -->
        <div class="form-group login-form__group">
          <label for="reg-password">Mật khẩu</label>
          <input type="password" name ="password" class="form-control login-form__input" id="reg-password" placeholder="Nhập mật khẩu" required>
        </div>

        <!-- Họ tên -->
        <div class="form-group login-form__group">
          <label for="reg-name">Tên</label>
          <input type="text" name ="nickname" class="form-control login-form__input" id="reg-name" placeholder="Nhập tên"required>
        </div>

        <!-- Đồng ý điều khoản -->
       

        <!-- Nút đăng ký -->
        <button type="submit" class="btn btn-primary login-form__btn">Đăng ký</button>

        <!-- Chuyển sang đăng nhập -->
        <div class="login-form__footer">
          <span class="login-form__note">Sẵn sàng tạo tài khoản?</span>
          <a href="<?php echo base_url(); ?>index.php/Auth/login" class="login-form__register">Đăng nhập ngay</a>
        </div>

  

      </form>

    </div>
  </div>

</body>
</html>
