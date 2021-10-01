<?php require APP_ROOT . '/views/auth/_header.php' ?>

<?php flash('msg_error'); ?>

<div class="registration-form">
  <form action="<?php echo URL_ROOT; ?>/auth/login" method="post">
        <div class="form-icon">
            <span><img width="120" alt="logo" src="<?php echo URL_ROOT; ?>/assets/images/logo/logo-icon-transparent.png" /></span>
        </div>
        <div class="form-group">
            <input 
              type="text" 
              class="form-control item <?php echo (!empty($data['username_err'])) ? 'is-invalid' : '';?>" 
              placeholder="User Name" 
              name="username"
              value="<?php echo $data['username']; ?>"
            />
            <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
        </div>
        <div class="form-group">
            <input 
              type="password" 
              class="form-control item password <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" 
              placeholder="Password" 
              name="password"
              value="<?php echo $data['password']; ?>"
            />
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
        </div>

        <div class="form-group">
          <input type="checkbox" id="passToggle" value='0' onchange='togglePassword(this);' />
          <label for="checkbox-1" id='toggleText'>show password</label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">Login</button>
        </div>
    </form>
</div>

<?php require APP_ROOT . '/views/auth/_footer.php' ?>