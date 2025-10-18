<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Chat với người dùng</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>public\css\chat_detail.css?=1.2">
</head>
<body>
<?php $this->load->view('components/header_admin'); ?>

<div class="chat-container">
    <div class="chat-header">💬 Chat với User #<?= $user_id ?></div>

    <div class="chat-box" id="chatBox">
        <?php if(!empty($messages)): ?>
            <?php foreach($messages as $chat): ?>
                <?php foreach($chat['messages'] as $msg): ?>
                    <div class="chat-message <?= htmlspecialchars($msg['user']) ?>">
                        <?= htmlspecialchars($msg['message']) ?>
                        <div class="time"><?= htmlspecialchars($msg['time']) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; color:#888;" id="noMessage">Chưa có tin nhắn nào.</p>
        <?php endif; ?>
    </div>

    <form class="chat-input" id="chatForm">
        <input type="text" name="message" id="messageInput" placeholder="Nhập phản hồi..." required>
        <button type="submit">Gửi</button>
    </form>
</div>

<script>

const chatForm = document.getElementById('chatForm');
const messageInput = document.getElementById('messageInput');
const chatBox = document.getElementById('chatBox');
const noMessageP = document.getElementById('noMessage');


const userId = <?= $user_id ?>;
const formUrl = "<?= base_url('index.php/Admin/sendReply/') ?>" + userId;


chatBox.scrollTop = chatBox.scrollHeight;

/**
 * Hàm trợ giúp để thêm tin nhắn mới vào giao diện
 * (Hàm này dùng khi Admin GỬI tin)
 * @param {string} sender - 'admin' hoặc 'system-error'
 * @param {string} message - Nội dung tin nhắn
 * @param {string} time - Thời gian
 */
function appendMessage(sender, message, time) {
    
    if (noMessageP && noMessageP.parentElement) {
        noMessageP.parentElement.removeChild(noMessageP);
    }

    const msgDiv = document.createElement('div');
    msgDiv.classList.add('chat-message', sender);
    const msgContent = document.createTextNode(message);
    const timeDiv = document.createElement('div');
    timeDiv.classList.add('time');
    timeDiv.textContent = time;

    msgDiv.appendChild(msgContent);
    msgDiv.appendChild(timeDiv);
    chatBox.appendChild(msgDiv);
    chatBox.scrollTop = chatBox.scrollHeight; // Cuộn xuống cuối
}


chatForm.addEventListener('submit', function(e) {
    e.preventDefault(); 
    const message = messageInput.value.trim();
    if (message === '') return;

    const now = new Date();
    const timeString = now.toTimeString().substr(0, 5);
    
   
    appendMessage('admin', message, timeString);
    messageInput.value = '';

    
    const formData = new URLSearchParams();
    formData.append('message', message);
    
    fetch(formUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            console.log('Tin nhắn admin đã được lưu.');
        } else {
            appendMessage('system-error', 'Lỗi gửi tin.', '');
        }
    })
    .catch(error => {
        console.error('Lỗi fetch (gửi):', error);
      
    });
});



function loadMessages() {
    
    const isScrolledToBottom = chatBox.scrollHeight - chatBox.clientHeight <= chatBox.scrollTop + 5;

   
    fetch(location.href) 
        .then(response => response.text())
        .then(htmlString => {
            
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(htmlString, 'text/html');
            
           
            const newChatBox = newDoc.getElementById('chatBox');
            
            if (newChatBox) {
                if (chatBox.innerHTML !== newChatBox.innerHTML) {
                    chatBox.innerHTML = newChatBox.innerHTML;

                    
                    if (isScrolledToBottom) {
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }
                   
                }
            }
        })
        .catch(error => {
            console.error('Lỗi khi tải lại tin nhắn:', error);
        });
}


setInterval(loadMessages, 2000);

</script>
</body>
</html>