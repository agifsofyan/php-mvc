<?php require APP_ROOT . '/views/inc/_top.php' ?>

<?php flash('msg_error'); ?>

<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 p-0">
     <div class="mdc-card p-0">
         <h6 class="card-title card-padding">Create New Product</h6>
     </div>
 </div>

<form action="<?php echo URL_ROOT; ?>/products/add" method="post" enctype="multipart/form-data">
   <div class="mdc-layout-grid__inner p-4 bg-white">

       <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
         <div class="mdc-text-field <?php echo $data['name_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="name" 
            type="text" 
            class="mdc-text-field__input" 
            id="nameInput" 
            value="<?php echo strtolower($data['name']); ?>"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
           <small class="text-danger pt-1"><?php echo $data['name_err'] ? $data['name_err'] : ''; ?></small>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
         <div class="mdc-text-field <?php echo $data['price_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input 
            name="price" 
            type="text"
            class="mdc-text-field__input CurrencyInput" 
            value="<?php echo $data['price']; ?>"
            onkeypress="return isNumberKey(event)"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Price (Rp)</label>
           <small class="text-danger pt-1"><?php echo $data['price_err'] ? $data['price_err'] : ''; ?></small>
         </div>
      </div>
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop p-2">
          <label class="mdl-button mdl-js-button mdl-button--icon mdl-button--file pointer">
           <i class="material-icons">attach_file</i>
           <input accept="image/*" type='file' name="image" id="imgInp" class="no-display">
          </label>
          <small class="p-1">Upload</small>
          <span><img id="blah" src="<?php echo URL_ROOT; ?>/assets/images/icons/empty_image_64.png" alt="your image" width="20" /></span>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">

        <textarea 
          name="description"
          id="description"
        ></textarea>

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
  CKEDITOR.replace('description', {
    width: '100%'
  });

  $('input.CurrencyInput').on('blur', function() {
    const value = this.value.replace(/,/g, '');
    this.value = parseFloat(value).toLocaleString('id-ID', {
      style: 'decimal',
      maximumFractionDigits: 2,
      minimumFractionDigits: 0
    });
  });

  $("#imgInp").on('change', function(){
    // console.log('evt');
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
        blah.width = 50
    }
  });
</script>

<?php require APP_ROOT . '/views/inc/_bottom.php' ?>
