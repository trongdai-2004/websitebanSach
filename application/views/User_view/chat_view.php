<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Chat Hỗ Trợ</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>public\css\chat_view.css?=1.7">

</head>
<body>
   
    <?php $this->load->view('components/header') ?> 

    <!-- Chat -->
    <div class="row">
        <div class="col-8 backgrout ">
          
             <div class="book__category">
            <div class="book__category-text">
                  <span>SÁCH BÁN CHẠY</span>
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
                        <img src="<?php echo base_url(); ?>\public\images\sp18s.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Truyền thuyết về mặt trời -tập 2 có 
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
                        <img src="<?php echo base_url(); ?>\public\images\sp21t.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                        Tư tưởng Hồ Chí Minh
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
                        <img src="<?php echo base_url(); ?>\public\images\sp27s.jpg" alt="sản phẩm 1">
                    </div>
                    <div class="book__product-name">
                    anh hùng vũ trụ
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
                        <img src="<?php echo base_url(); ?>\public\images\sp20t.jpg" alt="sản phẩm 1">
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








    <div class="col-4  ">
        <div class="chat">
            
        
    
        <div class="chat-container">
            <div class="chat-header">Hỗ trợ khách hàng</div>
            <div class="chat-box" id="chat-box"></div>
            <div class="chat-input">
                <input type="text" id="message" placeholder="Nhập tin nhắn...">
                <button id="sendBtn" class="sent">Gửi</button>
            </div>
    
    </div>
</div>
        </div>
    </div>
    
    <?php $this->load->view('components/footer') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function loadMessages() {
    $.get("<?= base_url('index.php/User/sendMessage') ?>", function(data){
        var res = JSON.parse(data);
        $('#chat-box').html('');
        res.messages.forEach(function(chat){
            chat.messages.forEach(function(msg){
                var cls = msg.user === 'user' ? 'user' : 'admin';
                $('#chat-box').append(
                    '<div class="chat-message '+cls+'">'+
                    msg.message+
                    '<span class="time">'+msg.time+'</span></div>'
                );
            });
        });
        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
    });
}

// Gửi tin nhắn
$('#sendBtn').click(function() {
    var message = $('#message').val().trim();
    if(message === '') return;

    $('#chat-box').append(
        '<div class="chat-message user">'+
        message+
        '<span class="time">'+new Date().toLocaleTimeString().slice(0,5)+'</span></div>'
    );
    $('#message').val('');
    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);

    $.post("<?= base_url('index.php/User/sendMessage') ?>", {message: message});
});

// Nhấn Enter để gửi
$('#message').on('keypress', function(e) {
    if (e.which === 13) {
        $('#sendBtn').click();
    }
});

// Polling 2 giây
setInterval(loadMessages, 5000);
loadMessages();
</script>
</body>
</html>
