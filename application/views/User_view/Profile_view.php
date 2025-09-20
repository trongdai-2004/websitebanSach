<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thông tin cá nhân</title>

  <!-- Bootstrap 4.6 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/view_profile.css">
</head>


<body class="profile">
   


<?php $this->load->view('components/header'); ?> 

<form action="<?= base_url('index.php/User/updataProfile')?>" method="post" enctype="multipart/form-data">

 <input type="hidden" name="id" value="<?= isset($user['id']) ? $user['id'] : 'không có'; ?>">
 <input type="hidden" name="avatar2" value="<?= isset($user['avatar']) ? $user['avatar'] : 'không có'; ?>">
  <div class="container profile__container">
    <div class="row no-gutters bg-white rounded shadow p-4 mb-4">
      <!-- Avatar -->
      <div class="col-md-4 text-center profile__avatar-section d-flex flex-column align-items-center justify-content-center">
        <img  id="avatarPreview"  src="<?= !empty($user['avatar']) ? $user['avatar'] : base_url('public/images/avatarGGjpeg.jpeg'); ?>" alt="Avatar" class="profile__avatar-img mb-2">
        <!-- Nút đổi ảnh bên dưới -->
        <label for="avatar" class="profile__avatar-btn btn btn-info btn-sm mb-2">
          <i class="fas fa-camera"></i> Đổi ảnh
        </label>
        <input type="file" name="avatar" id="avatar" class="d-none" accept="image/*">
        <!-- Tên đăng nhập -->
        <p class="profile__username mt-2 font-weight-bold text-dark"><?= isset($user['nickname']) ? $user['nickname'] : 'rỗng'; ?></p>
      </div>

      <!-- Thông tin người dùng -->
      <div class="col-md-8 profile__info-section pl-md-4 mt-4 mt-md-0">
        <h2 class="profile__title mb-4">Thông tin người dùng</h2>
  

        <div class="form-group profile__field">
          <label class="profile__label">Họ và tên</label>
          <input type="text" name="full_name" class="form-control profile__input"  placeholder="Họ và Tên" value="<?= isset($user['full_name']) ? $user['full_name'] : 'Khách'; ?>" >

        </div>

        <div class="form-group profile__field">
          <label class="profile__label">Email</label>
          <input type="email" name="email" class="form-control profile__input"  placeholder="example@gmail.com" value="<?= isset($user['email']) ? $user['email'] : 'Khách'; ?>">
        </div>
          <div class="form-group profile__field">
          <label class="profile__label">Địa chỉ</label>
          <input type="text" class="form-control profile__input" name="address" placeholder="Địa chỉ " value="<?= isset($user['address']) ? $user['address'] : 'null'; ?>" >
        </div>

        <div class="form-group profile__field">
          <label class="profile__label">Số điện thoại</label>
          <input type="text" class="form-control profile__input" name="phone_number" placeholder="" value="<?= isset($user['phone_number']) ? $user['phone_number'] : ''; ?>" >
        </div>

        <div class="form-group profile__field">
          <label class="profile__label">Ngày sinh</label>
          <?php
$dob = (isset($user['date_of_birth']) && $user['date_of_birth'] != '0000-00-00') ? $user['date_of_birth'] : '';
?>
<input type="date" class="form-control profile__input" name="date_of_birth" value="<?= $dob; ?>">

        </div>

        <div class="form-group profile__field ">
          <label class="profile__label">Giới tính</label>
          <select class="form-control profile__input" name="sex">
            <option value="Nam" <?= ($user['sex'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= ($user['sex'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
            <option value="Khác" <?= ($user['sex'] == 'Khác') ? 'selected' : '' ?>>Khác</option>
          </select>
        </div>


        <div class="profile__actions mt-4 d-flex">
  <button type="submit" class="btn profile__btn profile__btn--save mr-2">Lưu thay đổi</button>
  <button type="button" class="btn profile__btn profile__btn--cancel" onclick="window.location.href='<?= base_url('index.php/User/profile'); ?>'">Hủy</button>
</div>

      </div>
    </div>

    </form>

    <!-- Lịch sử mua hàng -->
    <div class="bg-white rounded shadow p-4 profile__orders">
      <h3 class="profile__section-title mb-4">Lịch sử mua hàng</h3>

      <div class="table-responsive">
        <table class="table table-bordered profile__orders-table">
          <thead class="thead-light">
            <tr>
              <th>Mã đơn</th>
              <th>Ngày mua</th>
              <th>Sản phẩm</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>

           <?php foreach ($orders as $item): ?>
<tr>
  <td><?= $item['order_id'] ?></td>
  <td><?= $item['order_date'] ?></td>
  <td><?= $item['products'] ?></td>
  <td><?= number_format($item['order_total'], 0, ',', '.') ?> đ</td>
  <td>
    <span class="badge badge-success">
      <?= isset($item['status']) ? $item['status'] : 'Đang xử lý' ?>
    </span>
  </td>
  <td>
    <a href="<?= base_url('index.php/User/viewOrder/'.$item['order_id']) ?>" 
   class="btn btn-info btn-sm">Xem chi tiết</a>
  <?php if (trim(strtolower($item['status'])) == 'chờ xác nhận'): ?>

  <a href="<?= base_url('index.php/User/cancelOrder/'.$item['order_id']) ?>" 
     onclick="return confirm('Bạn có chắc chắn muốn hủy đơn này không?')" 
     class="btn btn-danger btn-sm">Hủy đơn</a>
<?php else: ?>
  <button class="btn btn-secondary btn-sm" disabled>Không thể hủy</button>
<?php endif; ?>
  </td>

</tr>
<?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php $this->load->view('components/footer') ?>

  <script>
  document.getElementById('avatar').addEventListener('change', function (event) {
    const [file] = event.target.files;
    if (file) {
      const preview = document.getElementById('avatarPreview');
      preview.src = URL.createObjectURL(file);
    }
  });
</script>
</body>
</html>
