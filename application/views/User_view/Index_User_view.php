<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index_user</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\bootstrap\bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('public/css/components/header.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public\css\view_index_user.css?=2.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   

</head>

<body>
<!-- load header -->
<?php   $this->load->view('components/header') ?> 
<!-- end load header -->
<!-- slide -->
<div class="all">
<div class="all-small">
  <div class="slide">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
      <!-- Slide ảnh -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100 slide__image" src="<?= base_url('public/images/slide_1t.jpg') ?>" alt="Slide 1">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 slide__image" src="<?= base_url('public/images/slide_2t.jpg') ?>" alt="Slide 2">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 slide__image" src="<?= base_url('public/images/slide_3t.jpg') ?>" alt="Slide 3">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 slide__image" src="<?= base_url('public/images/slide_4t.jpg') ?>" alt="Slide 4">
        </div>
      </div>

      <!-- Nút điều hướng -->
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Trước</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Tiếp</span>
      </a>
    </div>
  </div>



 <!-- Slide -->
  <!-- End Slide -->
<!-- section-one -->

<section>
    <div class="book">
        <div class="row">
            <div class="col-12">
            <div class="book__bookType">
                SÁCH MỚI 
            </div>
            </div>
        </div>

      
        
        <div class="row">
              <?php foreach ($new_product as $item): ?>
                <input type="hidden" name="id" value=" <?= $item['id'] ?>"> 
            <div class="col-3">
                <div class="book__product">
                    <a href="<?php echo base_url(); ?>index.php/User/bookDetail/<?= $item['id'] ?>">
                    <div class="book__product-image">
                        <img src="<?= $item['front_image']; ?>" alt="sản phẩm">
                    </div>
                    <div class="book__product-name">
                        <?= $item['product_name']; ?>
                    </div>
                    <div class="book__product-price">
                    <?= number_format((float)$item['price'], 0, ',', '.') . ' đ'; ?>
                </div>

                    </a>


                </div>
            </div> 
             <?php endforeach ?>

        </div>
       

    </div>
</section>

<!-- end section-one -->
<!-- section-two -->
<section>
    <div class="book">
        <div class="row">
            <div class="col-12">
                <div class="book__bookType">
                    SẢN PHẨM BÁN CHẠY NHẤT 
                </div>
            </div>
        </div>
         <div class="row">
            <?php foreach ($best_seller as $item ): ?>
                
           
            <input type="hidden" name="id" value=" <?= $item['id'] ?>"> 
            <div class="col-3">
                <div class="book__product">
                    <a href="<?php echo base_url(); ?>index.php/User/bookDetail/<?= $item['id'] ?>">
                    <div class="book__product-image">
                        <img src="<?= $item['front_image']; ?>" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                       <?= $item['product_name']; ?>
                    </div>
                    <div class="book__product-price">
                    <?= number_format((float)$item['price'], 0, ',', '.') . ' đ'; ?>
                </div>
                    </a>


                </div>
            </div>
             <?php endforeach ?>
            
          
            
        </div>
    </div>
</section>
</div>
</div>
<!-- end section-two -->
<!-- banner -->

<section>
    <div class="banner">
        
                <div class="banner__title-one text-center">
                    <p>Manga Collection</p>
                    <p>Bộ sưu tập dành cho fan mê truyện tranh</p>

                </div>
          

       
        
    </div>
</section>

<!-- end banner -->

<div class="all">
    <div class="all-small">
<!-- section-three -->
<section>
<div class="book">
        <div class="row">
            <?php foreach ($manga as $item ): ?>
            <input type="hidden" name="id" value=" <?= $item['id'] ?>"> 
            <div class="col-3">
                <div class="book__product">
                    <a href="<?php echo base_url(); ?>index.php/User/bookDetail/<?= $item['id'] ?>">
                    <div class="book__product-image">
                        <img src="<?= $item['front_image']; ?>" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                          <?= $item['product_name']; ?>
                    </div>
                    <div class="book__product-price">
                    <?= number_format((float)$item['price'], 0, ',', '.') . ' đ'; ?>
                </div>
                    </a>

                </div>
            </div>

              <?php endforeach ?>
        </div>
    </div>


</section>
<!-- end section-three -->
    </div>
</div>

<section>
    <div class="banner">
       
                <div class="banner__title-two ">
                    <p>Sách vễ kỹ năng sống cho giới trẻ</p>
        </div>
        
    </div>
</section>


<div class="all">
    <div class="all-small">



<!-- section-four -->
       <section>
           <div class="book">
        <div class="row">
             <?php foreach ($life_skills as $item ): ?>
            <input type="hidden" name="id" value=" <?= $item['id'] ?>"> 
            <div class="col-3">
                <div class="book__product">
                    <a href="<?php echo base_url(); ?>index.php/User/bookDetail/<?= $item['id'] ?>">
                    <div class="book__product-image">
                        <img src="<?= $item['front_image']; ?>" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                         <?= $item['product_name']; ?>
                    </div>
                    <div class="book__product-price">
                    <?= number_format((float)$item['price'], 0, ',', '.') . ' đ'; ?>
                </div>
                    </a>


                </div>
            </div>
            <?php endforeach ?>
           
        </div>
    </div>
       </section>
<!-- end section-four -->
    </div>
</div>
<div class="all">
    <div class="all-small">
        
    </div>
</div>


<!-- load footer -->
<?php   $this->load->view('components/footer') ?>
<!-- end load footer -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function(){
    $('#myCarousel').carousel({
      interval: 3000,
      ride: 'carousel'
    });
  });








</script>





</body>

</html>