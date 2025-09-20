<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_addProduct_view.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\admin_index_view.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php   $this->load->view('components/header_admin') ?>
    
    <?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>


    <div class="container mt-5 add-product__container">
        <h3 class="text-primary mb-4"><i class="fas fa-plus-circle"></i> ➕ SỬA SẢN PHẨM </h3>
 <form action="<?= base_url('index.php/Admin/updateProduct') ?>" method="POST" enctype="multipart/form-data">
       
            <div class="form-group">
                <label for="product_name">Tên sản phẩm</label>
                <input type="text" id="product_name" name="product_name" class="form-control" value="<?= $item['product_name']?>">
            </div>

            <div class="form-group">
                <label for="price">Giá gốc</label>
               <input type="number" id="price" name="price" class="form-control" 
       value="<?= (float)$item['price']; ?>" step="1" min="1000">
            </div>
            <div class="form-group">
                <label for="product_type">Loại sản phẩm</label>
                <input type="text" id="product_type" name="product_type" class="form-control" value="<?= $item['product_type']?>">
            </div>
       
       <div class="form-group">
    <label for="front_image">Hình mặt trước </label>
    <input type="file" id="front_image" name="front_image" class="form-control"
           onchange="previewImage(this, '#frontPreview')">
    <img id="frontPreview"
         src="<?= !empty($item['front_image']) ? $item['front_image']: '#' ?>"
         alt="Xem trước ảnh mặt trước"
         style="max-height:200px; margin-top:10px; <?= !empty($item['front_image']) ? '' : 'display:none;' ?>">
</div>

<div class="form-group">
    <label for="back_image">Hình mặt sau</label>
    <input type="file" id="back_image" name="back_image" class="form-control"
           onchange="previewImage(this, '#backPreview')">
  <img id="backPreview"
     src="<?= !empty($item['back_image']) ? $item['back_image'] : '#' ?>"
     alt="Xem trước ảnh mặt sau"
     style="max-height:200px; margin-top:10px; <?= !empty($item['back_image']) ? '' : 'display:none;' ?>">

</div>

<input type="hidden" name="old_front_image" value="<?= $item['front_image'] ?>">
<input type="hidden" name="old_back_image" value="<?= $item['back_image'] ?>">
<input type="hidden" name="id" value="<?= $item['id'] ?>">
             <div class="form-group">
                <label for="author">Tên tác giả </label>
                <input type="text" id="author" name="author" class="form-control" value="<?= $item['author']?>">
            </div>
             <div class="form-group">
                <label for="framework">Kích thước </label>
                <input type="text" id="framework" name="framework" class="form-control" value="<?= $item['framework']?>">
            </div>
             <div class="form-group">
                <label for="number_of_pages">Số trang  </label>
                <input type="number" id="number_of_pages" name="number_of_pages" class="form-control" value="<?= $item['number_of_pages']?>">
            </div>
             <div class="form-group">
                <label for="format">Định dạng </label>
                <input type="text" id="format" name="format" class="form-control" value="<?= $item['format']?>">
            </div>
             <div class="form-group">
                <label for="weight">Trọng lượng </label>
                <input type="number" id="weight" name="weight" class="form-control" value="<?= $item['weight']?>">
            </div>
             <div class="form-group">
                <label for="book_series">Thuộc bộ sách </label>
                <input type="text" id="book_series" name="book_series" class="form-control" value="<?= $item['book_series']?>">
            </div>
             <div class="form-group">
                <label for="sale">Khuyến mãi </label>
                <input type="number" id="sale" name="sale" class="form-control" value="<?= $item['sale']?>">
            </div>
            <div class="form-group">
                <label for="book_description">Mô tả</label>
              <textarea id="book_description" name="book_description" class="form-control" rows="3"><?= $item['book_description'] ?></textarea>

            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Cập nhật sản phẩm</button>
            <a href="<?php echo base_url(); ?>index.php/Admin/getAllProduct" class="btn btn-link">Quay lại</a>
        </form>
    </div>



 
<script>
function previewImage(input, previewId) {
    const file = input.files[0];
    const preview = document.querySelector(previewId);

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>


  
</body>
</html>
