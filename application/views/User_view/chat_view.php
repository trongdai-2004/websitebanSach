<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Chat Hỗ Trợ</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>public\css\chat_view.css?=1.2">

</head>
<body>
   
    <?php $this->load->view('components/header') ?> 

    <!-- Chat -->
    <div class="main-content">
        <div class="chat-container">
            <div class="chat-header">Hỗ trợ khách hàng</div>
            <div class="chat-box" id="chat-box"></div>
            <div class="chat-input">
                <input type="text" id="message" placeholder="Nhập tin nhắn...">
                <button id="sendBtn">Gửi</button>
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
