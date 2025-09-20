<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index_user</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\bootstrap\bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\view_book_details.css?=1.2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   

</head>

<body>
<!-- load header -->
<?php   $this->load->view('components/header') ?> 
<!-- end load header -->
<div class="book__detail">
    <div class="container">
    <div class="row">
        <div class="col-2">
            <!-- mặt sau -->
            <div class="book__detail-imgSmall">
                <img id="smallImg" src="<?= $product_id['back_image'] ?>" alt="hinh">
            </div>
        </div>
        <div class="col-5">
             <div class="book__detail-imgBig">
                <!-- mặt trước  -->
                <img id="bigImg" src="<?= $product_id['front_image'] ?>" alt="hinh">
            </div>
        </div>
        <div class="col-5">
                <div class="book__detail-name">
                        <p><?= $product_id['product_name'] ?></p>

                        <div class="list">
                        <div class="start">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>

                        </div>
                        <div class="title title_desc">15 đánh giá</div>
                         <div class="title">Đã bán: 2666</div>
                     </div>
                </div>
                <?php
                 $final_price = $product_id['price'] * (1 - $product_id['sale'] / 100);
                 $money_sale =$product_id['price'] - $final_price;
                ?>

                <div class="book__price">
                     <div class="book__price-after">
                       <?= number_format($final_price, 0, ',', '.') . ' đ'; ?>

                    </div>
                     <div class="book__price-before">
                       <s><?= number_format((float)$product_id['price'], 0, ',', '.') . ' đ'; ?></s>

                    </div>
                     <div class="book__price-sale">
                        (Bạn đã tiết kiệm được <?= $money_sale?> VND)
                    </div>
                </div>


                <div class="book__info">
                    <div class="book__info-list">
                        <div class="row">
                            <div class="col-8">
                                <ul>
                                    <li>Mã sách: <?= $product_id['id'] ?></li>
                                    <li>Tác giả: <?= $product_id['author'] ?></li>
                                    <li>Khuôn khổ: <?= $product_id['framework'] ?></li>
                                    <li>Số trang: <?= $product_id['number_of_pages'] ?></li>
                                    <li>Định dạng: <?= $product_id['format'] ?></li>
                                    <li>Trọng lượng: <?= $product_id['weight'] ?> gram</li>
                                    <li>Bộ sách: <?= $product_id['book_series'] ?></li>
                                </ul>
                            </div>
                            <div class="col-4">
                                 <form class="login-form" action="<?php echo base_url() .'index.php/User/addCart'?>" method="post" enctype="multipart/form-data">
                                <div class="book__info-button">

                                    <input type="hidden" name="product_id" value="<?= $product_id['id'] ?>">
                                    <input type="hidden" name="quantity" value="1"> 
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>"> 
                                    <input type="hidden" name="price" value="<?=$final_price?>">
                                    <button>ĐẶT HÀNG NGAY</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>

       
    </div>
    <div class="book__detail-blue">
        <p>MÔ TẢ</p>
    </div>
   
         <div class="book__detail-describe">
            <p>
                <?= $product_id['book_description'] ?>
            </p>
            
        </div>

        <div class="book__detail-blue">
        <p>ĐÁNH GIÁ</p>
    </div>

        <div class="book__evaluate">
            <div class="book__evaluate-input">
                <div class="book__evaluate-label">
                    Đánh giá của bạn
                </div>
                <input type="text" name="evaluate">
                
            </div>
            
            <div class="book__evaluate-list">
                
           
            <div class="book__evaluate-avatar">
                <img src="<?php echo base_url(); ?>public\images\avatar.webp" alt="avatar">
            </div>
           
            <div class="book__evaluate-star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i> 
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
             <div class="book__evaluate-nickname">
                Nguyễn Cường 
            </div>
            <div class="book__evaluate-time">
                <p>30 phút trước </p>
            </div>
            </div>
            <div class="book__evaluate-text">
                Truyện rất hay !
            </div>

        </div>
        <div class="book__evaluate">
            <div class="book__evaluate-list">
                
           
            <div class="book__evaluate-avatar">
                <img src="<?php echo base_url(); ?>public\images\avatar.webp" alt="avatar">
            </div>
           
            <div class="book__evaluate-star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i> 
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
             <div class="book__evaluate-nickname">
                Nguyễn Cường 
            </div>
            <div class="book__evaluate-time">
                <p>30 phút trước </p>
            </div>
            </div>
            <div class="book__evaluate-text">
                Truyện rất hay !
            </div>

        </div>
        <div class="book__evaluate">
            <div class="book__evaluate-list">
                
           
            <div class="book__evaluate-avatar">
                <img src="<?php echo base_url(); ?>public\images\avatar.webp" alt="avatar">
            </div>
           
            <div class="book__evaluate-star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i> 
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
             <div class="book__evaluate-nickname">
                Nguyễn Cường 
            </div>
            <div class="book__evaluate-time">
                <p>30 phút trước </p>
            </div>
            </div>
            <div class="book__evaluate-text">
                Truyện rất hay !
            </div>

        </div>
        <div class="book__category">
            <div class="book__category-text">
                  <span>SÁCH CÙNG THỂ LOẠI</span>
            </div>
        </div>

<section>
                <div class="container">
    <div class="book">
       
         <div class="row">
            <div class="col-3">
                <div class="book__product">
                    <a href="#">
                    <div class="book__product-image">
                        <img src="<?php echo base_url(); ?>\public\images\slide_4.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Truyền thuyết về mặt trời -tập 2 có đssssssadssssssssssssssssssssssssssssssssssssssssssssssssssss
                    </div>
                     <div class="book__product-price">
                        80.000 VND 
                    </div>
                    </a>


                </div>
            </div>
             <div class="col-3">
                <div class="book__product">
                    <a href="#">
                    <div class="book__product-image">
                        <img src="<?php echo base_url(); ?>\public\images\slide_4.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Truyền thuyết về mặt trời -tập 2
                    </div>
                     <div class="book__product-price">
                        80.000 VND 
                    </div>
                    </a>


                </div>
            </div>
             <div class="col-3">
                <div class="book__product">
                    <a href="#">
                    <div class="book__product-image">
                        <img src="<?php echo base_url(); ?>\public\images\slide_4.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Truyền thuyết về mặt trời -tập 2
                    </div>
                     <div class="book__product-price">
                        80.000 VND 
                    </div>
                    </a>


                </div>
            </div> <div class="col-3">
                <div class="book__product">
                    <a href="#">
                    <div class="book__product-image">
                        <img src="<?php echo base_url(); ?>\public\images\slide_4.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Truyền thuyết về mặt trời -tập 2
                    </div>
                     <div class="book__product-price">
                        80.000 VND 
                    </div>
                    </a>
                </div>
            </div>  
        </div>
    </div>
    </div>
</section>



 <div class="book__set">
            <div class="book__set-text">
                  <span>SÁCH CÙNG BỘ</span>
            </div>
            
        </div>


<section class="section-last">
    <div class="container">
    <div class="book">
         <div class="row">
            <div class="col-3">
                <div class="book__product">
                    <a href="#">
                    <div class="book__product-image">
                        <img src="<?php echo base_url(); ?>\public\images\slide_4.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Truyền thuyết về mặt trời -tập 2 có đsssssssaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbb
                    </div>
                     <div class="book__product-price">
                        80.000 VND 
                    </div>
                    </a>


                </div>
            </div>
             <div class="col-3">
                <div class="book__product">
                    <a href="#">
                    <div class="book__product-image">
                        <img src="<?php echo base_url(); ?>\public\images\slide_4.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Truyền thuyết về mặt trời -tập 2
                    </div>
                     <div class="book__product-price">
                        80.000 VND 
                    </div>
                    </a>


                </div>
            </div>
             <div class="col-3">
                <div class="book__product">
                    <a href="#">
                    <div class="book__product-image">
                        <img src="<?php echo base_url(); ?>\public\images\slide_4.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Truyền thuyết về mặt trời -tập 2
                    </div>
                     <div class="book__product-price">
                        80.000 VND 
                    </div>
                    </a>


                </div>
            </div> <div class="col-3">
                <div class="book__product">
                    <a href="#">
                    <div class="book__product-image">
                        <img src="<?php echo base_url(); ?>\public\images\slide_4.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Truyền thuyết về mặt trời -tập 2
                    </div>
                     <div class="book__product-price">
                        80.000 VND 
                    </div>
                    </a>
                </div>
            </div>  
        </div>
    </div>
    </div>
</section>
    
    


</div>







<!-- load footer -->
<?php   $this->load->view('components/footer') ?>
<!-- end load footer -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const smallImg = document.getElementById("smallImg");
    const bigImg = document.getElementById("bigImg");

    smallImg.addEventListener("click", function () {
        // Thêm class để làm hiệu ứng fade-out
        bigImg.classList.add("fade-out");

        // Sau 400ms (hiệu ứng mờ xong), đổi ảnh rồi fade-in
        setTimeout(() => {
            // Hoán đổi ảnh
            let temp = smallImg.src;
            smallImg.src = bigImg.src;
            bigImg.src = temp;

            // Gỡ fade-out, thêm fade-in
            bigImg.classList.remove("fade-out");
            bigImg.classList.add("fade-in");

            // Sau 400ms nữa, gỡ fade-in để lần sau có thể lặp lại
            setTimeout(() => {
                bigImg.classList.remove("fade-in");
            }, 400);
        }, 400);
    });
</script>






</body>

</html>