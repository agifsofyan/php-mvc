<?php require APP_ROOT . '/views/inc/_top.php' ?>

<?php flash('msg_error'); ?>

<!-- <a href="<?php echo URL_ROOT; ?>/products" class="btn btn-light"><i class="fa fa-backward"></i> Back</a> -->

<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 p-0">
     <div class="mdc-card p-0">
         <h6 class="card-title card-padding pb-0">Edit Payment</h6>
     </div>
 </div>

<form method="post" action="<?php echo URL_ROOT; ?>/payments/edit/<?php echo $data['id']; ?>">
   <div class="mdc-layout-grid__inner p-4" style="background: white !important">

       <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field <?php echo $data['title_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="title" 
            type="text" 
            class="mdc-text-field__input"
            value="<?php echo strtolower($data['title']); ?>"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Title</label>
           <small class="text-danger pt-1"><?php echo $data['title_err'] ? $data['title_err'] : ''; ?></small>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field">
           <input 
            name="alias" 
            type="text" 
            class="mdc-text-field__input"
            value="<?php echo $data['alias']; ?>"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Alias</label>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field <?php echo $data['vendor_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="vendor" 
            type="text" 
            class="mdc-text-field__input"
            value="<?php echo strtoupper($data['vendor']); ?>"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Vendor</label>
           <small class="text-danger pt-1"><?php echo $data['vendor_err'] ? $data['vendor_err'] : ''; ?></small>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field <?php echo $data['account_name_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="account_name" 
            type="text" 
            class="mdc-text-field__input"
            value="<?php echo strtoupper($data['account_name']); ?>"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Account Name</label>
           <small class="text-danger pt-1"><?php echo $data['account_name_err'] ? $data['account_name_err'] : ''; ?></small>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field <?php echo $data['account_number_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="account_number" 
            type="text"
            class="mdc-text-field__input"
            value="<?php echo (int) $data['account_number']; ?>"
            onkeypress="return isNumberKey(event)"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Account Number</label>
           <small class="text-danger pt-1"><?php echo $data['account_number_err'] ? $data['account_number_err'] : ''; ?></small>
         </div>
      </div>
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop mb-4">
        
        <div class="mdc-switch mdc-switch--info" data-mdc-auto-init="MDCSwitch">
          <div class="mdc-switch__track"></div>
          <p for="text-field-hero-input" class="mdc-floating-label mt-2 mb-2">Status</p>
          <div class="mdc-switch__thumb-underlay">
            <div class="mdc-switch__thumb">
              <input 
                type="checkbox" 
                name="is_active" 
                id="inputIsActive" 
                class="mdc-switch__native-control" 
                role="switch" 
                value="<?php echo $data['is_active']; ?>"
                <?php echo $data['is_active'] ? "checked" : ""; ?> 
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

<?php require APP_ROOT . '/views/inc/_bottom.php' ?>