<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh sách chat</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>public\css\chat_list.css?=v1.2">

</head>
<body>
<?php $this->load->view('components/header_admin'); ?>

<div class="container">
    <h2>💬 Danh sách người dùng đã chat</h2>

    <div class="chat-list">
        <?php if(!empty($users)): ?>
            <?php foreach($users as $u): ?>
                <?php $uid = $u['user_id']; ?>
                <a href="<?= site_url('Admin/viewChat/'.$uid) ?>" class="chat-card">
                    <div class="chat-avatar"><?= strtoupper(substr($uid, -2)) ?></div>
                    <div class="chat-info">
                        <h4>Người dùng #<?= $uid ?></h4>
                        <p>Nhấn để xem toàn bộ hội thoại</p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="empty">📭 Chưa có người dùng nào nhắn tin.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
