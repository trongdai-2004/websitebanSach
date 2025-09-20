<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../acset/css/user-management.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css">
     <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\user_management.css">
</head>
<body class="user-page">
     <?php   $this->load->view('components/header_admin') ?>

   

    <div class="container mt-4 user-page__container">
        <h2 class="product-page__title text-primary">
    <i class="fas fa-users-cog"></i> Quản lý người dùng
</h2>
  <form method="get" action="<?php echo base_url('index.php/Admin/searchUser'); ?>">
    <div class="input-group mb-3 user-page__search">
        <input type="text" name="keyword" class="form-control" placeholder="🔍 Tìm theo tên hoặc email...">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

        <table class="table table-hover user-table">
            <table class="table table-hover">
    <thead class="table__thead--lightblue">
        <tr>
            <th>Ảnh</th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Quyền</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <?php foreach ($information as $item) : ?>
            <tbody>
                <tr class="user-table__row">
                    <td class="text-center avatar">
                        <img src="<?= $item['avatar']; ?>" alt="Avatar" class="user-table__avatar">
                    </td>
                    <td><strong><?= $item['nickname']; ?></strong></td>
                    <td><?= $item['email']; ?></td>
                    <td><?= $item['role']; ?></td>
                    <td class="user-table__actions text-center">
                        <a href="<?php echo base_url().'index.php/Admin/getInformationUserByID/'.$item['id']; ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Xem
                        </a>
                    </td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xoá người dùng này?");
        }
    </script>
</body>
</html>
