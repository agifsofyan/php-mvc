<?php require APP_ROOT . '/views/inc/_top.php' ?>

<?php flash('msg_error'); ?>
<?php flash('msg_success'); ?>

<!-- <a href="<?php echo URL_ROOT; ?>/users" class="btn btn-light"><i class="fa fa-backward"></i> Back</a> -->

<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 p-0">
     <div class="mdc-card p-0">
         <h6 class="card-title card-padding pb-0">Edit User (Admin)</h6>
     </div>
 </div>

<form 
  method="post" 
  action="<?php echo URL_ROOT; ?>/users/edit/<?php echo $data['id']; ?>"
>
   <div class="mdc-layout-grid__inner p-4" style="background: white !important">

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field <?php echo $data['username_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="username"
            type="text" 
            class="mdc-text-field__input" 
            id="nameInput"
            value="<?php echo strtolower($data['username']); ?>"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
           <small class="text-danger pt-1"><?php echo $data['username_err'] ? $data['username_err'] : ''; ?></small>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
        <div class="mdc-select <?php echo $data['role_err'] ? 'mdc-select--invalid' : ''; ?>" data-mdc-auto-init="MDCSelect">
          <input type="hidden" name="role" value="<?php echo $data['role']; ?>">
          <i class="mdc-select__dropdown-icon"></i>
          <div class="mdc-select__selected-text"></div>
          <div class="mdc-select__menu mdc-menu-surface">
            <ul class="mdc-list">
              <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
              </li>
              <?php foreach($opt as $u) : ?>
                <li class="mdc-list-item" data-value="<?php echo strtolower($u); ?>"><?php echo ucwords($u); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <span class="mdc-floating-label">Choose the role</span>
          <div class="mdc-line-ripple"></div>
          <small class="text-danger pt-1"><?php echo $data['role_err'] ? $data['role_err'] : ''; ?></small>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="section--align-end section-right" style="border: skyblue dashed;">
          <i style="font-size: 3rem; color: skyblue" class="material-icons">accessibility</i>
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

<?php require APP_ROOT . '/views/inc/_bottom.php' ?>
