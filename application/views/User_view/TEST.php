<form action="<?= base_url('index.php/User/updataProfile') ?>" method="post">
    <input type="text" name="test" value="123">
    <button type="submit">Gửi</button>
      <div class="form-group profile__field">
          <label class="profile__label">Email</label>
          <input type="email" name="email" class="form-control profile__input"  placeholder="example@gmail.com" value="<?= isset($user['email']) ? $user['email'] : 'Khách'; ?>">
        </div>
        <input type="text" class="form-control profile__input" name="phone_number" placeholder="0123456789" value="<?= isset($user['phone_number']) ? $user['phone_number'] : '0'; ?>" >

</form>
