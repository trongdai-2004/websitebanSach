<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập - Bookora</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4.6 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">
  <!-- File CSS chính -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\view_login.css">
</head>


<body class="login-page">
  
  <!-- Tiêu đề chào mừng -->
  <div class="login-page__welcome">
    CHÀO MỪNG BẠN ĐẾN VỚI BOOKORA
  </div>

  <!-- Overlay và khung đăng nhập -->
  <div class="login-page__overlay">
    <div class="login-box">

      <!-- Nút đóng -->
      <div class="login-box__close">
        <button type="button" class="login-box__btn-close">&times;</button>
      </div>

      <!-- Tiêu đề form -->
      <h2 class="login-box__title">Đăng nhập</h2>

      <!-- Form -->

        <form class="login-form" action="<?php echo base_url() .'index.php/Auth/login'?>" method="post" enctype="multipart/form-data">

        <!-- Email -->
        <div class="form-group login-form__group">
          <label for="email">Email</label>
          <input type="email" name= "email" class="form-control login-form__input" id="email" placeholder="Nhập email" required>
        </div>

        <!-- Mật khẩu -->
        <div class="form-group login-form__group">
          <label for="password">Mật khẩu</label>
          <input type="password" name= "password" class="form-control login-form__input" id="password" placeholder="Nhập mật khẩu"required>
        </div>
      <style>
    .google-login {
    display: block;       
    text-align: center;   
    margin-top: 20px;     
    text-decoration: none;
    color: #2EABFF;
}
    </style>

<a href="<?= site_url('Auth/login_google') ?>" class="google-login">
    Đăng nhập bằng Google
</a>
          
        <!-- Nhớ mật khẩu & Quên mật khẩu -->
        <div class="login-form__options">
          
          <a href="#" class="login-form__forgot">Quên mật khẩu</a>
        </div>

        <!-- Nút đăng nhập -->
        <button type="submit" class="btn btn-primary login-form__btn">Đăng nhập</button>

        <!-- Footer: Đăng ký -->
        <div class="login-form__footer">
          <span class="login-form__note">Không nhớ tài khoản?</span>
          <a href="<?php echo base_url(); ?>index.php/Auth/loadRegister" class="login-form__register">Đăng ký ngay</a>
        </div>

      
    
</a>


      </form>

    </div>
  </div>

</body>
</html>
