    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Admin BookOra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css?=1.1">
</head>
<body>
     <?php   $this->load->view('components/header_admin') ?>
       
    <div style="position:fixed; top:20px; right:30px; z-index:2000;">
        <div style="position:relative; display:inline-block;">
            <span id="bell" style="font-size:28px; cursor:pointer; color:blue;">
                <i class="fas fa-bell"></i>
            </span>
            <span id="orderCount"
                  style="position:absolute; top:-8px; right:-8px; background:red; color:white; 
                         border-radius:50%; padding:2px 7px; font-size:12px; display:none;">
            </span>
        </div>
       <div id="notificationBox"
     style="display:none; position:absolute; right:0; top:40px; 
            width:320px; max-height:400px; overflow-y:auto;
            background: transparent; border:none; box-shadow:none;">
</div>

    </div>


    <div class="admin-content">
        <h2 class="admin-content__title"><i class="fas fa-chart-line"></i> Tổng quan hệ thống</h2>

         <div class="dashboard-summary__row">
  <div class="dashboard-summary__item dashboard-summary__item--blue">
    <div class="dashboard-summary__icon"><i class="fas fa-box"></i></div>
                    <div class="dashboard-summary__title">Sản phẩm</div>
                    <div class="dashboard-summary__value"><?=$totalProduct?></div>
  </div>
  <div class="dashboard-summary__item dashboard-summary__item--green">
    <div class="dashboard-summary__icon"><i class="fas fa-users"></i></div>
                    <div class="dashboard-summary__title">Người dùng</div>
                    <div class="dashboard-summary__value"><?=$totalUser?></div>
  </div>
  <div class="dashboard-summary__item dashboard-summary__item--yellow">
    <div class="dashboard-summary__icon"><i class="fas fa-receipt"></i></div>
                    <div class="dashboard-summary__title">Đơn hàng</div>
                    <div class="dashboard-summary__value"><?=$totalOrder?></div>
  </div>
  <div class="dashboard-summary__item dashboard-summary__item--red">
   <div class="dashboard-summary__icon"><i class="fas fa-star"></i></div>
                    <div class="dashboard-summary__title">Đánh giá</div>
                    <div class="dashboard-summary__value">37</div>
  </div>
</div>

        <div class="dashboard-chart">
            <h4 class="dashboard-chart__title">Biểu đồ doanh thu</h4>
            <div class="dashboard-chart__canvas card p-4">
                <canvas id="revenueChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Doanh thu (triệu)',
                backgroundColor: 'rgba(0,123,255,0.1)',
                borderColor: 'rgb(0,123,255)',
                data: <?= json_encode($values) ?>,
                fill: true
            }]
        },

        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: false }
            }
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function checkNewOrders() {
    $.ajax({
        url: "<?= base_url('index.php/admin/checkNewOrders') ?>",
        method: "GET",
        success: function(res) {
    let data = JSON.parse(res);
    if (data.status === 'success') {
        let count = data.orders.length;
        $("#orderCount").text(count).show();

        let html = "";
        data.orders.forEach(order => {
            html += `
              <div onclick="openOrder(${order.id})" style="
    padding:12px; 
    border:1px solid #303841; 
    background: linear-gradient(135deg, #8EC8F8, #d9f0ff); 
    border-radius:10px;
    margin-top:10px;
    box-shadow:0 2px 6px rgba(0,0,0,0.15);
    font-family: Arial, sans-serif;
    cursor:pointer;
">
    <div style="margin-bottom:5px;">
        <b style="color:#1e3c72;">👤 Khách:</b> 
        <span style="color:#000;">${order.name}</span>
    </div>
    <div style="margin-bottom:5px;">
        <b style="color:#2a9d8f;">📞 SĐT:</b> 
        <span style="color:#000;">${order.sdt}</span>
    </div>
    <div style="margin-bottom:5px;">
        <b style="color:#e63946;">💰 Tổng:</b> 
        <span style="color:#d00000; font-weight:bold;">${formatVND(order.final_price)}</span>
    </div>
    <div style="margin-bottom:8px; font-size:12px; color:#6c757d;">
        ⏰ ${order.order_date}
    </div>
</div>

            `;
        });
        $("#notificationBox").html(html);
    } else {
        $("#orderCount").hide();
        $("#notificationBox").html("<div style='padding:10px;'>Không có đơn hàng mới</div>");
    }
}

    });
}

// Đánh dấu đơn hàng đã đọc
function markAsRead(id, btn) {
    $.ajax({
        url: "<?= base_url('index.php/admin/markOrderRead/') ?>" + id,
        method: "POST",
        success: function() {
            $(btn).parent().remove();
            let currentCount = parseInt($("#orderCount").text());
            if (currentCount > 1) {
                $("#orderCount").text(currentCount - 1);
            } else {
                $("#orderCount").hide();
            }
        }
    });
}

// Toggle hiển thị box khi bấm chuông
$("#bell").click(function(){
    $("#notificationBox").toggle();
});

// Kiểm tra đơn hàng mới mỗi 5 giây
setInterval(checkNewOrders, 1000);
function formatVND(amount) {
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VNĐ";

}
function openOrder(id) {
    $.ajax({
        url: "<?= base_url('index.php/admin/markOrderRead/') ?>" + id,
        method: "POST",
        success: function() {
            window.location.href = "<?= base_url('index.php/Admin/getOrderDetails/') ?>" + id;
        }
    });
}


</script>



</body>
</html>
