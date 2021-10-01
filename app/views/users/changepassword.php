<?php require APP_ROOT . '/views/inc/_top.php' ?>

<?php flash('msg_error'); ?>
<?php flash('msg_success'); ?>

<!-- <a href="<?php echo URL_ROOT; ?>/users" class="btn btn-light"><i class="fa fa-backward"></i> Back</a> -->

<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 p-0">
     <div class="mdc-card p-0">
         <h6 class="card-title card-padding pb-0">Change Password</h6>
     </div>
 </div>

<form 
  method="post" 
  action="<?php echo URL_ROOT; ?>/users/changepassword"
>
   <div class="mdc-layout-grid__inner p-4" style="background: white !important">
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
         <div class="mdc-text-field <?php echo $data['password_old_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="password_old"
            type="password" 
            class="mdc-text-field__input password" 
            id="passwordInput"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Old Password</label>
           <small class="text-danger pt-1"><?php echo $data['password_old_err'] ? $data['password_old_err'] : ''; ?></small>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
         <div class="mdc-text-field <?php echo $data['password_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="password"
            type="password" 
            class="mdc-text-field__input password" 
            id="passwordInput"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Password</label>
           <small class="text-danger pt-1"><?php echo $data['password_err'] ? $data['password_err'] : ''; ?></small>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
         <div class="mdc-text-field <?php echo $data['confirm_password_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="confirm_password"
            type="password" 
            class="mdc-text-field__input password" 
            id="confirmPasswordInput"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Confirm Password</label>
           <small class="text-danger pt-1"><?php echo $data['confirm_password_err'] ? $data['confirm_password_err'] : ''; ?></small>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop mb-4">
        <div class="mdc-switch mdc-switch--info" data-mdc-auto-init="MDCSwitch">
          <div class="mdc-switch__track"></div>
          <p for="text-field-hero-input" class="mdc-floating-label mt-2 mb-2" id='toggleText'>show password</p>
          <div class="mdc-switch__thumb-underlay">
            <div class="mdc-switch__thumb">
              <input 
                type="checkbox"
                id="passToggle" 
                class="mdc-switch__native-control" 
                role="switch"
                value='0' 
                onchange='togglePassword(this);'
              />
            </div>
          </div>
        </div>
      </div>

       <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 p-0">
           <div class="mdc-card p-0">
               <button type="submit" class="mdc-button mdc-button--raised icon-button filled-button--success btn-action">
                     <i class="material-icons mdc-button__icon">save</i>
                 </button>
           </div>
       </div>
   </div>
</form>

<script type="text/javascript">
  function togglePassword(e){
        if($(e).is(':checked')){
            $(".password").attr("type","text");
            $("#toggleText").text("hide password");
        }else{
            $(".password").attr("type","password");
            $("#toggleText").text("show password");
        }
    }
</script>

<?php require APP_ROOT . '/views/inc/_bottom.php' ?>
