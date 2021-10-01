<?php require APP_ROOT . '/views/inc/_top.php' ?>

<?php flash('msg_error'); ?>

<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 p-0">
     <div class="mdc-card p-0">
         <h6 class="card-title card-padding">Create New Order</h6>
     </div>
 </div>

<form action="<?php echo URL_ROOT; ?>/orders/add" method="post">
   <div class="mdc-layout-grid__inner p-4 bg-white">
    
       <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field <?php echo $data['hp_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input
            id="ocHp"
            name="hp"
            type="text"
            class="mdc-text-field__input" 
            value="<?php echo $data['hp']; ?>"
            onkeypress="return isNumberKey(event)"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Customer Whatsapp</label>
           <small class="text-danger pt-1"><?php echo $data['hp_err'] ? $data['hp_err'] : ''; ?></small>
         </div>
      </div>

       <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field <?php echo $data['name_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input
            id="ocName"
            name="name" 
            type="text" 
            class="mdc-text-field__input"
            value="<?php echo strtolower($data['name']); ?>"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Customer Name</label>
           <small class="text-danger pt-1"><?php echo $data['name_err'] ? $data['name_err'] : ''; ?></small>
         </div>
      </div>
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field <?php echo $data['email_err'] ? 'mdc-text-field--invalid' : ''; ?>">
           <input
            id="ocEmail"
            name="email" 
            type="email" 
            class="mdc-text-field__input"
            value="<?php echo strtolower($data['email']); ?>"
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Customer Email</label>
           <small class="text-danger pt-1"><?php echo $data['email_err'] ? $data['email_err'] : ''; ?></small>
         </div>
      </div>
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
        <div class="mdc-select w-100 <?php echo $data['product_id_err'] ? 'mdc-select--invalid' : ''; ?>" data-mdc-auto-init="MDCSelect">
          <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">
          <i class="mdc-select__dropdown-icon"></i>
          <div class="mdc-select__selected-text"></div>
          <div class="mdc-select__menu mdc-menu-surface">
            <ul class="mdc-list">
              <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
              </li>

              <?php foreach($opt['product'] as $val) : ?>
                <li class="mdc-list-item" data-value="<?php echo $val->id; ?>"><?php echo ucwords($val->name); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <span class="mdc-floating-label">Choose the product</span>
          <div class="mdc-line-ripple"></div>
          <small class="text-danger pt-1"><?php echo $data['product_id_err'] ? $data['product_id_err'] : ''; ?></small>
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
  let name = $("#ocName ");
  let email = $("#ocEmail ");

  $("#ocHp ").on('change', function(){
      let hpVal = $(this).val();
      let baseUrl = "<?php echo URL_ROOT; ?>";
  
      // Get
      $.ajax({
          type: 'GET',
          url: baseUrl+"/customers/get_by_hp/"+hpVal,
              success: function (data,status,xhr) {   // success callback function
                  // console.log('data', data);
  
                email.attr('value', data.email);
                name.attr('value', data.name);
              },
              error: function (jqXhr, textStatus, errorMessage) { // error callback
                  email.attr('value', '');
                  name.attr('value', '');
                  // console.log('error:', errorMessage);
              }
      });
  });
</script>

<?php require APP_ROOT . '/views/inc/_bottom.php' ?>
