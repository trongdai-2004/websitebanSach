
<?php   $this->load->view('components/header') ?>
<div style="text-align:center; padding:50px;">
    <h2>Thanh toán qua Vietcombank</h2>
    <p><strong>Số tiền:</strong> <?= number_format($amount) ?> đ</p>
    <p><strong>Nội dung:</strong> <?= htmlspecialchars($info) ?></p>
    <img src="<?= $qrUrl ?>" alt="QR Thanh toán Vietcombank" style="width:250px; margin:20px 0;">
    <p>➡ Mở ứng dụng Vietcombank, chọn <b>Quét mã QR</b> để thanh toán.</p>
    
    <!-- Nút xác nhận đã thanh toán -->
    <form action="<?= site_url('User/confirmPayment') ?>" method="post">
        <button type="submit" style="padding:12px 20px; background:#28a745; color:white; border:none; border-radius:8px; font-size:16px; cursor:pointer;">
            Tôi đã thanh toán
        </button>
    </form>
</div>
<?php   $this->load->view('components/footer') ?>
