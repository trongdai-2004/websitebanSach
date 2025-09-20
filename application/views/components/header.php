
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\bootstrap\bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\components\header.css?=2.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <header>
        <div class="header">
           
                
           
            <div class="row">
                <div class="col-1">
                    <a href="" class="header__logo">
                        <img src="<?php echo base_url(); ?>public\images\logo.png" alt="">
                    </a>
                </div>
                <div class="col-1">
                    <a href="<?php echo base_url(); ?>index.php/User/indexUser" class="header__title">
                        <p>BookOra</p>
                    </a>
                </div>

                <div class="col-1">
                    <a href="<?php echo base_url(); ?>index.php/User/indexUser" class="header__index">
                        <p>Trang chủ</p>
                    </a>
                </div>
                <div class="col-1">
                    <a href="<?php echo base_url(); ?>index.php/User/about" class="header__introduce">
                        <p>Giới thiệu</p>
                    </a>
                </div>
                <div class="col-1">
                    <a href="" class="header__contact">
                        <p>Liên hệ </p>
                    </a>
                </div>
                <div class="col-1">
                    <div class="header__search">
                        <button class="header__search-topic">
                            <p>Chủ đề</p> 
                            <a href="#" class="icon__down"><i class="fa-solid fa-chevron-down"></i></a>
                        </button>
                    </div>
                </div>
              <div class="col-2">
  <form method="GET" action="<?= base_url('index.php/User/search') ?>">
    <div class="header__search">
      <input type="text" name="keyword" class="header__search-input" placeholder="Tìm kiếm..." required>
      <button type="submit" class="icon__search" style="border: none; background: none;">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </div>
  </form>
</div>

                <div class="col-1">
                    <div class="header__car" >
                    <a href="<?php echo base_url(); ?>index.php/User/order_detail" >
                        
                        <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </div>
                        <p>    <!-- Chuông -->
                        <span id="userBell" style="font-size:34px; cursor:pointer; color:#000000; position:relative;top: -45px;margin-left: 20px;">
                          <i class="fas fa-bell"></i>
                          <span id="userOrderCount" 
                                style="position:absolute; top:20px; right:-10px; background:red; color:white;
                                       border-radius:50%; padding:2px 6px; font-size:12px; display:none;">
                          </span>
                        </span>

                        <!-- Box thông báo -->
                        <div id="userNotificationBox" 
                             style="display:none; position:absolute; top:40px; right:70px; width:300px; 
                                    background:white; border:1px solid #ccc; border-radius:8px; 
                                    box-shadow:0 4px 8px rgba(0,0,0,0.1); z-index:999;">
                        </div> </p>
                        
                    
                </div>

                
                <div class="col-1">
                    <a href="<?php echo base_url(); ?>index.php/User/profile" class="header__avatar">
                        <img src=" <?= !empty($user['avatar']) ? $user['avatar'] : base_url('public/images/avatarGGjpeg.jpeg'); ?>" alt="">
                    </a>
                </div>
                <div class="col-1">
                    <a href="<?php echo base_url(); ?>index.php/User/profile" class="header__nickname">
                       <p><?= isset($user['nickname']) ? $user['nickname'] : 'Khách'; ?></p>

                    </a>
                </div>
                <div class="col-1">
                    <a href="<?php echo base_url(); ?>index.php/Auth/login" class="header__logout">
                        <p>Đăng xuất </p>
                    </a>
                </div>
                <div class="underline">

                </div>
   






            </div>
            
        </div>

    </header>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

   const userId = "<?= $this->session->userdata('user_id'); ?>"; 
   setInterval(function() {
       $.getJSON("<?= base_url('index.php/user/checkOrderStatus/') ?>" + userId, function(res) {
           if (res.status === 'success') {
               let html = '';
              res.orders.forEach(order => {
    html += `<div class="notification-item">
                <h4>Đơn hàng #${order.id}</h4>
                <p>Trạng thái: <span style="color:orange;">${order.status}</span></p>
                <p>Tổng tiền: <span class="price">${formatVND(order.final_price)}</span></p>
                <div class="notification-actions">
                  <a href="<?= base_url('index.php/user/viewOrder/') ?>${order.id}" 
                     class="detail-btn"
                     onclick="markUserOrderRead(${order.id})">Xem chi tiết</a>
                </div>
             </div>`;
});

              
               $("#userNotificationBox").html(html);
               $("#userOrderCount").text(res.orders.length).show();
           } else {
               $("#userOrderCount").hide();
           }
       });
   }, 1000);

function markUserOrderRead(orderId) {
    $.getJSON("<?= base_url('index.php/user/markUserOrderRead/') ?>"+orderId, function(res) {
        if (res.status === 'ok') {
            // Ẩn thông báo này khỏi box
            $(`#userNotificationBox div:has(a[href*='${orderId}'])`).fadeOut();

            // Giảm số badge đi 1
            let count = parseInt($("#userOrderCount").text());
            if (count > 1) {
                $("#userOrderCount").text(count - 1);
            } else {
                $("#userOrderCount").hide();
            }
        }
    });
}


function formatVND(number) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
}
$("#userBell").on("click", function() {
    $("#userNotificationBox").toggle();
});
// Đóng thông báo khi click ra ngoài
$(document).on("click", function(e) {
    const $box = $("#userNotificationBox");
    const $bell = $("#userBell");

    if (!$box.is(e.target) && $box.has(e.target).length === 0 &&
        !$bell.is(e.target) && $bell.has(e.target).length === 0) {
        $box.hide();
    }
});



</script>
    

</body>

</html>