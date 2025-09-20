<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chi tiết đơn hàng - BookOra</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/view_order_details.css?=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="order-page">
  <!-- Header -->
  <?php $this->load->view('components/header') ?>

  <!-- Container -->
  <div class="container order-container my-4">
    <div class="row">
              <?php
  $tam_tinh = 0;
  $tien_giam = 0;
  $tong_thanh_toan = 0;

  if (!empty($cart)) {
    foreach ($cart as $item) {
      $final_price = $item['price'] * $item['quantity'];
      $final_sale = $final_price * $item['sale'] / 100;
      $final_total = $final_price - $final_sale;

      $tam_tinh += $final_price;
      $tien_giam += $final_sale;
      $tong_thanh_toan += $final_total;
    }
  }
?>

      
        
      
      <!-- Cột trái: Danh sách sản phẩm -->
      <div class="col-md-8">
         <?php if (empty($cart)): ?>
      <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
    <?php else: ?>
        <?php foreach ($cart as $item ): ?>
          <input type="hidden" name="id" value="<?=$item['id'] ?>">
        <div class="order-details__item d-flex align-items-center p-3 mb-4 shadow-sm rounded bg-white">
          <img src="<?= $item['front_image'] ?>" alt="Sản phẩm" class="order-details__image mr-4" style="width:100px;">
          <div class="order-details__info flex-grow-1">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="order-details__title mb-0"><?= $item['product_name'] ?></h5>
              <a href="<?php echo base_url(); ?>index.php/User/deleteCart/<?= $item['id'] ?>" class="" title="Xóa sản phẩm">
                <i class="fas fa-trash fa-lg"></i>
              </a>
            </div>
       <p class="order-details__price text-danger mb-1 item-price" data-id="<?= $item['product_id'] ?>">
  <?= number_format($item['price'] * $item['quantity'] * (1 - $item['sale'] / 100), 0, ',', '.') . 'đ' ?>
</p>


        <div class="order-details__quantity d-flex align-items-center mb-1">
  <span>Số lượng</span>
  <button class="btn btn-sm btn-outline-secondary ml-2 update-qty" data-action="decrease" data-id="<?= $item['product_id'] ?>">-</button>
<span class="mx-2 quantity-text" data-id="<?= $item['product_id'] ?>"><?= $item['quantity'] ?></span>
<button class="btn btn-sm btn-outline-secondary update-qty" data-action="increase" data-id="<?= $item['product_id'] ?>">+</button>

</div>

          </div>
        </div>
         <?php endforeach ?>
         <?php endif; ?>
        <!-- Có thể thêm nhiều sản phẩm khác tại đây -->
      </div>

      <!-- Cột phải: Thông tin đơn hàng -->
      <div class="col-md-4">
        <div class="order-summary p-4 shadow-sm rounded bg-white">
          <h5 class="mb-3">THÔNG TIN ĐƠN HÀNG</h5>
        <p>Tạm tính: <span class="float-right text-danger" id="summary-total"><?= number_format($tam_tinh, 0, ',', '.') . 'đ'?></span></p>
<p>Giảm giá: <span class="float-right text-danger" id="summary-discount"><?= number_format($tien_giam , 0,',', '.') . 'đ'?></span></p>
<p><strong>Thành tiền:</strong> <span class="float-right text-danger" id="summary-final"><?= number_format($tong_thanh_toan, 0, ',', '.') . 'đ'?></span></p>

           <form class="login-form" action="<?php echo base_url() .'index.php/User/informationCart'?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <input type="hidden" name="total_price" value="<?= $tam_tinh ?>">
            <input type="hidden" name="discount_price" value="<?= $tien_giam ?>">
            <input type="hidden" name="final_price" value="<?= $tong_thanh_toan ?>">

          <button class="btn btn-info btn-block mt-3">Tiến hành thanh toán</button>
          </form>
        </div>

      </div>
     
    </div>
  </div>


  <!-- Footer -->
  <?php $this->load->view('components/footer') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $(".update-qty").click(function () {
        const id = $(this).data("id");
        const action = $(this).data("action");

        $.ajax({
            url: "<?= base_url('index.php/User/updateCartQuantity') ?>",
            type: "POST",
            dataType: 'json',  // bắt buộc
            data: { id: id, action: action },
            success: function (result) {
                if (result.success) {
                    $(`.quantity-text[data-id="${id}"]`).text(result.new_quantity);
                    $(`.item-price[data-id="${id}"]`).text(result.item_total_price);
                    $("#summary-total").text(result.summary_total);
                    $("#summary-discount").text(result.summary_discount);
                    $("#summary-final").text(result.summary_final);

                    // Cập nhật input hidden form
                    $('input[name="total_price"]').val(result.summary_total.replace(/\./g,'').replace('đ',''));
                    $('input[name="discount_price"]').val(result.summary_discount.replace(/\./g,'').replace('đ',''));
                    $('input[name="final_price"]').val(result.summary_final.replace(/\./g,'').replace('đ',''));
                } else {
                    alert("Không thể cập nhật số lượng: " + (result.message || ""));
                }
            },
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
                alert("Lỗi khi cập nhật số lượng.");
            }
        });
    });
});

</script>



</body>
</html>
