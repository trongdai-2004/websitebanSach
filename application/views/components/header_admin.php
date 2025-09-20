<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css">
</head>
<body>
      <div class="admin-sidebar">
        <div class="admin-sidebar__logo">
            <img src="<?php echo base_url(); ?>public\images\logo.png" alt="Logo" class="admin-sidebar__logo-img">
            <span class="admin-sidebar__logo-text">BookOra</span>
       
        </div>

        <div class="dashboard-summary">
            <div class="dashboard-summary__row">
                <a href="<?php echo base_url();?>index.php/Admin/dashboard" class="admin-sidebar__link admin-sidebar__link--active">
                    <i class="fas fa-chart-line admin-sidebar__icon"></i> Dashboard
                </a>
                <a href="<?php echo base_url(); ?>index.php/Admin/getAllProduct" class="admin-sidebar__link">
                    <i class="fas fa-box admin-sidebar__icon"></i> Quản lý sản phẩm
                </a>
                <a href="<?php echo base_url(); ?>index.php/Admin/getInformationUser" class="admin-sidebar__link">
                    <i class="fas fa-user admin-sidebar__icon"></i> Quản lý người dùng
                </a>
                <a href="<?php echo base_url(); ?>index.php/Admin/getOrder" class="admin-sidebar__link">
                    <i class="fas fa-star admin-sidebar__icon"></i> Quản lý đơn hàng
                </a>
                <a href="<?php echo base_url(); ?>index.php/Auth/login" class="admin-sidebar__link">
                    <i class="fas fa-home admin-sidebar__icon"></i> Đăng xuất 
                </a>
            </div>
        </div>
    </div>
  <script>
    // Tự động đánh dấu active theo URL hiện tại
    const currentUrl = window.location.href;
    const menuLinks = document.querySelectorAll('.admin-sidebar__link');

    menuLinks.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('admin-sidebar__link--active');
        } else {
            link.classList.remove('admin-sidebar__link--active');
        }
    });
</script>


    
</body>
</html>